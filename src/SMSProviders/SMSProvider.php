<?php

namespace Messenger\SMSProviders;

interface SMSProvider
{
    /**
     * Sends an sms message.
     *
     * @param string $to
     * @param string $message
     * @return array
     */
    public function send(string $to, string $message);

    /**
     * Checks providers credentials.
     *
     * @return bool
     */
    public function isValid();
}