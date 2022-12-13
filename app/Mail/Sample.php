<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Sample extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     public $data;
     public $data2;
    public function __construct($data, $data2)
    {
        $this->data = $data;
        $this->data2 = $data2;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Last Attendance';
        $address = env('MAIL_FROM_ADDRESS');
        $name = env('MAIL_FROM_NAME');

   
        return $this->from('mail@example.com', 'Mailtrap')
                    ->subject($subject)
                    ->markdown('LastAttendance',['mail_data'=>$this->data, 'mail_data2'=>$this->data2]);
    }
}