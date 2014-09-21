<?php namespace Mabasic\Mailer;

use Illuminate\Mail\Mailer as Mail;

/**
 * Class Mailer
 * @package Mabasic\Mailer
 */
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
    public function sendTo($user, $subject, $view, $data = [])
    {
        $this->mail->queue($view, $data, function($message) use($user, $subject)
        {
            $message->to($user->email)->subject($subject);
        });
    }

}
