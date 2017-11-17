<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Http\Request;
// use Request;

class EmailDeContacto extends Mailable
{
    use Queueable, SerializesModels;

    public $mensaje;
    

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        //
        $this->mensaje = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $remitente= 'prueba@mail.com';
        $destinatario= 'prueba@mail.com';
        $asunto= 'Contacto - Nikka-n';

        $this->from($remitente)
                ->to($destinatario)
                ->subject($asunto);

        return $this->markdown('sitio.contacto_email');
    }
}
