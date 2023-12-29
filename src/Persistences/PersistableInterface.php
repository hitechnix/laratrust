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

namespace Hitechnix\Laratrust\Persistences;

interface PersistableInterface
{
    /**
     * Returns the persistable key value.
     *
     * @return string
     */
    public function getPersistableId(): string;

    /**
     * Returns the persistable key name.
     *
     * @return string
     */
    public function getPersistableKey(): string;

    /**
     * Set the persistable key.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function setPersistableKey(string $key);

    /**
     * Returns the persistable relationship name.
     *
     * @return string
     */
    public function getPersistableRelationship(): string;

    /**
     * Set the persistable relationship.
     *
     * @param string $persistableRelationship
     *
     * @return mixed
     */
    public function setPersistableRelationship(string $persistableRelationship);

    /**
     * Generates a random persist code.
     *
     * @return string
     */
    public function generatePersistenceCode(): string;
}
