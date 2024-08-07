<?php

namespace App\Services;

use SendGrid;
use SendGrid\Mail\Mail;
use Exception;

class SendGridService
{
    protected $sendGrid;

    public function __construct()
    {
        $this->sendGrid = new SendGrid(env('SENDGRID_API_KEY'));
    }

    /**
     * Send an email using SendGrid.
     *
     * @param string $to
     * @param string $from
     * @param string $subject
     * @param string $content
     * @param string|null $fromName
     * @return \SendGrid\Response
     * @throws \Exception
     */
    public function sendEmail($to, $from, $subject, $content, $fromName = null)
    {
        $email = new Mail();
        $email->setFrom($from, $fromName ?? config('app.name'));
        $email->setSubject($subject);
        $email->addTo($to);
        $email->addContent("text/html", $content);

        try {
            $response = $this->sendGrid->send($email);
            if ($response->statusCode() >= 400) {
                throw new Exception("Failed to send email: " . $response->body());
            }
            return $response;
        } catch (Exception $e) {
            throw new Exception("Failed to send email: " . $e->getMessage());
        }
    }
}
