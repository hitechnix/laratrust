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

class NotActivatedException extends \RuntimeException
{
    /**
     * The user which caused the exception.
     *
     * @var UserInterface
     */
    protected $user;

    /**
     * Returns the user.
     *
     * @return UserInterface
     */
    public function getUser(): UserInterface
    {
        return $this->user;
    }

    /**
     * Sets the user associated with Laratrust (does not log in).
     *
     * @param UserInterface $user
     *
     * @return void
     */
    public function setUser(UserInterface $user): void
    {
        $this->user = $user;
    }
}
