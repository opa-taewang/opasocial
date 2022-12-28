<?php 
namespace App\Events;


class OrderPlaced
{
    use \Illuminate\Foundation\Events\Dispatchable;
    use \Illuminate\Broadcasting\InteractsWithSockets;
    use \Illuminate\Queue\SerializesModels;

    public $order = NULL;

    public function __construct(\App\Order $order)
    {
        $this->order = $order;
    }

}


