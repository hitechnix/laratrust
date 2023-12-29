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

namespace Hitechnix\Laratrust\Checkpoints;

use Hitechnix\Laratrust\Users\UserInterface;
use Hitechnix\Laratrust\Activations\ActivationRepositoryInterface;

class ActivationCheckpoint implements CheckpointInterface
{
    use AuthenticatedCheckpoint;

    /**
     * The Activations repository instance.
     *
     * @var ActivationRepositoryInterface
     */
    protected $activations;

    /**
     * Constructor.
     *
     * @param ActivationRepositoryInterface $activations
     *
     * @return void
     */
    public function __construct(ActivationRepositoryInterface $activations)
    {
        $this->activations = $activations;
    }

    /**
     * @inheritdoc
     */
    public function login(UserInterface $user): bool
    {
        return $this->checkActivation($user);
    }

    /**
     * @inheritdoc
     */
    public function check(UserInterface $user): bool
    {
        return $this->checkActivation($user);
    }

    /**
     * Checks the activation status of the given user.
     *
     * @param UserInterface $user
     *
     * @throws NotActivatedException
     *
     * @return bool
     */
    protected function checkActivation(UserInterface $user): bool
    {
        $completed = $this->activations->completed($user);

        if (! $completed) {
            $exception = new NotActivatedException('Your account has not been activated yet.');

            $exception->setUser($user);

            throw $exception;
        }

        return true;
    }
}
