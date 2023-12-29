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

namespace Hitechnix\Laratrust\Cookies;

use Illuminate\Http\Request;
use Illuminate\Cookie\CookieJar;

class IlluminateCookie implements CookieInterface
{
    /**
     * The current request.
     *
     * @var Request
     */
    protected $request;

    /**
     * The cookie object.
     *
     * @var CookieJar
     */
    protected $jar;

    /**
     * The cookie key.
     *
     * @var string
     */
    protected $key = 'hitechnix_laratrust';

    /**
     * Constructor.
     *
     * @param Request   $request
     * @param CookieJar $jar
     * @param string    $key
     *
     * @return void
     */
    public function __construct(Request $request, CookieJar $jar, $key = null)
    {
        $this->request = $request;

        $this->jar = $jar;

        if (isset($key)) {
            $this->key = $key;
        }
    }

    /**
     * @inheritdoc
     */
    public function put($value): void
    {
        $cookie = $this->jar->forever($this->key, $value);

        $this->jar->queue($cookie);
    }

    /**
     * @inheritdoc
     */
    public function get()
    {
        $key = $this->key;

        // Cannot use $this->jar->queued($key, function()) because it's not
        // available in 4.0.*, only 4.1+
        $queued = $this->jar->getQueuedCookies();

        if (isset($queued[$key])) {
            return $queued[$key]->getValue();
        }

        return $this->request->cookie($key);
    }

    /**
     * @inheritdoc
     */
    public function forget(): void
    {
        $cookie = $this->jar->forget($this->key);

        $this->jar->queue($cookie);
    }
}
