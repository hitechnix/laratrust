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
use Hitechnix\Laratrust\Permissions\StandardPermissions;

class StandardPermissionsTest extends TestCase
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
        $primaryPermissions = ['user.create' => true, 'user.update' => false, 'user.delete' => true];

        $secondaryPermissions = [
            ['user.update' => true],
            ['user.view'   => true],
            ['user.delete' => false],
        ];

        $permissions = new StandardPermissions($primaryPermissions, $secondaryPermissions);

        $this->assertTrue($permissions->hasAccess('user.create'));
        $this->assertTrue($permissions->hasAccess('user.view'));
        $this->assertTrue($permissions->hasAccess('user.delete'));
        $this->assertFalse($permissions->hasAccess('user.update'));
        $this->assertFalse($permissions->hasAccess(['user.create', 'user.update']));

        $this->assertTrue($permissions->hasAnyAccess(['user.create', 'user.update']));
        $this->assertTrue($permissions->hasAnyAccess(['user.update', 'user.delete']));
    }

    /** @test */
    public function permissions_with_wildcards_can_be_used()
    {
        $permissions = new StandardPermissions(['user.create' => true, 'user.update' => false]);

        $this->assertTrue($permissions->hasAccess('user*'));
        $this->assertFalse($permissions->hasAccess('user'));

        $permissions = new StandardPermissions(['user.*' => true]);

        $this->assertTrue($permissions->hasAccess('user.create'));
        $this->assertTrue($permissions->hasAccess('user.update'));
    }

    /** @test */
    public function permissions_as_class_names_can_be_used()
    {
        $permissions = new StandardPermissions(['Class@method1,method2' => true]);

        $this->assertTrue($permissions->hasAccess('Class@method1'));
        $this->assertTrue($permissions->hasAccess('Class@method2'));
    }
}
