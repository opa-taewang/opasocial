<?php


namespace App\Mail;

class AdminMasterReport extends \Illuminate\Mail\Mailable
{
    use \Illuminate\Bus\Queueable;
    use \Illuminate\Queue\SerializesModels;
    public $today = [];
    public $month = [];
    public $lifetime = [];
    public function __construct()
    {
    }
    public function build()
    {
        $this->today["orders"]["COMPLETED"] = \App\Order::whereDate("created_at", \Carbon\Carbon::now()->format("Y-m-d"))->whereIn("status", ["COMPLETED", "PARTIAL"])->count();
        $this->today["orders"]["PENDING"] = \App\Order::whereDate("created_at", \Carbon\Carbon::now()->format("Y-m-d"))->whereIn("status", ["PENDING"])->count();
        $this->today["orders"]["CANCELLED"] = \App\Order::whereDate("created_at", \Carbon\Carbon::now()->format("Y-m-d"))->whereIn("status", ["CANCELLED"])->count();
        $this->today["orders"]["INPROGRESS"] = \App\Order::whereDate("created_at", \Carbon\Carbon::now()->format("Y-m-d"))->whereIn("status", ["INPROGRESS"])->count();
        $this->month["orders"]["COMPLETED"] = \App\Order::whereMonth("created_at", \Carbon\Carbon::now()->format("m"))->whereIn("status", ["COMPLETED", "PARTIAL"])->count();
        $this->month["orders"]["PENDING"] = \App\Order::whereMonth("created_at", \Carbon\Carbon::now()->format("m"))->whereIn("status", ["PENDING"])->count();
        $this->month["orders"]["CANCELLED"] = \App\Order::whereMonth("created_at", \Carbon\Carbon::now()->format("m"))->whereIn("status", ["CANCELLED"])->count();
        $this->month["orders"]["INPROGRESS"] = \App\Order::whereMonth("created_at", \Carbon\Carbon::now()->format("m"))->whereIn("status", ["INPROGRESS"])->count();
        $this->lifetime["orders"]["COMPLETED"] = \App\Order::whereIn("status", ["COMPLETED", "PARTIAL"])->count();
        $this->lifetime["orders"]["PENDING"] = \App\Order::whereIn("status", ["PENDING"])->count();
        $this->lifetime["orders"]["CANCELLED"] = \App\Order::whereIn("status", ["CANCELLED"])->count();
        $this->lifetime["orders"]["INPROGRESS"] = \App\Order::whereIn("status", ["INPROGRESS"])->count();
        $this->today["tickets"]["OPEN"] = \App\Ticket::whereDate("created_at", \Carbon\Carbon::now()->format("Y-m-d"))->whereIn("status", ["OPEN"])->count();
        $this->today["tickets"]["CLOSED"] = \App\Ticket::whereDate("created_at", \Carbon\Carbon::now()->format("Y-m-d"))->whereIn("status", ["CLOSED"])->count();
        $this->month["tickets"]["OPEN"] = \App\Ticket::whereMonth("created_at", \Carbon\Carbon::now()->format("m"))->whereIn("status", ["OPEN"])->count();
        $this->month["tickets"]["CLOSED"] = \App\Ticket::whereMonth("created_at", \Carbon\Carbon::now()->format("m"))->whereIn("status", ["CLOSED"])->count();
        $this->lifetime["tickets"]["OPEN"] = \App\Ticket::whereIn("status", ["OPEN"])->count();
        $this->lifetime["tickets"]["CLOSED"] = \App\Ticket::whereIn("status", ["CLOSED"])->count();
        $this->today["users"]["new"] = \App\User::whereDate("created_at", \Carbon\Carbon::now()->format("Y-m-d"))->count();
        $this->month["users"]["new"] = \App\User::whereMonth("created_at", \Carbon\Carbon::now()->format("m"))->count();
        $this->lifetime["users"]["total"] = \App\User::count();
        return $this->subject(__("mail.system_status_report"))->markdown("mail.admin-master-report");
    }
}

?>