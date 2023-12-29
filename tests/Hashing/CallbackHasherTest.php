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

namespace Hitechnix\Laratrust\Tests\Hashing;

use Hitechnix\Laratrust\Hashing\CallbackHasher;

class CallbackHasherTest extends BaseHashing
{
    /**
     * @inheritdoc
     */
    protected function setUp(): void
    {
        // Never use this hashing strategy!
        $hash = function ($value) {
            return strrev($value);
        };

        $check = function ($value, $hashedValue) {
            return strrev($value) === $hashedValue;
        };

        $this->hasher = new CallbackHasher($hash, $check);

        parent::setUp();
    }
}
