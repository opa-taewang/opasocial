<?php


namespace App\Mail;

class TicketNewMessage extends \Illuminate\Mail\Mailable
{
    use \Illuminate\Bus\Queueable;
    use \Illuminate\Queue\SerializesModels;
    public $ticketMessage = NULL;
    public function __construct(\App\TicketMessage $ticketMessage)
    {
        $this->ticketMessage = $ticketMessage;
    }
    public function build()
    {
        return $this->subject(__("mail.ticket_message_subject"))->markdown("mail.ticket-new-message");
    }
}

?>