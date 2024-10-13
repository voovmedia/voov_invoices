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
        $invoiceNumber = $this->data->invoice_id;
        $invoiceId = $this->data->id;
        $clientFullName = $this->data['client']['user']->full_name;
        $totalDueAmount = $this->data->final_amount - $this->data['payments']->sum('amount');
        $subject = "Payment Reminder of #$invoiceNumber Invoice ";

        return $this->view('emails.multi_invoice_payment_reminder_mail',
            compact('invoiceNumber', 'invoiceId', 'clientFullName', 'totalDueAmount'))
            ->markdown('emails.multi_invoice_payment_reminder_mail')
            ->subject($subject);
    }
}
