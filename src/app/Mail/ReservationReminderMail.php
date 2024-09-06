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
    public $shopName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Reservation $reservation, $shopName)
    {
        $this->reservation = $reservation;
        $this->shopName = $shopName;
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
                        'shopName' => $this->shopName,
                    ]);
    }
}
