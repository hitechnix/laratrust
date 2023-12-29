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

namespace Hitechnix\Laratrust\Hashing;

interface HasherInterface
{
    /**
     * Hash the given value.
     *
     * @param string $value
     *
     * @throws \RuntimeException
     *
     * @return string
     */
    public function hash(string $value): string;

    /**
     * Checks the string against the hashed value.
     *
     * @param string $value
     * @param string $hashedValue
     *
     * @return bool
     */
    public function check(string $value, string $hashedValue): bool;
}
