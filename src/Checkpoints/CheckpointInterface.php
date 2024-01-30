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

interface CheckpointInterface
{
    /**
     * Checkpoint after a user is logged in. Return false to deny persistence.
     *
     * @param UserInterface $user
     *
     * @return bool
     */
    public function login(UserInterface $user): bool;

    /**
     * Checkpoint for when a user is currently stored in the session.
     *
     * @param UserInterface $user
     *
     * @return bool
     */
    public function check(UserInterface $user): bool;

    /**
     * Checkpoint for when a failed login attempt is logged. User is not always
     * passed and the result of the method will not affect anything, as the
     * login failed.
     *
     * @param UserInterface|null $user
     *
     * @return bool
     */
    public function fail(UserInterface $user = null): bool;
}
