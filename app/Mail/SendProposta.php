<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendProposta extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     protected $pdfContent;

    public function __construct($pdfContent)
    {
        $this->pdfContent = $pdfContent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.proposta')
              ->attachData($this->pdfContent, 'Proposta.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
