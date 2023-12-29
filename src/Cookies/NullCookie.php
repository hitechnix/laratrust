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

namespace Hitechnix\Laratrust\Cookies;

class NullCookie implements CookieInterface
{
    /**
     * Put a value in the Laratrust cookie (to be stored until it's cleared).
     *
     * @param mixed $value
     *
     * @return void
     */
    public function put($value): void
    {
    }

    /**
     * Returns the Laratrust cookie value.
     *
     * @return mixed
     */
    public function get()
    {
        return null;
    }

    /**
     * Remove the Laratrust cookie.
     *
     * @return void
     */
    public function forget(): void
    {
    }
}
