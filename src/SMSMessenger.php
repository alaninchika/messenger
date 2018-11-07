<?php

namespace Messenger;

use Messenger\SMSProviders\SMSProvider;

class SMSMessenger extends Messenger
{
    /**
     * Sends an sms message with a given provider if they have been registered.
     *
     * @param string $providerName
     * @param string $to
     * @param string $message
     * @return array
     */
    public function sendMessageWith(string $providerName, string $to, string $message)
    {
        $result = array(
            'provider' => $providerName,
            'result' => [
                'sent' => false
            ]
        );

        if (isset($this->smsProviders[$providerName])) {
            $provider = $this->smsProviders[$providerName];

            if (!$provider->isValid()) {
                $result['result']['error'] = 'Invalid credentials';
                return $result;
            }

            $result['result'] = $provider->send($to, $message);
        }

        return $result;
    }

    /**
     * Sends an sms message.
     *
     * @param string $to
     * @param string $message
     * @return array
     */
    public function sendMessage(string $to, string $message)
    {
        $result = array(
            'provider' => 'Empty providers',
            'result' => [
                'sent' => false
            ]
        );

        foreach ($this->smsProviders() as $name => $provider) {
            $result['provider'] = $name;

            if (!$provider->isValid()) {
                $result['result']['error'] = 'Invalid credentials';
            } else {
                $result['result'] = $provider->send($to, $message);
            }

            return $result;
        }

        return $result;
    }

    /**
     * Returns all sms providers.
     *
     * @return SMSProvider[]
     */
    public function smsProviders()
    {
        return $this->smsProviders;
    }
}