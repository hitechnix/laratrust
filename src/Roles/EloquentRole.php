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

namespace Hitechnix\Laratrust\Roles;

use Illuminate\Database\Eloquent\Model;
use Hitechnix\Laratrust\Users\EloquentUser;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Hitechnix\Laratrust\Permissions\PermissibleTrait;
use Hitechnix\Laratrust\Permissions\PermissibleInterface;
use Hitechnix\Laratrust\Permissions\PermissionsInterface;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class EloquentRole extends Model implements PermissibleInterface, RoleInterface
{
    use HasUuids, PermissibleTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'permissions',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'permissions' => 'json',
    ];

    /**
     * The Users model FQCN.
     *
     * @var string
     */
    protected static $usersModel = EloquentUser::class;

    /**
     * @inheritdoc
     */
    public function delete()
    {
        if ($this->exists && (! method_exists(static::class, 'isForceDeleting') || $this->isForceDeleting())) {
            $this->users()->detach();
        }

        return parent::delete();
    }

    /**
     * The Users relationship.
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(static::$usersModel, 'role_users', 'role_id', 'user_id')->withTimestamps();
    }

    /**
     * @inheritdoc
     */
    public function getRoleId(): string
    {
        return $this->getKey();
    }

    /**
     * @inheritdoc
     */
    public function getRoleSlug(): string
    {
        return $this->slug;
    }

    /**
     * @inheritdoc
     */
    public function getUsers(): \IteratorAggregate
    {
        return $this->users;
    }

    /**
     * @inheritdoc
     */
    public static function getUsersModel(): string
    {
        return static::$usersModel;
    }

    /**
     * @inheritdoc
     */
    public static function setUsersModel(string $usersModel): void
    {
        static::$usersModel = $usersModel;
    }

    /**
     * Dynamically pass missing methods to the permissions.
     *
     * @param string $method
     * @param array  $parameters
     *
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        $methods = ['hasAccess', 'hasAnyAccess'];

        if (in_array($method, $methods)) {
            $permissions = $this->getPermissionsInstance();

            return call_user_func_array([$permissions, $method], $parameters);
        }

        return parent::__call($method, $parameters);
    }

    /**
     * @inheritdoc
     */
    protected function createPermissions(): PermissionsInterface
    {
        return new static::$permissionsClass($this->getPermissions());
    }
}
