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

namespace Hitechnix\Laratrust\Permissions;

interface PermissibleInterface
{
    /**
     * Returns the Permissions instance.
     *
     * @return PermissionsInterface
     */
    public function getPermissionsInstance(): PermissionsInterface;

    /**
     * Adds a permission.
     *
     * @param string $permission
     * @param bool   $value
     *
     * @return PermissibleInterface
     */
    public function addPermission(string $permission, bool $value = true): PermissibleInterface;

    /**
     * Updates a permission.
     *
     * @param string $permission
     * @param bool   $value
     * @param bool   $create
     *
     * @return PermissibleInterface
     */
    public function updatePermission(string $permission, bool $value = true, bool $create = false): PermissibleInterface;

    /**
     * Removes a permission.
     *
     * @param string $permission
     *
     * @return PermissibleInterface
     */
    public function removePermission(string $permission): PermissibleInterface;
}
