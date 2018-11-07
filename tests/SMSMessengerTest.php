<?php

namespace Messenger;

use Messenger\SMSProviders\SMSProvider;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class SMSMessengerTest extends TestCase
{
    /**
     * @var SMSMessenger
     */
    private $smsMessenger;

    /**
     * @var SMSProvider|MockObject
     */
    private $smsProvider;

    public function setUp()
    {
        $this->smsMessenger = new SMSMessenger();
        parent::setUp();
    }

    public function tearDown()
    {
        $this->smsMessenger = null;
    }

    public function testRegisterSMSProvider()
    {
        $this->smsProvider = $this->getMockBuilder(SMSProvider::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->smsMessenger->registerSMSProvider('twilio', $this->smsProvider);

        $this->assertCount(1, $this->smsMessenger->smsProviders());
    }

    public function testSendMessageWith()
    {
        $this->smsProvider = $this->getMockBuilder(SMSProvider::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->smsProvider->method('isValid')->willReturn(true);
        $this->smsProvider->method('send')->willReturn(
            [
                'message_id' => 'e234-11e8-0242ac120005',
                'sent' => true,
            ]
        );

        $this
            ->smsProvider
            ->expects($this->once())
            ->method('send')
            ->with(
                $this->callback(function($to) {
                    return
                        $to == '123456710';
                }),
                $this->callback(function($message) {
                    return
                        $message == 'test message';
                })
            );

        $this->smsMessenger->registerSMSProvider('twilio', $this->smsProvider);
        $result = $this->smsMessenger->sendMessageWith('twilio', '123456710', 'test message');

        $this->assertSame('twilio', $result['provider']);
        $this->assertSame('e234-11e8-0242ac120005', $result['result']['message_id']);
        $this->assertTrue($result['result']['sent']);
    }

    public function testSendMessage()
    {
        $this->smsProvider = $this->getMockBuilder(SMSProvider::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->smsProvider->method('isValid')->willReturn(true);
        $this->smsProvider->method('send')->willReturn(
            [
                'message_id' => 'e234-11e8-0242ac120006',
                'sent' => true,
            ]
        );

        $this
            ->smsProvider
            ->expects($this->once())
            ->method('send')
            ->with(
                $this->callback(function($to) {
                    return
                        $to == '123456789';
                }),
                $this->callback(function($message) {
                    return
                        $message == 'test message';
                })
            );

        $this->smsMessenger->registerSMSProvider('inspirus_maybe', $this->smsProvider);
        $result = $this->smsMessenger->sendMessage('123456789', 'test message');

        $this->assertSame('inspirus_maybe', $result['provider']);
        $this->assertSame('e234-11e8-0242ac120006', $result['result']['message_id']);
        $this->assertTrue($result['result']['sent']);
    }
}