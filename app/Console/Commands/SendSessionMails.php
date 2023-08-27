<?php

namespace App\Console\Commands;

use App\Mail\SessionInfoMail;
use App\Models\Appointment;
use App\Models\Session;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendSessionMails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'learny:send-session-mails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $appointments = Appointment::with('user','teacher.user','session')
            ->where('date','=',date('Y-m-d'))
            ->where('status_id',config('constants.appointments.statuses.accepted_id'))
            ->whereRaw('TIMESTAMPDIFF(MINUTE, CONCAT(date, " ", time), NOW()) <= 30')
            ->whereHas('session',function ($query){
                $query->where('sent_mail','=',0);
            })
            ->get();
        $users = $appointments->pluck('user');
        $teachers = $appointments->pluck('teacher')->pluck('user');
        $session_ids = $appointments->pluck('session')->pluck('id');
        $sessions = Session::whereIn('id', $session_ids)->get();
        $sessions->each(function ($session) {
            $session->update(['sent_mail' => 1]);
        });
        foreach ($users as $key=>$user){
            sendMail($user->email,new SessionInfoMail($session_ids[$key],$user->first_name));
            sendMail($teachers[$key]->email,new SessionInfoMail($session_ids[$key],$teachers[$key]->first_name));
        }
    }
}
