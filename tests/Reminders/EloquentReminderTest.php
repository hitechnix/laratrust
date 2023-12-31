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

namespace Hitechnix\Laratrust\Tests\Reminders;

use Mockery as m;
use PHPUnit\Framework\TestCase;
use Hitechnix\Laratrust\Reminders\EloquentReminder;

class EloquentReminderTest extends TestCase
{
    /**
     * @inheritdoc
     */
    protected function tearDown(): void
    {
        m::close();
    }

    /** @test */
    public function it_can_get_the_completed_attribute_as_a_boolean()
    {
        $reminder = new EloquentReminder();

        $reminder->completed = 1;

        $this->assertTrue($reminder->completed);
    }
}
