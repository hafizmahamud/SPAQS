<?php

namespace Modules\Awas\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailMaklumatPenilaian2 extends Mailable
{
    use Queueable, SerializesModels;
    public $dataP2;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dataP2)
    {
        //
        $this->dataP2 = $dataP2;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('Notifikasi Maklumat Penilaian Tender Baru Bagi '.$this->dataP2['no_perolehan'])->markdown('email.MailMaklumatPenilai2');
        return $this;
    }
}
