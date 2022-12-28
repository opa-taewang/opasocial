<?php 
namespace App\Console;


class Kernel extends \Illuminate\Foundation\Console\Kernel
{
    protected $commands = array( "App\\Console\\Commands\\CheckOrderStatus","App\\Console\\Commands\\CheckPanels", "App\\Console\\Commands\\SendOrders", "App\\Console\\Commands\\SendAdminMasterReportEmail", "App\\Console\\Commands\\ProcessDripFeed", "App\\Console\\Commands\\ProcessAutoLike",  "App\\Console\\Commands\\CheckPerformance", "App\\Console\\Commands\\SellerSync" );

    protected function schedule(\Illuminate\Console\Scheduling\Schedule $schedule)
    {
    }

    protected function commands()
    {
        require(base_path("routes/console.php"));
    }

}


