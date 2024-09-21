<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Reservation;

class ReservationReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;
    public $shop_name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Reservation $reservation, $shop_name)
    {
        $this->reservation = $reservation;
        $this->shop_name = $shop_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('ご予約リマインドメール')
                    ->view('emails.reservation_reminder')
                    ->with([
                        'reservation' => $this->reservation,
                        'shop_name' => $this->shop_name,
                    ]);
    }
}
