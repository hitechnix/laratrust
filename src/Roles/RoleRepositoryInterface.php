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

interface RoleRepositoryInterface
{
    /**
     * Finds a role by the given primary key.
     *
     * @param int $id
     *
     * @return RoleInterface|null
     */
    public function findById(int $id): ?RoleInterface;

    /**
     * Finds a role by the given slug.
     *
     * @param string $slug
     *
     * @return RoleInterface|null
     */
    public function findBySlug(string $slug): ?RoleInterface;

    /**
     * Finds a role by the given name.
     *
     * @param string $name
     *
     * @return RoleInterface|null
     */
    public function findByName(string $name): ?RoleInterface;
}
