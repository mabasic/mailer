<?php namespace Mabasic\Mailer;

use Illuminate\Mail\Mailer as IlluminateMailer;

class Mailer {

    protected $mail;

    public function __construct(IlluminateMailer $mail)
    {

        $this->mail = $mail;
    }

    /**
     * Send email using queue (if possible)
     *
     * Recipient array (containing address and name) and view
     * parameters are required, data is optional.
     *
     * @param $email
     * @param $subject
     * @param $view
     * @param array $data
     */
    public function sendTo($email, $subject, $view, array $data = [])
    {
        $this->mail->queue($view, $data, function($message) use($email, $subject)
        {
            $message->to($email)->subject($subject);
        });
    }

}
