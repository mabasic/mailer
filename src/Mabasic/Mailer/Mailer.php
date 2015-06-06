<?php namespace Mabasic\Mailer;

use Illuminate\Mail\Mailer as Mail;

abstract class Mailer {

    /**
     * @var Mail
     */
    protected $mail;

    /**
     * @param Mail $mail
     */
    public function __construct(Mail $mail)
    {

        $this->mail = $mail;
    }

    /**
     * Send email using queue (if possible)
     *
     * Recipient array (containing address and name) and view
     * parameters are required, data is optional.
     *
     * @param $user
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
