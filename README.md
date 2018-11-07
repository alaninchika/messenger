# Messenger 📨

A PHP library for sending messages.

[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.0-8892BF.svg)](https://php.net/)
[![Latest Stable Version](https://img.shields.io/packagist/v/alaninchika/messenger.svg)](https://packagist.org/packages/alaninchika/messenger)
[![Build Status](https://travis-ci.org/alaninchika/messenger.svg?branch=master)](https://travis-ci.org/alaninchika/messenger)
[![Total Downloads](https://poser.pugx.org/alaninchika/messenger/downloads.svg)](https://packagist.org/packages/alaninchika/messenger)
[![License](https://poser.pugx.org/alaninchika/messenger/license.svg)](https://packagist.org/packages/alaninchika/messenger)
[![Coverage Status](https://coveralls.io/repos/github/alaninchika/messenger/badge.svg?branch=master)](https://coveralls.io/github/alaninchika/messenger?branch=master)
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

## SMS Usages

```php
// Sending sms message with any registered provider
$result = $smsMessenger->sendMessage('15017122664', 'test message');

// Sending sms message with a specific provider that is registered
$result = $smsMessenger->sendMessageWith('registered_provider', '15017122662', 'test message');

// Success result
['provider' => 'registered_provider', 'result' => ['message_id' => 'e234-11e8', 'sent' => true]]

// Failed result
['provider' => 'registered_provider', 'result' => ['error' => 'error message', 'sent' => false]]
```

## Contribute

- [Guide: CONTRIBUTING.md](https://github.com/alaninchika/messenger/blob/master/CONTRIBUTING.md)
- [Issue Tracker: github.com/alaninchika/messenger](https://github.com/alaninchika/messenger/issues)
- [Source Code:  github.com/alaninchika/messenger](https://github.com/alaninchika/messenger)

You can find more about contributing in [CONTRIBUTING.md](CONTRIBUTING.md).

## License

[MIT License](LICENSE)
