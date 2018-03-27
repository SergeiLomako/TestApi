<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ChangePassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $name = isset($this->user->data) ? $this->user->data->first_name : $this->user->login;
        return $this->view('mails.forgot')
            ->with([
                'name' => $name,
                'app_url' => env('APP_URL'),
                'link' => route('change_password_form', ['token' => $this->user->password_reset_token])
            ]);
    }
}
