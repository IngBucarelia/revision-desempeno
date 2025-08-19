<?php
namespace App\Mail;

use App\Models\FaltaDisciplinaria;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FaltaDisciplinariaCreada extends Mailable
{
    use Queueable, SerializesModels;

    public $falta;

    public function __construct(FaltaDisciplinaria $falta)
    {
        $this->falta = $falta;
    }

    public function build()
    {
        return $this->subject('Nueva Falta Disciplinaria Registrada')
                    ->view('emails.falta_creada');
    }
}
