<?php 
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
            if( config("database.installed") !== "%installed%" ) 
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
if (!function_exists('convertCurrncy')):
    function convertCurrncy($price)
    {
    
        $rate = \DB::table('users')->join('currencies', 'currencies.id', '=','users.currency_id')
                ->where('users.id', \Auth::user()->id)
                ->select('currencies.*')
                ->get()
                ->first();

        $result = $rate->symbol.number_format($rate->rate*$price,2, getOption('currency_separator'), '');
        return $result;
    }
endif;

if (!function_exists('getConversionSymbol')):
    function getConversionSymbol()
    {
        $rate = \DB::table('users')->join('currencies', 'currencies.id', '=','users.currency_id')
                ->where('users.id', \Auth::user()->id)
                ->select('currencies.*')
                ->get()
                ->first();

        return $rate->symbol;
    }
endif;

if (!function_exists('getConvertedRate')):
    function getConvertedRate($price)
    {
      
        $rate = \DB::table('users')->join('currencies', 'currencies.id', '=','users.currency_id')
                ->where('users.id', \Auth::user()->id)
                ->select('currencies.*')
                ->get()
                ->first();

        $result = $rate->rate*$price;
        return $result;
    }
endif;
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
                $dtval = Carbon\Carbon::createFromFormat("Y-m-d H:i:s", $broadcast->StartTime, auth()->user()->timezone);
                if( $option == "1" ) 
                {
                    $option = "0";
                    $note = $note . "<li class='singleNewsBlock'>
    <div class='type-date'>
        <p class='date'> $dtval</p>           
    </div><br>
    <div class='news-desc'>
            <p><b>" . $broadcast["MsgTitle"] . "<br></b></p>
        <p>" . $broadcast["MsgText"] . "<br></p>
    </div>
</li>";
                }
                else
                {
                    $option = "1";
                    $note = $note . "<li class='singleNewsBlock'>
    <div class='type-date'>
        <p class='date'> $dtval</p>           
    </div><br>
    <div class='news-desc'>
                <p><b>" . $broadcast["MsgTitle"] . "<br></b></p>
        <p>" . $broadcast["MsgText"] . "<br></p>
    </div>
</li>";
                }
            }
        }
        return $note;
    }
}
if (!function_exists('PaymentGateways')):
    function PaymentGateways()
    {
        return base_path('paymentgateways/vendor/autoload.php');
    }
endif;
if( !function_exists("number_formats") ) 
{
    function number_formats($number, $decimals = 0, $dec_point = ".", $thousands_sep = ",")
    {
        $val = (double) number_format($number, 5, $dec_point, $thousands_sep);
        return $val;
    }
}
if( !function_exists("fundChange") ) 
{
    function fundChange($text, $price, $type, $userid, $orderid)
    
    {
        $user = \App\User::findOrFail($userid);
        $userf = $user->funds;
        $pricebefore = $userf - ($price);
        $priceafter = $userf;
        if ($type== 'ORDER'){
            $reason = 'Order placed by USER';
            $userf = $user->funds;
            $pricebefore = $userf;
            $priceafter = $userf + ($price);
        }
        else if ($type== 'REFUND'){
            $reason = 'Order Refunded';
            $userf = $user->funds;
        $pricebefore = $userf - ($price);
        $priceafter = $userf;
            
        }
         else if ($type== 'NO REFUND'){
            $reason = 'Order Partial with Zero Remains';
        }
        else if ($type == 'ADD'){
            $pricebefore = $userf;
            $priceafter =  $userf + $price;
            $reason = 'Fund Added by User';
        }
        else if ($type == 'ADDADMIN'){
            $reason = 'Fund Add By Admin';
        }
        else if ($type == 'CHANGEADMIN'){
            $pricebefore = $userf;
            $priceafter =  $price;
            $price = $userf - $price;
            $price = -($price);
            $reason = 'Admin Changed Fund';
        }
        \App\FundChange::create(['details' => $text, 'user_id' => $userid, 'pricebefore' =>$pricebefore, 'priceafter' => $priceafter, 'reason' => $reason , 'amount' =>$price ]);

    }
}
if (!function_exists('convertCurrency')):
    function convertCurrency($price)
    {

        $ConvertedPrice=$price;
            $symbol='$';
        if (Auth::check()):

            $data= App\Currency::all();
        $title= DB::table('users')->join('currencies', 'currencies.id', '=','users.currency_id')
        ->where('users.id', Auth::user()->id)
        ->select('currencies.*')
        ->get();
        if(count($data)==0)
        {
            $symbol='$';
            $res=App\Currency::Create(['name'=>'US Dollar',
                'code'=>'USD',
                'symbol'=> $symbol,
                'rate'=>1,
            ]); 
            $id= $res->id;
            $currency = App\Currency::findOrFail($id);
            $currency->symbol=$symbol;
            $currency->save();
            $data= App\Currency::all();
            $title= DB::table('users')->join('currencies', 'currencies.id', '=','users.currency_id')
            ->where('users.id', \Auth::user()->id)
            ->select('currencies.*')
            ->get();
        }
        if(count($title)==0)
        {
            $user=App\User::findorFail(\Auth::user()->id);
            $user->currency_id=1;
            $user->save();
            $title= DB::table('users')->join('currencies', 'currencies.id', '=','users.currency_id')
            ->where('users.id',\ Auth::user()->id)
            ->select('currencies.*')
            ->get();
        }
        Session::put('title',$title);
        Session::put('currency', $data);

            $rate= \DB::table('users')->join('currencies', 'currencies.id', '=','users.currency_id')
            ->where('users.id', \Auth::user()->id)
            ->select('currencies.*')
            ->get();
            foreach($rate as $r)
            {
            $ConvertedPrice=$r->rate*$price;
            $symbol=$r->symbol;
            } 
        endif;
        $data=array('price'=>$ConvertedPrice,
            'symbol'=>$symbol);

            return $data;
    }
endif;