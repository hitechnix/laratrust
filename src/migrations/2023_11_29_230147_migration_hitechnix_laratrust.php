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

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationHitechnixLaratrust extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('code');
            $table->boolean('completed')->default(false);
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
        });

        Schema::create('persistences', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('code')->unique();
            $table->timestamps();

            $table->engine = 'InnoDB';
        });

        Schema::create('reminders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('code');
            $table->boolean('completed')->default(false);
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('slug')->unique();
            $table->string('name');
            $table->text('permissions')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
        });

        Schema::create('role_users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('role_id');
            $table->nullableTimestamps();

            $table->primary(['user_id', 'role_id']);
            $table->engine = 'InnoDB';
        });

        Schema::create('throttle', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->nullable();
            $table->string('type');
            $table->string('ip')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
        });

        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->text('permissions')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('activations');
        Schema::drop('persistences');
        Schema::drop('reminders');
        Schema::drop('roles');
        Schema::drop('role_users');
        Schema::drop('throttle');
        Schema::drop('users');
    }
}
