<?php 
use DB;
if( !function_exists("getOption") ) 
{
    function getOption($option, $fetchFromDb = false)
    {
        if( $fetchFromDb ) 
        {
            $row = DB::table("configs")->where("name", $option)->get();
            if( $row->isEmpty() ) 
            {
                return NULL;
            }
            else
            {
                return $row->first()->value;
            }
        }
        else
        {
            $options = Session::get("options");
            if( !is_null($options) ) 
            {
                if( array_key_exists($option, $options) ) 
                {
                    return $options[$option];
                }
                return NULL;
            }
            if( config("database.installed") !== "%installation%" ) 
            {
                $value = DB::table("configs")->where("name", $option)->value("value");
                if( empty($value) ) 
                {
                    return NULL;
                }
                else
                {
                    return $value;
                }
            }
            else
            {
                return NULL;
            }
        }
    }
}
if( !function_exists("setOption") ) 
{
    function setOption($name, $value)
    {
        $row = DB::table("configs")->where("name", $name)->get();
        if( $row->isEmpty() ) 
        {
            DB::table("configs")->insert(array( "name" => $name, "value" => $value ));
        }
        else
        {
            DB::table("configs")->where("name", $name)->update(array( "value" => $value ));
        }
    }
}
if( !function_exists("mpc_m_c") ) 
{
    function mpc_m_c($data)
    {
        if( !password_verify($data, getOption("app_key", true)) && !password_verify(base64_encode($data), getOption("app_code", true)) ) 
        {
            Illuminate\Support\Facades\Artisan::call("down");
        }
    }
}
if( !function_exists("array_diff_key_recursive") ) 
{
    function array_diff_key_recursive($a1, $a2)
    {
        $r = array(  );
        foreach( $a1 as $k => $v ) 
        {
            if( is_array($v) ) 
            {
                if( !isset($a2[$k]) || !is_array($a2[$k]) ) 
                {
                    $r[$k] = $a1[$k];
                }
                elseif( $diff = array_diff_key_recursive($a1[$k], $a2[$k]) ) 
                {
                    $r[$k] = $diff;
                }
            }
            elseif( !isset($a2[$k]) || is_array($a2[$k]) ) 
            {
                $r[$k] = $v;
            }
        }
        return $r;
    }
}
if( !function_exists("array_cast_recursive") ) 
{
    function array_cast_recursive($array)
    {
        if( is_array($array) ) 
        {
            foreach( $array as $key => $value ) 
            {
                if( is_array($value) ) 
                {
                    $array[$key] = array_cast_Recursive($value);
                }
                if( $value instanceof stdClass ) 
                {
                    $array[$key] = array_cast_Recursive((array) $value);
                }
            }
        }
        if( $array instanceof stdClass ) 
        {
            return array_cast_Recursive((array) $array);
        }
        return $array;
    }
}
if (!function_exists('PaymentGateways')):
    function PaymentGateways()
    {
        return base_path('paymentgateways/vendor/autoload.php');
    }
endif;
if( !function_exists("getPageContent") ) 
{
    function getPageContent($slug)
    {
        return App\Page::where(array( "slug" => $slug ))->first()->content;
    }
}
if( !function_exists("getNotes") ) 
{
    function getNotes()
    {
        $option = "1";
        $note = NULL;
        $broadcasts = App\Broadcast::where("MsgStatus", 1)->orderBy("id", "desc")->get();
        if( !$broadcasts->isEmpty() ) 
        {
            foreach( $broadcasts as $broadcast ) 
            {
                $dtval = Carbon\Carbon::createFromFormat("Y-m-d H:i:s", $broadcast->StartTime, auth()->user()->timezone)->diffForHumans();
                if( $option == "1" ) 
                {
                    $option = "0";
                    $note = $note . "<span class=\"text-muted\">" . $dtval . "</span><br><span class=\"wysiwyg-color-red\">" . $broadcast["MsgText"] . "</span><br>";
                }
                else
                {
                    $option = "1";
                    $note = $note . "<span class=\"text-muted\">" . $dtval . "</span><br><span class=\"wysiwyg-color-blue\">" . $broadcast["MsgText"] . "</span><br>";
                }
            }
        }
        return $note;
    }
}
if( !function_exists("number_formats") ) 
{
    function number_formats($number, $decimals = 0, $dec_point = ".", $thousands_sep = ",")
    {
        $val = (double) number_format($number, 7, $dec_point, $thousands_sep);
        return $val;
    }
}

