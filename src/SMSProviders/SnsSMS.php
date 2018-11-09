<?php

namespace Messenger\SMSProviders;

use Aws\Sns\SnsClient;

class SnsSMS implements SMSProvider
{
    /**
     * @var SnsClient
     */
    private $client;

    /**
     * @var string
     */
    private $sender;

    /**
     * SnsSMS constructor.
     *
     * @param SnsClient $client
     * @param string    $sender
     */
    function __construct(SnsClient $client, string $sender)
    {
        $this->client = $client;
        $this->sender = $sender;
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
            if (empty($this->sender)) {
                return [
                    'error' => 'Error sending SMS: Unknown error',
                    'sent' => false,
                ];
            }

            $data = $this->client->publish([
                'Message' => $message,
                'PhoneNumber' => '+' . $to,
                'MessageAttributes' => [
                    'AWS.SNS.SMS.SenderID' => [
                        'DataType' => 'String',
                        'StringValue' => $this->sender
                    ],
                    'AWS.SNS.SMS.SMSType'  => [
                        'DataType'    => 'String',
                        'StringValue' => 'Transactional',
                    ]
                ]
            ]);

            $data = $data->toArray();

            if (empty($data) || empty($data['MessageId'])) {
                return [
                    'error' => 'Error sending SMS: Unknown error',
                    'sent' => false,
                ];
            }

            return [
                'message_id' => $data['MessageId'],
                'sent' => true,
            ];
        } catch (\Exception $e) {
            return [
                'error' => 'Error sending SMS: ' . $e->getMessage(),
                'sent' => false,
            ];
        }
    }

    /**
     * Checks providers credentials.
     *
     * @return bool
     */
    public function isValid()
    {
        if (empty($this->client->listSubscriptions())) {
            return false;
        }

        return true;
    }
}