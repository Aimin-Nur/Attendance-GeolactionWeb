<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SavePerizinan extends Mailable
{
    use Queueable, SerializesModels;

    public $perizinan;

    public function __construct($perizinan)
    {
        $this->perizinan = $perizinan;
    }

    public function build()
    {
        return $this->view('email.perizinanSukses');
    }
}

?>
