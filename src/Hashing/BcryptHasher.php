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

class BcryptHasher implements HasherInterface
{
    use Hasher;

    /**
     * The hash strength.
     *
     * @var int
     */
    public $strength = 8;

    /**
     * @inheritdoc
     */
    public function hash(string $value): string
    {
        $salt = $this->createSalt();

        $strength = str_pad($this->strength, 2, '0', STR_PAD_LEFT);

        $prefix = '$2y$';

        return crypt($value, $prefix.$strength.'$'.$salt.'$');
    }

    /**
     * @inheritdoc
     */
    public function check(string $value, string $hashedValue): bool
    {
        return $this->slowEquals(crypt($value, $hashedValue), $hashedValue);
    }
}
