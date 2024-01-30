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

namespace Hitechnix\Laratrust\Sessions;

interface SessionInterface
{
    /**
     * Put a value in the Laratrust session.
     *
     * @param mixed $value
     *
     * @return void
     */
    public function put($value): void;

    /**
     * Returns the Laratrust session value.
     *
     * @return mixed
     */
    public function get();

    /**
     * Removes the Laratrust session.
     *
     * @return void
     */
    public function forget(): void;
}
