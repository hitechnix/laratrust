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

namespace Hitechnix\Laratrust\Tests\Sessions;

use Mockery as m;
use Illuminate\Session\Store;
use PHPUnit\Framework\TestCase;
use Hitechnix\Laratrust\Sessions\IlluminateSession;

class IlluminateSessionTest extends TestCase
{
    /**
     * @inheritdoc
     */
    protected function tearDown(): void
    {
        m::close();
    }

    /** @test */
    public function it_can_put_a_value_on_session()
    {
        $store = m::mock(Store::class);
        $store->shouldReceive('put')->with('foo', 'bar')->once();
        $store->shouldReceive('get')->once()->andReturn('bar');

        $session = new IlluminateSession($store, 'foo');

        $session->put('bar');

        $this->assertSame('bar', $session->get());
    }

    /** @test */
    public function it_can_get_a_value_from_session()
    {
        $store = m::mock(Store::class);
        $store->shouldReceive('get')->with('foo')->once()->andReturn('bar');

        $session = new IlluminateSession($store, 'foo');

        $this->assertSame('bar', $session->get());
    }

    /** @test */
    public function it_can_forget_a_value_from_the_session()
    {
        $store = m::mock(Store::class);
        $store->shouldReceive('forget')->with('foo')->once();
        $store->shouldReceive('get')->once()->andReturn(null);

        $session = new IlluminateSession($store, 'foo');

        $session->forget();

        $this->assertNull($session->get());
    }
}
