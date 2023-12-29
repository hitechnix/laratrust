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

use Hitechnix\Support\Traits\RepositoryTrait;

class IlluminateRoleRepository implements RoleRepositoryInterface
{
    use RepositoryTrait;

    /**
     * The Eloquent role model FQCN.
     *
     * @var string
     */
    protected $model = EloquentRole::class;

    /**
     * Create a new Illuminate role repository.
     *
     * @param string $model
     *
     * @return void
     */
    public function __construct(string $model = null)
    {
        $this->model = $model;
    }

    /**
     * @inheritdoc
     */
    public function findById(int $id): ?RoleInterface
    {
        return $this->createModel()->newQuery()->find($id);
    }

    /**
     * @inheritdoc
     */
    public function findBySlug(string $slug): ?RoleInterface
    {
        return $this->createModel()->newQuery()->where('slug', $slug)->first();
    }

    /**
     * @inheritdoc
     */
    public function findByName(string $name): ?RoleInterface
    {
        return $this->createModel()->newQuery()->where('name', $name)->first();
    }
}
