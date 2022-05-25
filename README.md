exabytes-sms-bundle
===================

Send sms using exabytes malaysia api. For more detail regarding the api, please read [documentation](https://support.exabytes.com.my/en/support/solutions/articles/14000110847-bulk-sms-api-integration).

Requirement
===========
* PHP 7.2+
* Symfony 4.4+ and 5+

Installation
============

`composer require fd6130/exabytes-sms-bundle`

> If you are using flex, it will automatic add this bundle to `bundles.php`.

Configuration
=============

Update your .env to include this two variable:

```
# .env
EXABYTES_USERNAME=
EXABYTES_PASSWORD=
```

And then create the config file `/config/fd_exabytes.yaml` and put the following content:

```yaml
fd_exabytes:
    username: '%env(EXABYTES_USERNAME)%'
    password: '%env(EXABYTES_PASSWORD)%'
```

Inject `ExabytesInterface` and start sending sms:

```php
private $exabytes;

public function __construct(ExabytesInterface $exabytes)
{
    $this->exabytes = $exabytes;
}

public function sendSMS()
{
    $this->exabytes->send('mobile number', 'message', ExabytesInterface::ASCII);

    //...
}

```