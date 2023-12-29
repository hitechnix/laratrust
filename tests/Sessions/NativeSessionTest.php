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
use PHPUnit\Framework\TestCase;
use Hitechnix\Laratrust\Sessions\NativeSession;

class NativeSessionTest extends TestCase
{
    /**
     * @inheritdoc
     */
    protected function tearDown(): void
    {
        m::close();
    }

    /**
     * @test
     *
     * @runInSeparateProcess
     */
    public function it_can_start_the_session()
    {
        $session = new NativeSession('__laratrust');

        $this->assertInstanceOf(NativeSession::class, $session);
    }

    /** @test */
    public function it_can_put_a_value_on_session()
    {
        $session = new NativeSession('__laratrust');

        $class      = new \stdClass();
        $class->foo = 'bar';

        $session->put($class);

        $this->assertSame(serialize($class), $_SESSION['__laratrust']);

        unset($_SESSION['__laratrust']);
    }

    /** @test */
    public function it_can_get_a_value_from_session()
    {
        $session = new NativeSession('__laratrust');

        $this->assertNull($session->get());

        $class      = new \stdClass();
        $class->foo = 'bar';

        $_SESSION['__laratrust'] = serialize($class);

        $this->assertNotNull($session->get());

        unset($_SESSION['__laratrust']);
    }

    /** @test */
    public function it_can_forget_a_value_from_the_session()
    {
        $session = new NativeSession('__laratrust');

        $_SESSION['__laratrust'] = 'bar';

        $this->assertSame('bar', $_SESSION['__laratrust']);

        $session->forget();

        $this->assertFalse(isset($_SESSION['__laratrust']));
    }
}
