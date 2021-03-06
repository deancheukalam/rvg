<?php
/**
 * @package    Stiphle
 * @subpackage Stiphle\Throttle\LeakyBucket\Storage
 */
//namespace Stiphle\Storage;

/**
 * This file is part of Stiphle
 *
 * Copyright (c) 2011 Dave Marshall <dave.marshall@atstsolutuions.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Use Apcu as the storage, I hope apcu_add is atomic and therefore we wont get
 * any race conditions with the locking....
 *
 * @author      Robert Harm
 */
class LMM_Apcu implements StorageInterface
{
    /**
     * @var int
     */
    protected $lockWaitTimeout = 1000;

    /**
     * @var int  Time to sleep when attempting to get lock in microseconds
     */
    protected $sleep = 100;

    /**
     * @var int 
     */
    protected $ttl = 10000000;

    /**
     * Set lock wait timeout
     *
     * @param int $milliseconds
     */
    public function setLockWaitTimeout($milliseconds)
    {
        $this->lockWaitTimeout = $milliseconds;
        return;
    }

    /**
     * Set the sleep time in microseconds
     *
     * @param int 
     * @return void
     */
    public function setSleep($microseconds)
    {
        $this->sleep = $microseconds;
        return;
    }

    /**
     * Set the ttl for the apc records in seconds
     *
     * @param int $seconds
     * @return void
     */
    public function setTtl($microseconds)
    {
        $this->ttl = $microseconds;
        return;
    }

    /**
     * Lock 
     *
     * If we're using storage, we might have multiple requests coming in at
     * once, so we lock the storage
     *
     * @return void
     */
    public function lock($key)
    {
        $key = $key . "::LOCK";
        $start = microtime(true);
        while(!apcu_add($key, true, $this->ttl)) {
            $passed = (microtime(true) - $start) * 1000;
            if ($passed > $this->lockWaitTimeout) {
                throw new LockWaitTimeoutException();
            }
            usleep($this->sleep);
        }

        return;
    }

    /**
     * Unlock
     *
     * @return void
     */
    public function unlock($key)
    {
        $key = $key . "::LOCK";
        apcu_delete($key);
    }

    /**
     * Get last modified
     *
     * @param string $key
     * @return int
     */
    public function get($key)
    {
        return apcu_fetch($key);
    }

    /**
     * set 
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function set($key, $value)
    {
        apcu_store($key, $value, $this->ttl);
        return;
    }

}