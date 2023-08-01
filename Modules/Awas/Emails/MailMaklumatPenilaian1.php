<?php

namespace Modules\Awas\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailMaklumatPenilaian1 extends Mailable
{
    use Queueable, SerializesModels;
    public $dataP1;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dataP1)
    {
        $this->dataP1 = $dataP1;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('Notifikasi Maklumat Penilaian Tender Baru Bagi '.$this->dataP1['no_perolehan'])->markdown('email.MailMaklumatPenilai1');
        return $this;
    }
}
