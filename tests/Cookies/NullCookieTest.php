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

namespace Hitechnix\Laratrust\Tests\Cookies;

use PHPUnit\Framework\TestCase;
use Hitechnix\Laratrust\Cookies\NullCookie;

class NullCookieTest extends TestCase
{
    /**
     * The cookie instance.
     *
     * @var NullCookie
     */
    protected $cookie;

    /**
     * @inheritdoc
     */
    protected function setUp(): void
    {
        $this->cookie = new NullCookie();
    }

    /**
     * @inheritdoc
     */
    protected function tearDown(): void
    {
        $this->cookie = null;
    }

    /** @test */
    public function it_can_put_a_cookie()
    {
        $this->assertNull($this->cookie->put('cookie'));
    }

    /** @test */
    public function it_can_get_a_cookie()
    {
        $this->assertNull($this->cookie->get());
    }

    /** @test */
    public function it_can_forget_a_cookie()
    {
        $this->assertNull($this->cookie->forget());
    }
}
