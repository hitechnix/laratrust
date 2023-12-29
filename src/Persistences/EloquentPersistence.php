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

use Illuminate\Database\Eloquent\Model;
use Hitechnix\Laratrust\Users\EloquentUser;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EloquentPersistence extends Model implements PersistenceInterface
{
    use HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'persistences';

    /**
     * The Users model FQCN.
     *
     * @var string
     */
    protected static $usersModel = EloquentUser::class;

    /**
     * @inheritdoc
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(static::$usersModel);
    }

    /**
     * Get the Users model FQCN.
     *
     * @return string
     */
    public static function getUsersModel(): string
    {
        return static::$usersModel;
    }

    /**
     * Set the Users model FQCN.
     *
     * @param string $usersModel
     *
     * @return void
     */
    public static function setUsersModel(string $usersModel): void
    {
        static::$usersModel = $usersModel;
    }
}
