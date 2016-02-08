<?php

namespace Structural\Adapter;

use SendGrid\Email;

class NotifyAdapter
{
    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * @param string $username
     * @param string $password
     */
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @param string      $from
     * @param string      $to
     * @param string      $message
     * @param string|null $subject
     */
    public function send($from, $to, $message, $subject = null)
    {
        if ($subject === null) {
            return $this->sendSms($from, $to, $message);
        }

        return $this->sendMail($from, $to, $message, $subject);
    }

    /**
     * @param string $from
     * @param string $to
     * @param string $smsText
     *
     * @return mixed
     */
    protected function sendSms($from, $to, $smsText)
    {
        $twillio = new \Services_Twilio($this->username, $this->password);

        $message = $twillio->account->messages->sendMessage(
            $from,
            $to,
            $smsText
        );

        return $message;
    }

    /**
     * @param string $from
     * @param string $to
     * @param string $message
     * @param string $subject
     *
     * @return \stdClass
     */
    protected function sendMail($from, $to, $message, $subject)
    {
        $sendGrind = new \SendGrid($this->username, $this->password);
        $email = new Email();

        $email->addTo($from)
            ->addTo($to)
            ->setSubject($subject)
            ->setText(strip_tags($message))
            ->setHtml($message)
        ;

        return $sendGrind->send($email);
    }
}
