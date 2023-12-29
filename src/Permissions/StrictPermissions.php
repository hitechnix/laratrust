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

class StrictPermissions implements PermissionsInterface
{
    use PermissionsTrait;

    /**
     * @inheritdoc
     */
    protected function createPreparedPermissions(): array
    {
        $prepared = [];

        if (! empty($this->getSecondaryPermissions())) {
            foreach ($this->getSecondaryPermissions() as $permissions) {
                $this->preparePermissions($prepared, $permissions);
            }
        }

        if (! empty($this->getPermissions())) {
            $this->preparePermissions($prepared, $this->getPermissions());
        }

        return $prepared;
    }
}
