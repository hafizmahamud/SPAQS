<?php

namespace Modules\Awas\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailMaklumatKetuaPenilai extends Mailable
{
    use Queueable, SerializesModels;
    public $dataKP;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dataKP)
    {
        $this->dataKP = $dataKP;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('Notifikasi Maklumat Penilaian Tender Baru Bagi '.$this->dataKP['no_perolehan'])->markdown('email.MailMaklumatKetuaPenilai');
        return $this;
    }
}
