<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MultiInvoicePaymentReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     */
    public function build(): static
    {
        $clientFullName = $this->data[0]['client']['user']->full_name;
        $totalDueAmount = $this->data->sum('final_amount') - $this->data->flatMap(function ($invoice) {
            return $invoice['payments'];
        })->sum('amount');

        return $this->view('emails.multi_invoice_payment_reminder_mail',
            compact('clientFullName', 'totalDueAmount'))
            ->markdown('emails.multi_invoice_payment_reminder_mail');
    }
}
