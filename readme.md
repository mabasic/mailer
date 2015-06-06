# Mailer

Laravel 4 package for more efficient email sending inspired by Laracasts lessons:

- [Mailers](https://laracasts.com/lessons/mailers)
- [Handlers and Mailers](https://laracasts.com/series/build-a-laravel-app-from-scratch/episodes/27)

**What does it exactly do?**

It enables you to write this:

```php
$this->contactMailer->send($data);
```

from your controller, instead of doing this:

```php
Mail::queue($view, $data, function($message) use($email, $subject)
{
    $message->to($email)->subject($subject);
});
```

every time you want to send an email. 

## Installation

From your project root type:

```
composer require mabasic/mailer
```

## Usage

Create a class for specific case like so:

```php
<?php namespace Acme\Mailers;

use Mabasic\Mailer\Mailer;

class ContactMailer extends Mailer {

    public function send($data)
    {
        $view = 'emails.contact';
        $subject = 'Test';
        $email = 'test@test.com';

        $this->sendTo($email, $subject, $view, $data);
    }

}
```

Then in your controller you can inject it and use it like so:

```php
<?php

use Acme\Mailers\ContactMailer;

class MailerController extends \BaseController {

    protected $contactMailer;

    function __construct(ContactMailer $contactMailer)
    {
        $this->contactMailer = $contactMailer;
    }

    public function sendMail()
    {
        // Get some data for the email, like user name, message, etc ...

        $data = [
            'name' => 'John Doe',
            'comment' => 'Hello, nice to meet you.'
        ];

        $this->contactMailer->send($data);

        return 'ok';
    }

}
```
