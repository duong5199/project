<?php


namespace App\Http\Helpers;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Mail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public $template;

    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($template, $data = [], $subject = 'ProHRM')
    {
        $this->data = $data;
        $this->template = $template;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
            ->view($this->template);
    }
}
