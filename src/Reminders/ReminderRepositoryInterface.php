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

namespace Hitechnix\Laratrust\Reminders;

use Hitechnix\Laratrust\Users\UserInterface;

interface ReminderRepositoryInterface
{
    /**
     * Create a new reminder record and code.
     *
     * @param UserInterface $user
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(UserInterface $user);

    /**
     * Gets the reminder for the given user.
     *
     * @param UserInterface $user
     * @param string|null   $code
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function get(UserInterface $user, string $code = null);

    /**
     * Check if a valid reminder exists.
     *
     * @param UserInterface $user
     * @param string|null   $code
     *
     * @return bool
     */
    public function exists(UserInterface $user, string $code = null): bool;

    /**
     * Complete reminder for the given user.
     *
     * @param UserInterface $user
     * @param string        $code
     * @param string        $password
     *
     * @return bool
     */
    public function complete(UserInterface $user, string $code, string $password): bool;

    /**
     * Remove expired reminder codes.
     *
     * @return bool
     */
    public function removeExpired(): bool;
}
