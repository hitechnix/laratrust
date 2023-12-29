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

class WhirlpoolHasher implements HasherInterface
{
    use Hasher;

    /**
     * @inheritdoc
     */
    public function hash(string $value): string
    {
        $salt = $this->createSalt();

        return $salt.hash('whirlpool', $salt.$value);
    }

    /**
     * @inheritdoc
     */
    public function check(string $value, string $hashedValue): bool
    {
        $salt = substr($hashedValue, 0, $this->saltLength);

        return $this->slowEquals($salt.hash('whirlpool', $salt.$value), $hashedValue);
    }
}
