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

namespace Hitechnix\Laratrust\Native\Facades;

use Hitechnix\Laratrust\Native\LaratrustBootstrapper;

class Laratrust
{
    /**
     * The Laratrust instance.
     *
     * @var \Hitechnix\Laratrust\Laratrust
     */
    protected $laratrust;

    /**
     * The Native Bootstraper instance.
     *
     * @var LaratrustBootstrapper
     */
    protected static $instance;

    /**
     * Constructor.
     *
     * @param LaratrustBootstrapper $bootstrapper
     *
     * @return void
     */
    public function __construct(LaratrustBootstrapper $bootstrapper = null)
    {
        if ($bootstrapper === null) {
            $bootstrapper = new LaratrustBootstrapper();
        }

        $this->laratrust = $bootstrapper->createLaratrust();
    }

    /**
     * Returns the Laratrust instance.
     *
     * @return \Hitechnix\Laratrust\Laratrust
     */
    public function getLaratrust()
    {
        return $this->laratrust;
    }

    /**
     * Creates a new Native Bootstraper instance.
     *
     * @param LaratrustBootstrapper $bootstrapper
     *
     * @return LaratrustBootstrapper
     */
    public static function instance(LaratrustBootstrapper $bootstrapper = null)
    {
        if (static::$instance === null) {
            static::$instance = new static($bootstrapper);
        }

        return static::$instance;
    }

    /**
     * Handle dynamic, static calls to the object.
     *
     * @param string $method
     * @param array  $args
     *
     * @return mixed
     */
    public static function __callStatic($method, $args)
    {
        $instance = static::instance()->getLaratrust();

        switch (count($args)) {
            case 0:
                return $instance->{$method}();
            case 1:
                return $instance->{$method}($args[0]);
            case 2:
                return $instance->{$method}($args[0], $args[1]);
            case 3:
                return $instance->{$method}($args[0], $args[1], $args[2]);
            case 4:
                return $instance->{$method}($args[0], $args[1], $args[2], $args[3]);
            default:
                return call_user_func_array([$instance, $method], $args);
        }
    }
}
