<?php

namespace Messenger\SMSProviders;

use Twilio\Rest\Client;

class TwilioSMS implements SMSProvider
{
    /**
     * @var Client
     */
    var $client;

    /**
     * @var string
     */
    var $sid;

    /**
     * @var string
     */
    var $number;

    /**
     * TwilioMessage constructor.
     *
     * @param $sid
     * @param $token
     * @param $number
     * @throws \Twilio\Exceptions\ConfigurationException
     */
    public function __construct($sid, $token, $number)
    {
        $this->client = new Client($sid, $token);
        $this->sid = $sid;
        $this->number = $number;
    }

    /**
     * Sends an sms message.
     *
     * @param string $to
     * @param string $message
     * @return array
     */
    public function send(string $to, string $message)
    {
        try {
            $result = $this
                ->client
                ->messages
                ->create('+' . $to, ['from' => $this->number, 'body' => $message]);

            $sid = $result->sid;
        } catch (\Exception $e) {
            return [
                'error' => 'Error sending SMS: ' . $e->getMessage(),
                'sent' => false,
            ];
        }

        if (empty($sid)) {
            return [
                'error' => 'Error sending SMS: Unknown error',
                'sent' => false,
            ];
        }

        return [
            'message_id' => $sid,
            'sent' => true,
        ];
    }

    /**
     * Checks providers credentials.
     *
     * @return bool
     */
    public function isValid()
    {
        try {
            $account = $this->client->api->v2010->accounts($this->sid)->fetch();

            if ($account) {
                return true;
            }
        } catch (\Exception $e) {
            return false;
        }

        return false;
    }
}