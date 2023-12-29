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

namespace Hitechnix\Laratrust\Tests\Activations;

use Mockery as m;
use PHPUnit\Framework\TestCase;
use Hitechnix\Laratrust\Activations\EloquentActivation;

class EloquentActivationTest extends TestCase
{
    /**
     * The Activation Eloquent instance.
     *
     * @var EloquentActivation
     */
    protected $activation;

    /**
     * @inheritdoc
     */
    protected function setUp(): void
    {
        $this->activation = new EloquentActivation();
    }

    /**
     * @inheritdoc
     */
    protected function tearDown(): void
    {
        $this->activation = null;

        m::close();
    }

    /** @test */
    public function it_can_get_the_completed_attribute_as_a_boolean()
    {
        $this->activation->completed = 1;

        $this->assertTrue($this->activation->completed);
    }

    /** @test */
    public function it_can_get_the_activation_code_using_the_getter()
    {
        $this->activation->code = 'foo';

        $this->assertSame('foo', $this->activation->getCode());
    }
}
