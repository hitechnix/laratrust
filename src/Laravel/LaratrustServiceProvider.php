<?php
/*
 * Hi-Technix, Inc.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the 3-clause BSD license that is
 * available through the world-wide-web at this URL:
 * https://opensource.hitechnix.com/LICENSE.txt
 *
 * @author          Hi-Technix, Inc.
 * @copyright       Copyright (c) 2023 Hi-Technix, Inc.
 * @link            https://opensource.hitechnix.com
 */

namespace Hitechnix\Laratrust\Laravel;

use Hitechnix\Laratrust\Laratrust;
use Illuminate\Support\ServiceProvider;
use Hitechnix\Laratrust\Hashing\NativeHasher;
use Symfony\Component\HttpFoundation\Response;
use Hitechnix\Laratrust\Cookies\IlluminateCookie;
use Hitechnix\Laratrust\Sessions\IlluminateSession;
use Hitechnix\Laratrust\Checkpoints\ThrottleCheckpoint;
use Hitechnix\Laratrust\Roles\IlluminateRoleRepository;
use Hitechnix\Laratrust\Users\IlluminateUserRepository;
use Hitechnix\Laratrust\Checkpoints\ActivationCheckpoint;
use Hitechnix\Laratrust\Reminders\IlluminateReminderRepository;
use Hitechnix\Laratrust\Throttling\IlluminateThrottleRepository;
use Hitechnix\Laratrust\Activations\IlluminateActivationRepository;
use Hitechnix\Laratrust\Persistences\IlluminatePersistenceRepository;

class LaratrustServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->setOverrides();
        $this->garbageCollect();
    }

    /**
     * @inheritdoc
     */
    public function register()
    {
        $this->prepareResources();
        $this->registerPersistences();
        $this->registerUsers();
        $this->registerRoles();
        $this->registerCheckpoints();
        $this->registerReminders();
        $this->registerLaratrust();
        $this->setUserResolver();
    }

    /**
     * Prepare the package resources.
     *
     * @return void
     */
    protected function prepareResources()
    {
        $config = realpath(__DIR__.'/../config/config.php');

        $this->mergeConfigFrom($config, 'hitechnix.laratrust');

        $this->publishes([
            $config => config_path('hitechnix.laratrust.php'),
        ], 'config');

        $migrations = realpath(__DIR__.'/../migrations');

        $this->publishes([
            $migrations => $this->app->databasePath().'/migrations',
        ], 'migrations');
    }

    /**
     * Registers the persistences.
     *
     * @return void
     */
    protected function registerPersistences()
    {
        $this->registerSession();
        $this->registerCookie();

        $this->app->singleton('laratrust.persistence', function ($app) {
            $config = $app['config']->get('hitechnix.laratrust.persistences');

            return new IlluminatePersistenceRepository(
                $app['laratrust.session'],
                $app['laratrust.cookie'],
                $config['model'],
                $config['single']
            );
        });
    }

    /**
     * Registers the session.
     *
     * @return void
     */
    protected function registerSession()
    {
        $this->app->singleton('laratrust.session', function ($app) {
            return new IlluminateSession(
                $app['session.store'],
                $app['config']->get('hitechnix.laratrust.session')
            );
        });
    }

    /**
     * Registers the cookie.
     *
     * @return void
     */
    protected function registerCookie()
    {
        $this->app->singleton('laratrust.cookie', function ($app) {
            return new IlluminateCookie(
                $app['request'],
                $app['cookie'],
                $app['config']->get('hitechnix.laratrust.cookie')
            );
        });
    }

    /**
     * Registers the users.
     *
     * @return void
     */
    protected function registerUsers()
    {
        $this->registerHasher();

        $this->app->singleton('laratrust.users', function ($app) {
            $config = $app['config']->get('hitechnix.laratrust.users');

            return new IlluminateUserRepository(
                $app['laratrust.hasher'],
                $app['events'],
                $config['model']
            );
        });
    }

    /**
     * Registers the hasher.
     *
     * @return void
     */
    protected function registerHasher()
    {
        $this->app->singleton('laratrust.hasher', function () {
            return new NativeHasher();
        });
    }

    /**
     * Registers the roles.
     *
     * @return void
     */
    protected function registerRoles()
    {
        $this->app->singleton('laratrust.roles', function ($app) {
            $config = $app['config']->get('hitechnix.laratrust.roles');

            return new IlluminateRoleRepository($config['model']);
        });
    }

    /**
     * Registers the checkpoints.
     *
     * @throws \InvalidArgumentException
     *
     * @return void
     */
    protected function registerCheckpoints()
    {
        $this->registerActivationCheckpoint();

        $this->registerThrottleCheckpoint();

        $this->app->singleton('laratrust.checkpoints', function ($app) {
            $activeCheckpoints = $app['config']->get('hitechnix.laratrust.checkpoints');

            $checkpoints = [];

            foreach ($activeCheckpoints as $checkpoint) {
                if (! $app->offsetExists("laratrust.checkpoint.{$checkpoint}")) {
                    throw new \InvalidArgumentException("Invalid checkpoint [{$checkpoint}] given.");
                }

                $checkpoints[$checkpoint] = $app["laratrust.checkpoint.{$checkpoint}"];
            }

            return $checkpoints;
        });
    }

    /**
     * Registers the activation checkpoint.
     *
     * @return void
     */
    protected function registerActivationCheckpoint()
    {
        $this->registerActivations();

        $this->app->singleton('laratrust.checkpoint.activation', function ($app) {
            return new ActivationCheckpoint($app['laratrust.activations']);
        });
    }

    /**
     * Registers the activations.
     *
     * @return void
     */
    protected function registerActivations()
    {
        $this->app->singleton('laratrust.activations', function ($app) {
            $config = $app['config']->get('hitechnix.laratrust.activations');

            return new IlluminateActivationRepository($config['model'], $config['expires']);
        });
    }

    /**
     * Registers the throttle checkpoint.
     *
     * @return void
     */
    protected function registerThrottleCheckpoint()
    {
        $this->registerThrottling();

        $this->app->singleton('laratrust.checkpoint.throttle', function ($app) {
            return new ThrottleCheckpoint(
                $app['laratrust.throttling'],
                $app['request']->getClientIp()
            );
        });
    }

    /**
     * Registers the throttle.
     *
     * @return void
     */
    protected function registerThrottling()
    {
        $this->app->singleton('laratrust.throttling', function ($app) {
            $model = $app['config']->get('hitechnix.laratrust.throttling.model');

            $throttling = $app['config']->get('hitechnix.laratrust.throttling');

            foreach (['global', 'ip', 'user'] as $type) {
                ${"{$type}Interval"}   = $throttling[$type]['interval'];
                ${"{$type}Thresholds"} = $throttling[$type]['thresholds'];
            }

            return new IlluminateThrottleRepository(
                $model,
                $globalInterval,
                $globalThresholds,
                $ipInterval,
                $ipThresholds,
                $userInterval,
                $userThresholds
            );
        });
    }

    /**
     * Registers the reminders.
     *
     * @return void
     */
    protected function registerReminders()
    {
        $this->app->singleton('laratrust.reminders', function ($app) {
            $config = $app['config']->get('hitechnix.laratrust.reminders');

            return new IlluminateReminderRepository(
                $app['laratrust.users'],
                $config['model'],
                $config['expires']
            );
        });
    }

    /**
     * Registers Laratrust.
     *
     * @return void
     */
    protected function registerLaratrust()
    {
        $this->app->singleton('laratrust', function ($app) {
            $Laratrust = new Laratrust(
                $app['laratrust.persistence'],
                $app['laratrust.users'],
                $app['laratrust.roles'],
                $app['laratrust.activations'],
                $app['events']
            );

            if (isset($app['laratrust.checkpoints'])) {
                foreach ($app['laratrust.checkpoints'] as $key => $checkpoint) {
                    $Laratrust->addCheckpoint($key, $checkpoint);
                }
            }

            $Laratrust->setActivationRepository($app['laratrust.activations']);
            $Laratrust->setReminderRepository($app['laratrust.reminders']);
            $Laratrust->setThrottleRepository($app['laratrust.throttling']);

            $Laratrust->setRequestCredentials(function () use ($app) {
                $request = $app['request'];

                $login    = $request->getUser();
                $password = $request->getPassword();

                if ($login === null && $password === null) {
                    return;
                }

                return compact('login', 'password');
            });

            $Laratrust->creatingBasicResponse(function () {
                $headers = ['WWW-Authenticate' => 'Basic'];

                return new Response('Invalid credentials.', 401, $headers);
            });

            return $Laratrust;
        });

        $this->app->alias('laratrust', 'Hitechnix\Laratrust\Laratrust');
    }

    /**
     * @inheritdoc
     */
    public function provides()
    {
        return [
            'laratrust.session',
            'laratrust.cookie',
            'laratrust.persistence',
            'laratrust.hasher',
            'laratrust.users',
            'laratrust.roles',
            'laratrust.activations',
            'laratrust.checkpoint.activation',
            'laratrust.throttling',
            'laratrust.checkpoint.throttle',
            'laratrust.checkpoints',
            'laratrust.reminders',
            'laratrust',
        ];
    }

    /**
     * Garbage collect activations and reminders.
     *
     * @return void
     */
    protected function garbageCollect()
    {
        $config = $this->app['config']->get('hitechnix.laratrust');

        $this->sweep(
            $this->app['laratrust.activations'],
            $config['activations']['lottery']
        );

        $this->sweep(
            $this->app['laratrust.reminders'],
            $config['reminders']['lottery']
        );
    }

    /**
     * Sweep expired codes.
     *
     * @param mixed $repository
     * @param array $lottery
     *
     * @return void
     */
    protected function sweep($repository, array $lottery)
    {
        if ($this->configHitsLottery($lottery)) {
            try {
                $repository->removeExpired();
            } catch (\Exception $e) {
            }
        }
    }

    /**
     * Determine if the configuration odds hit the lottery.
     *
     * @param array $lottery
     *
     * @return bool
     */
    protected function configHitsLottery(array $lottery)
    {
        return mt_rand(1, $lottery[1]) <= $lottery[0];
    }

    /**
     * Sets the user resolver on the request class.
     *
     * @return void
     */
    protected function setUserResolver()
    {
        $this->app->rebinding('request', function ($app, $request) {
            $request->setUserResolver(function () use ($app) {
                return $app['laratrust']->getUser();
            });
        });
    }

    /**
     * Performs the necessary overrides.
     *
     * @return void
     */
    protected function setOverrides()
    {
        $config = $this->app['config']->get('hitechnix.laratrust');

        $users = $config['users']['model'];

        $roles = $config['roles']['model'];

        $persistences = $config['persistences']['model'];

        if (class_exists($users)) {
            if (method_exists($users, 'setRolesModel')) {
                forward_static_call_array([$users, 'setRolesModel'], [$roles]);
            }

            if (method_exists($users, 'setPersistencesModel')) {
                forward_static_call_array([$users, 'setPersistencesModel'], [$persistences]);
            }

            if (method_exists($users, 'setPermissionsClass')) {
                forward_static_call_array([$users, 'setPermissionsClass'], [$config['permissions']['class']]);
            }
        }

        if (class_exists($roles) && method_exists($roles, 'setUsersModel')) {
            forward_static_call_array([$roles, 'setUsersModel'], [$users]);
        }

        if (class_exists($persistences) && method_exists($persistences, 'setUsersModel')) {
            forward_static_call_array([$persistences, 'setUsersModel'], [$users]);
        }
    }
}
