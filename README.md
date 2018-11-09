# Messenger 📨

A PHP library for sending messages.

[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.0-8892BF.svg)](https://php.net/)
[![License](https://poser.pugx.org/alaninchika/messenger/license.svg)](https://packagist.org/packages/alaninchika/messenger)
[![Latest Stable Version](https://img.shields.io/packagist/v/alaninchika/messenger.svg)](https://packagist.org/packages/alaninchika/messenger)
[![Total Downloads](https://poser.pugx.org/alaninchika/messenger/downloads.svg)](https://packagist.org/packages/alaninchika/messenger)
[![Build Status](https://travis-ci.com/alaninchika/messenger.svg?branch=master)](https://travis-ci.com/alaninchika/messenger)
[![Code Coverage](https://scrutinizer-ci.com/g/alaninchika/messenger/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/alaninchika/messenger/?branch=master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/alaninchika/messenger/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/alaninchika/messenger/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/alaninchika/messenger/?branch=master)

## Installation

```
$ composer require alaninchika/messenger
```

Or add to `composer.json`:

```
"require": {
    "alaninchika/messenger": "^1.0.0"
}
```

and then run composer update.

Alternatively you can clone or download the library files.

# SMS Configuration (register a provider)

```php
use Messenger\SMSMessenger;
$smsMessenger = new SMSMessenger();

// Your Account SID and Auth Token from twilio.com/console
$account_sid = 'ACXXXXXXXXXXXXXXXXXXXXXXXXXXXX';
$auth_token = 'your_auth_token';
$twilio_number = "+15017122661";

$twilio = new TwilioSMS($account_sid, $auth_token, $twilio_number);
$smsMessenger->registerSMSProvider('twilio', $twilio);
```

```php
use Messenger\SMSMessenger;
$smsMessenger = new SMSMessenger();

$sns_client = new SnsClient([
    'region'  => 'eu-west-1',
    'version' => 'latest',
    'credentials' => [
        'key' => 'AWS_ACCESS_KEY_ID',
        'secret' => 'AWS_SECRET_ACCESS_KEY',
    ]
]);

$sns = new SnsSMS($sns_client, 'SNS_TOPIC');
$smsMessenger->registerSMSProvider('sns', $sns);
```

## SMS Usages

```php
// Sending sms message with any registered provider
$result = $smsMessenger->sendMessage('15017122664', 'test message');

// Sending sms message with a specific registered provider 
$result = $smsMessenger->sendMessageWith('sns', '15017122662', 'test message');

// Success result
['provider' => 'sns', 'result' => ['message_id' => 'e234-11e8', 'sent' => true]]

// Failed result
['provider' => 'sns', 'result' => ['error' => 'error message', 'sent' => false]]
```

## Contribute

- [Guide: CONTRIBUTING.md](https://github.com/alaninchika/messenger/blob/master/CONTRIBUTING.md)
- [Issue Tracker: github.com/alaninchika/messenger](https://github.com/alaninchika/messenger/issues)
- [Source Code:  github.com/alaninchika/messenger](https://github.com/alaninchika/messenger)

You can find more about contributing in [CONTRIBUTING.md](CONTRIBUTING.md).

## License

[MIT License](LICENSE)
