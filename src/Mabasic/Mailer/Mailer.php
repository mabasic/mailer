<?php namespace Mabasic\Mailer;

use Mail;

abstract class Mailer {

    /*
    |--------------------------------------------------------------------------
    | Send email using queue (if possible)
    |--------------------------------------------------------------------------
    |
    | Recipient array (containing address and name) and view
    | parameters are required, data is optional.
    |
    */
    public function sendTo($recipient, $subject, $view, $data = [])
    {
        Mail::queue($view, $data, function($message) use($recipient, $subject)
        {
            $message->to($recipient['address'], $recipient['name']);
            $message->subject($subject);
        });
    }

}