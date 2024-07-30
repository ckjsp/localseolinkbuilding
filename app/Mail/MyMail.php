<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MyMail extends Mailable
{
    use Queueable, SerializesModels;
    public $customData;

    /**
     * Create a new message instance.
     */
    public function __construct($customData)
    {
        $this->customData = $customData;
    }

    public function build()
    {
        $from_name = isset($this->customData['from_name']) ? $this->customData['from_name'] : config('mail.from.name');
        $mailaddress = isset($this->customData['mailaddress']) ? $this->customData['mailaddress'] : config('mail.from.address');
        
        return $this->from($mailaddress, $from_name)->subject($this->customData['subject'])->view('mail', $this->customData);
    }

    /**
     * Get the message envelope.
     */
    /* public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'My Mail',
        );
    } */

    /**
     * Get the message content definition.
     */
    /* public function content(): Content
    {
        return new Content(
            view: 'mail',
        );
    } */

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    /* public function attachments(): array
    {
        return [];
    } */
}
