<?php

namespace App\Services;
use SendGrid;
use SendGrid\Mail\Mail;
use Exception;
use SendGrid\Mail\Attachment;
use App\Models\Invoice;
use App\Repositories\InvoiceRepository;
use Barryvdh\DomPDF\Facade\Pdf;
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
    public function sendEmail($to, $from, $subject, $content, $fromName = null,$invoiceId = null)
    {
        $email = new Mail();
        $email->setFrom($from, $fromName ?? config('app.name'));
        $email->setSubject($subject);
        $email->addTo($to);
        $email->addContent("text/html", $content);
          // Check if an invoice ID is provided
       // Check if an invoice ID is provided
    if ($invoiceId) {
        $invoice = Invoice::whereInvoiceId($invoiceId)->firstOrFail();
        $invoice->load('client.user', 'invoiceTemplate', 'invoiceItems.product', 'invoiceItems.invoiceItemTax');
        $invoiceRepository = app(InvoiceRepository::class);
            
        $invoiceData = $invoiceRepository->getPdfData($invoice);
        $invoiceTemplate = $invoiceRepository->getDefaultTemplate($invoice);
        $pdf = Pdf::loadView("invoices.invoice_template_pdf.$invoiceTemplate", $invoiceData);

        $fileContent = $pdf->output(); // Get the PDF content
        $fileName = "Invoice_$invoiceId.pdf";

        $attachment = new Attachment();
        $attachment->setContent(base64_encode($fileContent)); // Encode file content to base64
        $attachment->setType('application/pdf'); // MIME type
        $attachment->setFilename($fileName); // File name
        $attachment->setDisposition('attachment'); // Attachment disposition

        $email->addAttachment($attachment);
    }


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
    public function sendEmailWithAttachments($to, $from, $subject, $content, array $invoiceIds, $fromName = null)
    {
        $email = new Mail();
        $email->setFrom($from, $fromName ?? config('app.name'));
        $email->setSubject($subject);
        $email->addTo($to);
        $email->addContent("text/html", $content);

        // Loop through each invoice ID and create attachments
        foreach ($invoiceIds as $invoiceId) {
            try {
                $invoice = Invoice::whereId($invoiceId)->firstOrFail();
                $invoice->load('client.user', 'invoiceTemplate', 'invoiceItems.product', 'invoiceItems.invoiceItemTax');
                $invoiceRepository = app(InvoiceRepository::class);
                
                $invoiceData = $invoiceRepository->getPdfData($invoice);
                $invoiceTemplate = $invoiceRepository->getDefaultTemplate($invoice);
                $pdf = Pdf::loadView("invoices.invoice_template_pdf.$invoiceTemplate", $invoiceData);
                $id = $invoice->invoice_id;
                $fileContent = $pdf->output(); // Get the PDF content
                $fileName = "Invoice_$id.pdf";

                $attachment = new Attachment();
                $attachment->setContent(base64_encode($fileContent)); // Encode file content to base64
                $attachment->setType('application/pdf'); // MIME type
                $attachment->setFilename($fileName); // File name
                $attachment->setDisposition('attachment'); // Attachment disposition

                $email->addAttachment($attachment);
            } catch (Exception $e) {
                // Log or handle specific invoice errors if needed
                throw new Exception("Failed to create attachment for Invoice ID $invoiceId: " . $e->getMessage());
            }
        }

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
