<?php

namespace Pilot\Mail;

use Pilot\User;
use Pilot\UserInfo;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegistered extends Mailable
{
    use Queueable, SerializesModels;

    public $login;
    public $name;
    public $lastname;
    public $password;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $password = null)
    {
        $this->login = $user->login;
        $this->name = UserInfo::where('user_id', $user->id)->first()->name;
        $this->lastname = UserInfo::where('user_id', $user->id)->first()->lastname;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('admin@pilot-ipek.ru', 'Администрация платформы "Пилот"')
                    ->subject('Ваша регистрация прошла успешно')
                    ->view('emails.register', [
                        'login' => $this->login,
                        'name' => $this->name,
                        'lastname' => $this->lastname,
                        'password' => $this->password
                    ]);
    }
}
