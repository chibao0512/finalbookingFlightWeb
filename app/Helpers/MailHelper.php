<?php

namespace App\Helpers;
use App\Http\Responses\Api;
use App\Mail\GeneralMail;
use App\Jobs\SendMailJob;
use Auth,DB;
use App\Models\Transaction;


class MailHelper
{
    /**
     * Send mail sign up
     * 
     * @param Transaction $transaction
     */
    public static function sendMail($user, $password)
    {
        $dataMail['subject'] = 'Mật khẩu mới của bạn';
        $dataMail['password'] = $password;
        $dataMail['name'] = $user->name;
        $dataMail['email'] = $user->email;

        $mailJob = new GeneralMail();
        $mailJob->setFromDefault()
                ->setView('emails.forgot', $dataMail)
                ->setSubject($dataMail['subject'])
                ->setTo($dataMail['email']);
        dispatch(new SendMailJob($mailJob));
    }

}
