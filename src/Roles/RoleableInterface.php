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

interface RoleableInterface
{
    /**
     * Returns all the associated roles.
     *
     * @return \IteratorAggregate
     */
    public function getRoles(): \IteratorAggregate;

    /**
     * Checks if the user is in the given role.
     *
     * @param mixed $role
     *
     * @return bool
     */
    public function inRole($role): bool;

    /**
     * Checks if the user is in any of the given roles.
     *
     * @param array $roles
     *
     * @return bool
     */
    public function inAnyRole(array $roles): bool;
}
