<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Izin extends Mailable
{
    use Queueable, SerializesModels;

    public $izin;

    public function __construct($izin)
    {
        $this->izin = $izin;
    }

    public function build()
    {
        return $this->view('email.approvalPerizinan');
    }
}

?>
