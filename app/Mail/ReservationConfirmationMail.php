<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Reservations;
use App\Models\ReservationRooms;
use App\Models\Hotels;
use App\Models\PlanTypes;

class ReservationConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected User $user;
    protected Reservations $reservation;
    protected Hotels $hotel;
    protected PlanTypes $plan;
    protected $isNewUser;
    protected $password;
    protected $numeroAdultos;
    protected $numeroMenores;
    protected $tiposHabitaciones;
    protected $adultosHabitaciones;
    protected $menoresHabitaciones;
    protected $preciosHabitaciones;
    protected $habitacionesReservadas;

    /**
     * Create a new message instance.
     */
    public function __construct(
        $user, 
        $isNewUser, 
        $password = null, 
        $reservation, 
        $hotel, 
        $plan, 
        $numeroAdultos, 
        $numeroMenores, 
        $tiposHabitaciones,
        $adultosHabitaciones,
        $menoresHabitaciones,
        $preciosHabitaciones,
        $habitacionesReservadas
    )
    {
        $this->user = $user;
        $this->isNewUser = $isNewUser;
        $this->password = $password;
        $this->reservation = $reservation;
        $this->hotel = $hotel;
        $this->plan = $plan;
        $this->numeroAdultos = $numeroAdultos;
        $this->numeroMenores = $numeroMenores;
        $this->tiposHabitaciones = $tiposHabitaciones;
        $this->adultosHabitaciones = $adultosHabitaciones;
        $this->menoresHabitaciones = $menoresHabitaciones;
        $this->preciosHabitaciones = $preciosHabitaciones;
        $this->habitacionesReservadas = $habitacionesReservadas;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Registro de reservación '. $this->hotel->nombre,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $monto_total = number_format($this->reservation->monto_total, 2);
        return new Content(
            view: 'emails.reservation-confirmation',
            with: [
                'userName' => $this->user->name,
                'userEmail' => $this->user->email,
                'password' => $this->password,
                'isNewUser' => $this->isNewUser,
                'hotelNombre' => $this->hotel->nombre,
                'hotelDireccion' => $this->hotel->direccion,
                'fechaEntrada' => $this->reservation->fecha_entrada,
                'fechaSalida' => $this->reservation->fecha_salida,
                'noches' => $this->reservation->cantidad_noches,
                'planNombre' => $this->plan->nombre,
                'tiposHabitaciones' => $this->tiposHabitaciones,
                'numeroAdultos' => $this->numeroAdultos,
                'numeroMenores' => $this->numeroMenores,
                'montoTotalReservacion' => $monto_total,
                'beneficiario' => $this->hotel->beneficiario,
                'banco' => $this->hotel->banco,
                'numero_cuenta' => $this->hotel->numero_cuenta,
                'clabe_interbancaria' => $this->hotel->clabe_interbancaria,
                'adultosHabitaciones' => $this->adultosHabitaciones,
                'menoresHabitaciones' => $this->menoresHabitaciones,
                'preciosHabitaciones' => $this->preciosHabitaciones,
                'habitacionesReservadas' => $this->habitacionesReservadas
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
