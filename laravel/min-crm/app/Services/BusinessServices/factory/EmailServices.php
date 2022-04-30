<?php
namespace App\Services\BusinessServices\factory;
use App\Services\BusinessServices\IEmailServices;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmailServices implements IEmailServices{

    /**
     * @param $user
     */
    public function sendWelcomeEmail($user) {
        $data = [
            'msg' => 'Welcome '.$user['fname'] . ' '. $user['lname'] . ' to Min Crm',
        ];
        Mail::send('email.welcome_email', $data, function (Message $message) use ($user, $data) {
            $message->to($user['email'], $user['fname'] .' '.$user['lname'])
                ->subject($data['email_subject'] ?? 'Message from Min CRM')
                ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        });
    }
}
