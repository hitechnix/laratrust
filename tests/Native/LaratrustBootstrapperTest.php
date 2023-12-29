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

namespace Hitechnix\Laratrust\Tests\Native;

use PHPUnit\Framework\TestCase;
use Hitechnix\Laratrust\Laratrust;
use Hitechnix\Laratrust\Native\LaratrustBootstrapper;

class LaratrustBootstrapperTest extends TestCase
{
    /** @test */
    public function it_can_be_instantiated()
    {
        $bootstrapper = new LaratrustBootstrapper();

        $laratrust = $bootstrapper->createLaratrust();

        $this->assertInstanceOf(Laratrust::class, $laratrust);
    }
}
