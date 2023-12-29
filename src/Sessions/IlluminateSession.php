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

namespace Hitechnix\Laratrust\Sessions;

use Illuminate\Session\Store as SessionStore;

class IlluminateSession implements SessionInterface
{
    /**
     * The session store object.
     *
     * @var SessionStore
     */
    protected $session;

    /**
     * The session key.
     *
     * @var string
     */
    protected $key = 'hitechnix_laratrust';

    /**
     * Constructor.
     *
     * @param SessionStore $session
     * @param string       $key
     *
     * @return void
     */
    public function __construct(SessionStore $session, string $key = null)
    {
        $this->session = $session;

        $this->key = $key;
    }

    /**
     * @inheritdoc
     */
    public function put($value): void
    {
        $this->session->put($this->key, $value);
    }

    /**
     * @inheritdoc
     */
    public function get()
    {
        return $this->session->get($this->key);
    }

    /**
     * @inheritdoc
     */
    public function forget(): void
    {
        $this->session->forget($this->key);
    }
}
