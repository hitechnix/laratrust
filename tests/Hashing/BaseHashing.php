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

use PHPUnit\Framework\TestCase;

abstract class BaseHashing extends TestCase
{
    /**
     * The Hasher instance.
     *
     * @var \Hitechnix\Laratrust\Hashing\HasherInterface
     */
    protected $hasher;

    /**
     * @inheritdoc
     */
    protected function setUp(): void
    {
        if (! $this->hasher) {
            throw new \RuntimeException();
        }
    }

    /** @test */
    public function a_password_can_be_hashed()
    {
        $hashedValue = $this->hasher->hash('password');

        $this->assertTrue($hashedValue !== 'password');
        $this->assertTrue($this->hasher->check('password', $hashedValue));
        $this->assertFalse($this->hasher->check('fail', $hashedValue));
    }

    /** @test */
    public function a_password_that_is_not_very_long_in_length_can_be_hashed()
    {
        $hashedValue = $this->hasher->hash('foo');

        $this->assertTrue($hashedValue !== 'foo');
        $this->assertTrue($this->hasher->check('foo', $hashedValue));
        $this->assertFalse($this->hasher->check('fail', $hashedValue));
    }

    /** @test */
    public function a_password_with_utf8_characters_can_be_hashed()
    {
        $hashedValue = $this->hasher->hash('fÄÓñ');

        $this->assertTrue($hashedValue !== 'fÄÓñ');
        $this->assertTrue($this->hasher->check('fÄÓñ', $hashedValue));
    }

    /** @test */
    public function a_password_with_various_symbols_can_be_hashed()
    {
        $hashedValue = $this->hasher->hash('!"#$%^&*()-_,./:;<=>?@[]{}`~|');

        $this->assertTrue($hashedValue !== '!"#$%^&*()-_,./:;<=>?@[]{}`~|');
        $this->assertTrue($this->hasher->check('!"#$%^&*()-_,./:;<=>?@[]{}`~|', $hashedValue));
    }
}
