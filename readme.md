# Mailer

Laravel package for more efficient email sending inspired by a [Laracasts lesson](https://laracasts.com/lessons/mailers).

## Installation

1. Add `"mabasic/mailer": "1.*"` to your composer.json.
2. Run `composer update`

## Usage

Create a class for specific case like so:

```php
<?php namespace Acme\Mailers;

use Mabasic\Mailer\Mailer;

class ContactMailer extends Mailer {

    public function send($data)
    {
        $view = "emails.contact";
        $subject = "Subject";
        $user = [
            "email" => 'test@test.com'
        ];

        return $this->sendTo($user, $subject, $view, $data);
    }

}
```

It needs to use `Mabasic\Mailer\Mailer;` and extend `Mailer`.

Then in your controller you can inject it and use it like so:

```php
<?php

use Acme\Mailers\ContactMailer;

class ContactController extends \BaseController {

	protected $contactMailer;

	public function __construct(ContactMailer $contactMailer)
	{
		 $this->contactMailer = $contactMailer;
	}

	public function store()
	{
		 $input = Input::all();

		 $this->contactMailer->send($input);

		 return Response::json("Email was sent sucessfully", 200);

	}
}
```
