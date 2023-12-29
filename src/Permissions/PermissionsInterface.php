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

interface PermissionsInterface
{
    /**
     * Returns if access is available for all given permissions.
     *
     * @param array|string $permissions
     *
     * @return bool
     */
    public function hasAccess($permissions): bool;

    /**
     * Returns if access is available for any given permissions.
     *
     * @param array|string $permissions
     *
     * @return bool
     */
    public function hasAnyAccess($permissions): bool;
}
