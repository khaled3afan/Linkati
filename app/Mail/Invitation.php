<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Invitation extends Mailable
{
    use Queueable, SerializesModels;

    public $user, $email;

    /**
     * Create a new message instance.
     *
     * @param $user
     * @param $email
     */
    public function __construct($user, $email)
    {
        $this->user = $user;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $me = '[name], invited you to try Linkait!';

//        $this->user->name . '، قام بدعوتك لتجريب منصة لينكاتي!'
        return $this->markdown('emails.invitation')
                    ->subject(__(':name, invited you to try Linkait!', [
                        'name' => $this->user->name
                    ]));
    }
}
