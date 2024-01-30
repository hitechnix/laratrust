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

trait AuthenticatedCheckpoint
{
    /**
     * @inheritdoc
     */
    public function fail(UserInterface $user = null): bool
    {
        return true;
    }
}
