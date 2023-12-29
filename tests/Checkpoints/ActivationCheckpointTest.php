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

namespace Hitechnix\Laratrust\Tests\Checkpoints;

use Mockery as m;
use PHPUnit\Framework\TestCase;
use Hitechnix\Laratrust\Users\EloquentUser;
use Hitechnix\Laratrust\Checkpoints\ActivationCheckpoint;
use Hitechnix\Laratrust\Checkpoints\NotActivatedException;
use Hitechnix\Laratrust\Activations\IlluminateActivationRepository;

class ActivationCheckpointTest extends TestCase
{
    /**
     * The Activations repository instance.
     *
     * @var \Hitechnix\Laratrust\Activations\ActivationRepositoryInterface
     */
    protected $activations;

    /**
     * The Eloquent User instance.
     *
     * @var EloquentUser
     */
    protected $user;

    /**
     * The activation checkpoint.
     *
     * @var \Hitechnix\Laratrust\Checkpoint\ActivationCheckpoint
     */
    protected $checkpoint;

    /**
     * @inheritdoc
     */
    protected function setUp(): void
    {
        $this->activations = m::mock(IlluminateActivationRepository::class);
        $this->user        = m::mock(EloquentUser::class);
        $this->checkpoint  = new ActivationCheckpoint($this->activations);
    }

    /**
     * @inheritdoc
     */
    protected function tearDown(): void
    {
        $this->activations = null;
        $this->user        = null;
        $this->checkpoint  = null;

        m::close();
    }

    /** @test */
    public function an_activated_user_can_login()
    {
        $this->activations->shouldReceive('completed')->once()->andReturn(true);

        $status = $this->checkpoint->login($this->user);

        $this->assertTrue($status);
    }

    /** @test */
    public function an_exception_will_be_thrown_when_authenticating_a_non_activated_user()
    {
        $this->activations->shouldReceive('completed')->once()->andReturn(false);

        try {
            $this->checkpoint->check($this->user);
        } catch (NotActivatedException $e) {
            $this->assertInstanceOf(EloquentUser::class, $e->getUser());
        }
    }

    /** @test */
    public function can_return_true_when_fail_is_called()
    {
        $this->assertTrue($this->checkpoint->fail());
    }

    /** @test */
    public function an_exception_will_be_thrown_when_the_user_is_not_activated_and_determining_if_the_user_is_logged_in()
    {
        $this->expectException(NotActivatedException::class);

        $this->activations->shouldReceive('completed')->once();

        $this->checkpoint->check($this->user);
    }
}
