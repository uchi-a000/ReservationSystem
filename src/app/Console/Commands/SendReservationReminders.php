<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use App\Mail\ReservationReminderMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;


class SendReservationReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:reservation-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reservation reminders to customers for today\'s reservations';


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $today = Carbon::today();
        $reservations = Reservation::whereDate('reservation_date', $today)->get();

        foreach($reservations as $reservation) {
            $shopName = $reservation->shop->shop_name;
            Mail::to($reservation->user->email)->send(new ReservationReminderMail($reservation, $shopName));
            $this->info("リマインダーを送信しました:" . $reservation->user->email);
        }

        return 0;
    }
}
