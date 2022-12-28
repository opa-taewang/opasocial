<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configs')->delete();
        DB::table('configs')->insert([
            [
                'name' => 'app_name',
                'value' => 'Awesome App'
            ],
            [
                'name' => 'currency_symbol',
                'value' => '$'
            ],
            [
                'name' => 'currency_code',
                'value' => 'USD'
            ],
            [
                'name' => 'logo',
                'value' => 'images/lcVJ3Eplzt03CJat9x5F9LvaUxJSZFwpbuXY02IF.png'
            ],
            [
                'name' => 'date_format',
                'value' => 'd-m-Y'
            ],
            [
                'name' => 'banner',
                'value' => 'images/99d575092d9e0fd3a1ad35b091660b3e.png'
            ],
            [
                'name' => 'home_page_description',
                'value' => '⭐️Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum'
            ],
            [
                'name' => 'recaptcha_public_key',
                'value' => '6Lcuw2sUAAAAAKbMXnYTXC_8mXhhiaA9CF6yLMQ2'
            ],
            [
                'name' => 'recaptcha_private_key',
                'value' => '6Lcuw2sUAAAAAPrlwTPqR4W1Vn287D_mWlgej1pY'
            ],
            [
                'name' => 'minimum_deposit_amount',
                'value' => '10'
            ],
            [
                'name' => 'home_page_meta',
                'value' => '<meta name="description" content="A description">
<meta name="keywords" content="SMM Services">'
            ],
            [
                'name' => 'module_api_enabled',
                'value' => '1'
            ],
            [
                'name' => 'module_support_enabled',
                'value' => '1'
            ],
            [
                'name' => 'theme_color',
                'value' => '#4285f4'
            ],
            [
                'name' => 'background_color',
                'value' => '#e9ebee'
            ],
            [
                'name' => 'language',
                'value' => 'en'
            ],
            [
                'name' => 'display_price_per',
                'value' => '1000'
            ],
            [
                'name' => 'admin_note',
                'value' => 'Update me I am admin note'
            ],
            [
                'name' => 'admin_layout',
                'value' => 'container-fluid'
            ],
            [
                'name' => 'user_layout',
                'value' => 'container'
            ],
            [
                'name' => 'panel_theme',
                'value' => 'material'
            ],
            [
                'name' => 'anonymizer',
                'value' => 'http://anonym.to/?'
            ],
            [
                'name' => 'front_page',
                'value' => 'login'
            ],
            [
                'name' => 'show_service_list_without_login',
                'value' => 'YES'
            ],
            [
                'name' => 'notify_email',
                'value' => 'notify@example.com'
            ],
            [
                'name' => 'currency_separator',
                'value' => '.'
            ],
            [
                'name' => 'app_key',
                'value' => '$2y$10$L2ebBUbNqNasrvPiyf3h/.oppFQZMP.xKe.ojJUoMztPOSezNPrmC'
            ],
            [
                'name' => 'app_code',
                'value' => '$2y$10$MuhwAYxufze.gdXRGfmD1.M60lWVzpqtIhtq9TuFIE2al9c3TygRm'
            ],
            [
                'name' => 'Script Developed and Provided By',
                'value' => 'MXZ-SCRIPT.COM'
            ],
            [
                'name' => 'Contact MXZ',
                'value' => '+917305795794'
            ],
            [
                'name' => 'module_subscription_enabled',
                'value' => '1'
            ],
            [
                'name' => 'timezone',
                'value' => 'America/Chicago'
            ],
            [
                'name' => 'navbar_name',
                'value' => 'SMM'
            ],
        ]);
    }
}
