<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CriarCliente extends Mailable
{
    use Queueable, SerializesModels;

    public $nome;
    public $numero;
    public $zona;
    public $contribuinte;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nome, $numero, $zona, $contribuinte)
    {
        $this->nome = $nome;
        $this->numero = $numero;
        $this->zona = $zona;
        $this->contribuinte = $contribuinte;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.cliente')
                    ->with([
                        'nome' => $this->nome,
                        'numero' => $this->numero,
                        'zona' => $this->zona,
                        'contribuinte' => $this->contribuinte,
                    ]);
    }
}
