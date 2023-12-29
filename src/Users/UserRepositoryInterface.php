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

namespace Hitechnix\Laratrust\Users;

interface UserRepositoryInterface
{
    /**
     * Finds a user by the given primary key.
     *
     * @param string $id
     *
     * @return UserInterface|null
     */
    public function findById(string $id): ?UserInterface;

    /**
     * Finds a user by the given credentials.
     *
     * @param array $credentials
     *
     * @return UserInterface|null
     */
    public function findByCredentials(array $credentials): ?UserInterface;

    /**
     * Finds a user by the given persistence code.
     *
     * @param string $code
     *
     * @return UserInterface|null
     */
    public function findByPersistenceCode(string $code): ?UserInterface;

    /**
     * Records a login for the given user.
     *
     * @param UserInterface $user
     *
     * @return bool
     */
    public function recordLogin(UserInterface $user): bool;

    /**
     * Records a logout for the given user.
     *
     * @param UserInterface $user
     *
     * @return bool
     */
    public function recordLogout(UserInterface $user): bool;

    /**
     * Validate the password of the given user.
     *
     * @param UserInterface $user
     * @param array         $credentials
     *
     * @return bool
     */
    public function validateCredentials(UserInterface $user, array $credentials): bool;

    /**
     * Validate if the given user is valid for creation.
     *
     * @param array $credentials
     *
     * @return bool
     */
    public function validForCreation(array $credentials): bool;

    /**
     * Validate if the given user is valid for updating.
     *
     * @param int|UserInterface $user
     * @param array             $credentials
     *
     * @return bool
     */
    public function validForUpdate($user, array $credentials): bool;

    /**
     * Creates a user.
     *
     * @param array         $credentials
     * @param \Closure|null $callback
     *
     * @return UserInterface|null
     */
    public function create(array $credentials, \Closure $callback = null): ?UserInterface;

    /**
     * Updates a user.
     *
     * @param int|UserInterface $user
     * @param array             $credentials
     *
     * @return UserInterface
     */
    public function update($user, array $credentials): UserInterface;
}
