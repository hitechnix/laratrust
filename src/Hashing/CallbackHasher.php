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

class CallbackHasher implements HasherInterface
{
    /**
     * The closure used for hashing a value.
     *
     * @var \Closure
     */
    protected $hash;

    /**
     * The closure used for checking a hashed value.
     *
     * @var \Closure
     */
    protected $check;

    /**
     * Constructor.
     *
     * @param \Closure $hash
     * @param \Closure $check
     *
     * @return void
     */
    public function __construct(\Closure $hash, \Closure $check)
    {
        $this->hash = $hash;

        $this->check = $check;
    }

    /**
     * @inheritdoc
     */
    public function hash(string $value): string
    {
        $callback = $this->hash;

        return $callback($value);
    }

    /**
     * @inheritdoc
     */
    public function check(string $value, string $hashedValue): bool
    {
        $callback = $this->check;

        return $callback($value, $hashedValue);
    }
}
