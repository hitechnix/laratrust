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

namespace Hitechnix\Laratrust\Tests\Permissions;

use Mockery as m;
use PHPUnit\Framework\TestCase;
use Hitechnix\Laratrust\Permissions\StrictPermissions;

class StrictPermissionsTest extends TestCase
{
    /**
     * @inheritdoc
     */
    protected function tearDown(): void
    {
        m::close();
    }

    /** @test */
    public function permissions_can_inherit_from_secondary_permissions()
    {
        $permissions = new StrictPermissions(
            ['foo' => true, 'bar' => false, 'fred' => true],
            [
                ['bar' => true],
                ['qux'  => true],
                ['fred' => false],
            ]
        );

        $this->assertTrue($permissions->hasAccess('foo'));
        $this->assertTrue($permissions->hasAccess('qux'));
        $this->assertFalse($permissions->hasAccess('bar'));
        $this->assertFalse($permissions->hasAccess('fred'));
        $this->assertFalse($permissions->hasAccess(['foo', 'bar']));

        $this->assertTrue($permissions->hasAnyAccess(['foo', 'bar']));
        $this->assertFalse($permissions->hasAnyAccess(['bar', 'fred']));
    }

    /** @test */
    public function permissions_with_wildcards_can_be_used()
    {
        $permissions = new StrictPermissions(['foo.bar' => true, 'foo.qux' => false]);

        $this->assertTrue($permissions->hasAccess('foo*'));
        $this->assertFalse($permissions->hasAccess('foo'));

        $permissions = new StrictPermissions(['foo.*' => true]);

        $this->assertTrue($permissions->hasAccess('foo.bar'));
        $this->assertTrue($permissions->hasAccess('foo.qux'));
    }

    /** @test */
    public function permissions_as_class_names_can_be_used()
    {
        $permissions = new StrictPermissions(['Class@method1,method2' => true]);

        $this->assertTrue($permissions->hasAccess('Class@method1'));
        $this->assertTrue($permissions->hasAccess('Class@method2'));
    }
}
