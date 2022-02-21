<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Email to comunicate founder about news contacts
 *
 * @param $data[
 *   is_musician => 'yes'|'no',
 *   have_debit_card => 'yes'|'no',
 *   instagram => 'user instagram name'
 * ]
 */
class NewContact extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->data['instagram'] . " Budget - Social Media Growth")
                    ->view('emails.new-contact');
    }
}
