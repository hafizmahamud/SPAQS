<?php

namespace Modules\Awas\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailSuratEdaranKeputusan extends Mailable
{
    use Queueable, SerializesModels;
    public $dataP1;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dataP1, $data)
    {
        $this->dataP1 = $dataP1;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('Muat turun Surat Edaran Keputusan MLP Bagi '.$this->data['no_perolehan'])->markdown('email.MailSuratEdaranKeputusan');
        return $this;
    }
}
