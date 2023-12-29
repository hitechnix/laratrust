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

namespace Hitechnix\Laratrust\Users;

interface UserInterface
{
    /**
     * Returns the user primary key.
     *
     * @return string
     */
    public function getUserId(): string;

    /**
     * Returns the user login.
     *
     * @return string
     */
    public function getUserLogin(): string;

    /**
     * Returns the user login attribute name.
     *
     * @return string
     */
    public function getUserLoginName(): string;

    /**
     * Returns the user password.
     *
     * @return string
     */
    public function getUserPassword(): string;
}
