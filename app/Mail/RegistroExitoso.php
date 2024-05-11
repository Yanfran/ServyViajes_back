<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Events;
use App\Models\Categories;
use App\Models\LandingEvento;
use App\Models\assistants;
use App\Models\Landing;
use App\Models\AcademicGrades;

class RegistroExitoso extends Mailable
{
    use Queueable, SerializesModels;

    protected User $user;
    protected $isNewUser;
    protected $password;
    protected Events $evento;
    protected Categories $categoria;
    protected LandingEvento $landingEvento;
    protected assistants $assistants;
    protected Landing $landing;
    protected AcademicGrades $grado_academico;

    /**
     * Create a new message instance.
     */
    public function __construct(
        $user, 
        $isNewUser, 
        $password = null, 
        $evento, 
        $categoria, 
        $landingEvento, 
        $assistants, 
        $landing,
        $grado_academico
    )
    {
        $this->user = $user;
        $this->isNewUser = $isNewUser;
        $this->password = $password;
        $this->evento = $evento;
        $this->categoria = $categoria;
        $this->landingEvento = $landingEvento;
        $this->assistants = $assistants;
        $this->landing = $landing;
        $this->grado_academico = $grado_academico;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '¡Muchas gracias por su registro a '. $this->evento->nombre .'!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $appURL = config('app.url');
        $monto_total = number_format($this->assistants->monto_total, 2);

        return new Content(
            view: 'emails.registro-exitoso',
            with:  [
                'userName' => $this->user->name,
                'isNewUser' => $this->isNewUser,
                'userEmail' => $this->user->email,
                'userPassword' => $this->password,
                'fechaInicioEvento' => $this->evento->fecha_inicio,
                'fechaTerminoEvento' => $this->evento->fecha_termino,
                'sedeEvento' => $this->evento->sede,
                'logoEvento' => $this->landingEvento->logo_evento,
                'gradoAcademicoAsistente' => $this->grado_academico->descripcion,
                'nombreEvento' => $this->evento->nombre,
                'nombreCategoria' => $this->categoria->descripcion,
                'correoContacto' => $this->landing->correo_contacto,
                'appURL' => $appURL,
                'beneficiario' => $this->evento->beneficiario,
                'banco' => $this->evento->banco,
                'numero_cuenta' => $this->evento->numero_cuenta,
                'clabe_interbancaria' => $this->evento->clabe_interbancaria,
                'monto_total' => $monto_total
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
