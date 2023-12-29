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

namespace Hitechnix\Laratrust\Cookies
{
    use Hitechnix\Laratrust\Tests\Cookies\NativeCookieTest;

    function setcookie($name, $value, $expires, $path, $domain, $secure, $httponly)
    {
        return NativeCookieTest::$globalFunctions->setcookie(
            $name, $value, $expires, $path, $domain, $secure, $httponly
        );
    }
}

namespace Hitechnix\Laratrust\Tests\Cookies
{
    use Mockery as m;
    use PHPUnit\Framework\TestCase;
    use Hitechnix\Laratrust\Cookies\NativeCookie;

    class NativeCookieTest extends TestCase
    {
        public static $globalFunctions;

        protected function setUp(): void
        {
            self::$globalFunctions = m::mock();
        }

        protected function tearDown(): void
        {
            m::close();
        }

        /** @test */
        public function it_can_set_different_options_for_cookie()
        {
            $cookie = new NativeCookie([
                'name'      => 'foo',
                'domain'    => 'bar',
                'path'      => 'foobar',
                'secure'    => true,
                'http_only' => true,
            ]);

            self::$globalFunctions->shouldReceive('setcookie')->with(
                'foo',
                json_encode('mockCookie'),
                time() + (2628000 * 60),
                'foobar',
                'bar',
                true,
                true
            );

            $this->assertNull($cookie->put('mockCookie'));
        }

        /** @test */
        public function it_can_set_a_cookie()
        {
            $cookie = new NativeCookie('__laratrust');

            self::$globalFunctions->shouldReceive('setcookie')->with(
                '__laratrust',
                json_encode('mockCookie'),
                time() + (2628000 * 60),
                '/',
                '',
                false,
                false
            );

            $this->assertNull($cookie->put('mockCookie'));
        }

        /** @test */
        public function it_can_get_a_cookie()
        {
            $cookie = new NativeCookie('__laratrust');

            $this->assertNull($cookie->get());

            $_COOKIE['__laratrust'] = json_encode('bar');

            $this->assertSame('bar', $cookie->get());
        }

        /** @test */
        public function it_can_forget_a_cookie()
        {
            $cookie = new NativeCookie('__laratrust');

            self::$globalFunctions->shouldReceive('setcookie')->with(
                '__laratrust',
                'null',
                time() + (-2628000 * 60),
                '/',
                '',
                false,
                false
            );

            $this->assertNull($cookie->forget());
        }
    }
}
