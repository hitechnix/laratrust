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

use Carbon\Carbon;

class ThrottlingException extends \RuntimeException
{
    /**
     * The delay, in seconds.
     *
     * @var int
     */
    protected $delay = 0;

    /**
     * The throttling type which caused the exception.
     *
     * @var string
     */
    protected $type = '';

    /**
     * Returns the delay.
     *
     * @return int
     */
    public function getDelay(): int
    {
        return $this->delay;
    }

    /**
     * Sets the delay.
     *
     * @param int $delay
     *
     * @return $this
     */
    public function setDelay(int $delay): self
    {
        $this->delay = $delay;

        return $this;
    }

    /**
     * Returns the type.
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Sets the type.
     *
     * @param string $type
     *
     * @return $this
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Returns a Carbon object representing the time which the throttle is lifted.
     *
     * @return Carbon
     */
    public function getFree(): Carbon
    {
        return Carbon::now()->addSeconds($this->delay);
    }
}
