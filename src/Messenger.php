<?php

namespace Messenger;

use Messenger\SMSProviders\SMSProvider;

abstract class Messenger
{
    /**
     * @var SMSProvider[]
     */
    protected $smsProviders = [];

    /**
     * Registers SMS provider with a given name.
     *
     * @param string      $name
     * @param SMSProvider $provider
     * @throws \Exception
     */
    public function registerSMSProvider(string $name, SMSProvider $provider)
    {
        $this->smsProviders[$name] = $provider;
    }
}