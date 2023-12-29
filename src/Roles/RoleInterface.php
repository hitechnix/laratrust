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

namespace Hitechnix\Laratrust\Roles;

interface RoleInterface
{
    /**
     * Returns the role's primary key.
     *
     * @return int
     */
    public function getRoleId(): string;

    /**
     * Returns the role's slug.
     *
     * @return string
     */
    public function getRoleSlug(): string;

    /**
     * Returns all users for the role.
     *
     * @return \IteratorAggregate
     */
    public function getUsers(): \IteratorAggregate;

    /**
     * Returns the users model.
     *
     * @return string
     */
    public static function getUsersModel(): string;

    /**
     * Sets the users model.
     *
     * @param string $usersModel
     *
     * @return void
     */
    public static function setUsersModel(string $usersModel): void;
}
