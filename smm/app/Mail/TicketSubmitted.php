<?php


namespace App\Mail;

class TicketSubmitted extends \Illuminate\Mail\Mailable
{
    use \Illuminate\Bus\Queueable;
    use \Illuminate\Queue\SerializesModels;
    public $ticket = NULL;
    public function __construct(\App\Ticket $ticket)
    {
        $this->ticket = $ticket;
    }
    public function build()
    {
        return $this->subject(__("mail.ticket_submitted_subject"))->markdown("mail.ticket-submitted");
    }
}

?>