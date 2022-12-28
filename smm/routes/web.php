<?php
Route::group(['middleware' => 'VerifyAppIsNotInstalled'], function () {
    Route::get('/install', 'InstallationController@index');
    Route::get('/install/step1', 'InstallationController@step1');
    Route::post('/install/step1', 'InstallationController@storeStep1');
    Route::get('/install/success', 'InstallationController@success');
});

Route::get('/user/verify/{token}', 'HomeController@verifyUser');
Route::get('/email/verify', 'HomeController@getVerificationform');
Route::post('/email/verify', 'HomeController@sendVerficationMail');
Route::get('/change-email', 'HomeController@getEmailform');
Route::post('/email/change', 'HomeController@changeEmailform');
Route::get('/enter-otp', 'HomeController@getotpform');
Route::post('/email/otp', 'HomeController@enterotpform');
Route::get('/update','UpdateController@update');
Route::get('/update-progress','UpdateController@updateProgress');
Route::get('/update-complete','UpdateController@updateComplete');
Route::any('/cashmaal/ipn','CashmaalController@ipn');

Route::group(['middleware' => 'VerifyAppInstalled'], function () {

    Route::post('/change-lang', 'HomeController@changeLanguage');

    Auth::routes();
    Route::group(['middleware' => 'notAdmin'], function () {
     Route::post('/change-currency','HomeController@changeCurrency');
       Route::get('/servicetracker', 'HomeController@packagetracker');
       Route::get('/servicetracker/data', 'HomeController@packagetrackerindexData');
       Route::post('/servicetracker/search', 'HomeController@searchServicetracker');
        Route::get('/', 'HomeController@index');
       Route::get('/faqs', 'HomeController@indexfaq');
      Route::get('/howitwork', 'HomeController@indexhiw');
        Route::get('/makemoney', 'HomeController@indexmakemoney');
       Route::get('ref/{name}/{uid}','VisitController@index');
 //      Route::get('/checkusers', 'InstallationController@getUserData');
        
        Route::get('/services', 'HomeController@showServices');
      Route::post('/services/search', 'HomeController@searchServices');
         Route::get('/affiliates','ReferralController@showAffiliates');
        
   //     Route::get('/remove_table/{id}','ReferralController@removetable');
       Route::get('/services', 'HomeController@showServices');
        Route::group(['middleware' => 'VerifyModuleAPIEnabled'], function () {
            Route::get('/api', 'HomeController@ApiDocV2');
            Route::get('/api-v1', 'HomeController@ApiDocV1');
        });
        Route::get('/check', function () {
            $exitCode = Artisan::call('status:check');
        });  
        Route::get('/perf', function () {
            $exitCode = Artisan::call('check:perf');
        });  
        Route::get('/send', function () {
            $exitCode = Artisan::call('orders:send');
        }); 
        Route::get('/drip', function () {
            $exitCode = Artisan::call('drip:feed');
        });  
        Route::get('/like', function () {
            $exitCode = Artisan::call('auto:like');
        });          
        Route::get('/syncseller', function () {
            $exitCode = Artisan::call('seller:sync');
        });  
        

        
    });
   Route::group(['middleware' => 'notModerator'], function () {
        
        Route::get('/', 'HomeController@index');
   //     Route::get('ref/{name}/{uid}','VisitController@index');
        Route::get('/checkusers', 'InstallationController@getUserData');
     //   Route::get('/services', 'HomeController@showServices');
      Route::post('/services/search', 'HomeController@searchServices');
        
         Route::get('/affiliates','ReferralController@showAffiliates');
        Route::get('/servicetracker', 'HomeController@packagetracker');
       Route::get('/servicetracker/data', 'HomeController@packagetrackerindexData');
     //   Route::get('/remove_table/{id}','ReferralController@removetable');
     //   Route::get('/services', 'HomeController@showServices');
        Route::group(['middleware' => 'VerifyModuleAPIEnabled'], function () {
            Route::get('/api', 'HomeController@ApiDocV2');
            Route::get('/api-v1', 'HomeController@ApiDocV1');
        });
        Route::get('/check', function () {
            $exitCode = Artisan::call('status:check');
        });  
        Route::get('/perf', function () {
            $exitCode = Artisan::call('check:perf');
        });  
        Route::get('/send', function () {
            $exitCode = Artisan::call('orders:send');
        }); 
        Route::get('/drip', function () {
            $exitCode = Artisan::call('drip:feed');
        });  
        Route::get('/like', function () {
            $exitCode = Artisan::call('auto:like');
        });          
        Route::get('/syncseller', function () {
            $exitCode = Artisan::call('seller:sync');
        });  

        
    });
    Route::get('page/{slug}', 'HomeController@showPage');

    // IPN Handlers
    Route::post('/payment/add-funds/bitcoin/bit-ipn', 'CoinPaymentsController@ipn');
    Route::post('/payment/add-funds/payza/status', 'PayzaController@ipn');
    Route::post('/payment/add-funds/paypal/status', 'PaypalController@ipn');
    Route::post('/payment/add-funds/instamojo/webhook', 'InstamojoController@webhook');
    Route::post('/payment/add-funds/skrill/ipn', 'SkrillController@ipn');
    Route::post('/payment/add-funds/paywant/status', 'PaywantController@paywantNotify');
    Route::post('/payment/add-funds/paytm/status', 'PaytmBController@ipn');

    Route::group(['middleware' => 'auth'], function () {

        Route::group(['middleware' => 'user'], function () {
           Route::get('/changelogs', 'SyncController@syncIndex');
            Route::get('/synced-index/data', 'SyncController@syncIndexData');
            Route::get('/order/new', 'OrderController@newOrder');
            
            
            Route::get('/order/my-favorites', 'OrderController@favorites');
            Route::get('/order/topservices', 'OrderController@topservices');
            Route::get('/order/premiumnew', 'OrderController@premiumOrder');
            Route::get('/order/digitalnew', 'OrderController@digitalOrder');
            Route::post('/orders/search', 'OrderController@searchOrders');
            Route::post('/addtofavorite', 'HomeController@addtofavorite');
           Route::get('/panelorders-index/data', 'ChildPanelController@indexData');
            Route::get('child-panels/new/order', 'ChildPanelController@create');
            Route::get('child-panels/orders/sync', 'ChildPanelController@sync');
            Route::get('/service/get-packages/{service_id}', 'OrderController@getPackages');
            Route::get('/service/get-fpackages/{service_id}', 'OrderController@getfPackages');
            Route::get('/panels-filter/{status}', 'ChildPanelController@index');
            Route::get('/panels-filter-ajax/{status}/data', 'ChildPanelController@indexFilterData');
            Route::resource('/child-panels', 'ChildPanelController');
            
            Route::post('/order', 'OrderController@store');
            Route::post('top/order', 'OrderController@topstore');
            Route::get('/order/mass-order', 'OrderController@showMassOrderForm');
            Route::post('/order/mass-order', 'OrderController@storeMassOrder');
            Route::get('/broadcast/{cache_id}', 'DashboardController@getBroadCast');
            Route::get('/messages', 'DashboardController@indexMessages');
            Route::get('/orders/{order}/cancel', 'OrderController@cancel');
            Route::get('/payment/add-funds/coupon', 'CouponController@showForm')->name("coupon-form");
            Route::post('/payment/add-funds/coupon', 'CouponController@store')->name("couponcartform");
            Route::get('/dashboard', 'DashboardController@index');
            Route::get('/orders', 'OrderController@index');
            Route::get('/orders-index/data', 'OrderController@indexData');
            Route::get('/orders-filter/{status}', 'OrderController@indexFilter');
            Route::get('/orders-filter-ajax/{status}/data', 'OrderController@indexFilterData');
            Route::get('/orders/{order}/refill', 'OrderController@refill');
            Route::get('/orders/{order}/cancel', 'OrderController@cancel');
            Route::get('/test-controller','CurrencyController@index');
            Route::get('/rave/callback', 'FlutterWaveController@callback');
            Route::get('/payment/add-funds/flutterwave', 'FlutterWaveController@showForm');
            Route::get('/payment/add-funds/flutterwave/success', 'FlutterWaveController@success');
            Route::get('/payment/add-funds/flutterwave/cancel', 'FlutterWaveController@cancel');
            
            Route::post('/payment/add-funds/flutterwave', 'FlutterWaveController@store');

            Route::put('/redeem', 'AccountController@redeemPoints');
            Route::get('/points-history', 'AccountController@getRedeemHistory');
            Route::get('/points-history-index/data', 'AccountController@getRedeemHistoryData');
            Route::resource('/blog', 'BlogController');
            Route::get('blog/{id}/show','BlogController@show');
            Route::get('/subscriptions', 'SubscriptionController@index');
            Route::get('/subscriptions/{id}', 'SubscriptionController@show');
            Route::get('/subscriptions-index/data', 'SubscriptionController@indexData');
            Route::get('/subscription/new', 'SubscriptionController@create');
            Route::post('/subscription', 'SubscriptionController@store');
           Route::get('/payment/add-funds/razorpay', 'RazorpayController@showForm')->name("razor-form");
            Route::post('/payment/add-funds/razorpay', 'RazorpayController@store')->name('razorpaymentform');
            Route::post('/payment/razorpay', 'RazorpayController@payment')->name('razorpayment');
            Route::post('/payment/add-funds/razorpay', 'RazorpayController@store')->name('razorpaymentform');
            Route::get('/account/settings', 'AccountController@showSettings');
            Route::put('/account/password', 'AccountController@updatePassword');
            Route::put('/account/config', 'AccountController@updateConfig');
            Route::get('/account/update', 'AccountController@updateKey');
             Route::post('/account/api', 'AccountController@generateKey');
            Route::post('/account/api1', 'HomeController@generateKey');
            Route::get('/account/funds-load-history', 'AccountController@getFundsLoadHistory');
            Route::get('/payment/add-funds/cashmaal', 'CashmaalController@showForm');
            Route::post('/payment/add-funds/cashmaal', 'CashmaalController@store');
            Route::any('/payment/cashmaal/cancel', 'CashmaalController@fail');            
            
            Route::get('account/funds-load-history-index/data', 'AccountController@getFundsLoadHistoryData');
            Route::get('/payment/add-funds/perfectmoney', 'PerfectmoneyController@showForm')->name("perfectmoney-form");
            Route::post('/payment/add-funds/perfectmoney', 'PerfectmoneyController@store')->name("perfectmoneycartform");
            Route::get('payment/validate/perfectmoney', 'PerfectmoneyController@payment');
            Route::get('payment/checkout/perfectmoney', 'PerfectmoneyController@checkoutstore');
            Route::post('payment/checkout/perfectmoney', 'PerfectmoneyController@checkoutstore');
            Route::post('payment/validate/perfectmoney', 'PerfectmoneyController@payment')->name("perfectmoneypayment");
            Route::post('payment/status/perfectmoney', 'PerfectmoneyController@paymentcancel');
            Route::get('payment/status/perfectmoney', 'PerfectmoneyController@paymentcancel')->name("perfectmoneycancel");
            Route::get('/payment/add-funds', 'PaymentController@getPaymentMethods');
            Route::get('/payment/add-funds/phonepe', 'PhonepeController@show');
            Route::post('/payment/add-funds/phonepe', 'PhonepeController@store');
            Route::get('/payment/add-funds/payoneer', 'PayoneerController@show');
            Route::post('/payment/add-funds/payoneer', 'PayoneerController@store');
            Route::get('/payment/add-funds/stripe', 'StripeController@showForm');
            Route::post('/payment/add-funds/stripe', 'StripeController@store');

            Route::get('/payment/add-funds/paypal', 'PaypalController@showForm');
            Route::post('/payment/add-funds/paypal', 'PaypalController@store');
            Route::get('/payment/add-funds/paypal/success', 'PaypalController@success');
            Route::get('/payment/add-funds/paypal/cancel', 'PaypalController@cancel');
            Route::get('/payment/add-funds/payu', 'PayuController@show');
            Route::post('/payment/add-funds/payu', 'PayuController@store');
            Route::post('/payment/add-funds/payu/success', 'PayuController@successful');
            Route::post('/payment/add-funds/payu/fail', 'PayuController@fail');
            Route::get('/payment/add-funds/bitcoin', 'CoinPaymentsController@showForm');
            Route::post('/payment/add-funds/bitcoin', 'CoinPaymentsController@store');
            Route::get('/payment/add-funds/bitcoin/cancel', 'CoinPaymentsController@cancel');
            Route::get('/payment/add-funds/bitcoin/success', 'CoinPaymentsController@success');
            
            Route::get('/payment/add-funds/payza', 'PayzaController@show');
            Route::post('/payment/add-funds/payza', 'PayzaController@store');
            Route::get('/payment/add-funds/payza/cancel', 'PayzaController@cancel');
            Route::get('/payment/add-funds/payza/success', 'PayzaController@success');
            Route::get('/payment/add-funds/paytmb', 'PaytmBController@show');
            Route::post('/payment/add-funds/paytmb', 'PaytmBController@store');
            Route::get('/payment/add-funds/bank-other', 'HomeController@showManualPaymentForm');

            Route::get('/payment/add-funds/instamojo', 'InstamojoController@show');
            Route::post('/payment/add-funds/instamojo', 'InstamojoController@store');
            Route::get('/payment/add-funds/instamojo/return', 'InstamojoController@redirectReturn');

            Route::get('/dripfeed', 'DripFeedController@index');
            Route::get('/dripfeed-index/data', 'DripFeedController@indexData');
            Route::get('/dripfeed/{df}/details', 'DripFeedController@details');

            Route::get('/autolike', 'AutoLikeController@index');
            Route::get('/autolike-index/data', 'AutoLikeController@indexData');
            Route::get('/autolike/{al}/details', 'AutoLikeController@details');
            Route::get('/payment/add-funds/razorp', 'RazorpController@show');
            Route::post('/payment/add-funds/razorp', 'RazorpController@store');
            Route::get('/payment/add-funds/skrill', 'SkrillController@show');
            Route::post('/payment/add-funds/skrill', 'SkrillController@store');
            Route::get('/payment/add-funds/skrill/success', 'SkrillController@success');
            Route::get('/payment/add-funds/skrill/cancel', 'SkrillController@cancel');

            Route::get('/payment/add-funds/paytm', 'PaytmController@show');
            Route::post('/payment/add-funds/paytm', 'PaytmController@store');

            Route::get('/payment/add-funds/paywant', 'PaywantController@show');
            Route::post('/payment/add-funds/paywant', 'PaywantController@store');
            Route::get('/payment/add-funds/paywant/success', 'PaywantController@success');
            Route::get('/payment/add-funds/paywant/cancel', 'PaywantController@cancel');
            Route::get('/backof', 'DashboardController@loginBack');

            Route::get('/support', 'SupportController@index');
            Route::get('/support-index/data', 'SupportController@indexData');
            Route::get('/support/ticket/create', 'SupportController@create');
            Route::post('/support/ticket/store', 'SupportController@store');
            Route::get('/support/ticket/{id}', 'SupportController@show');
            Route::post('/support/{id}/message', 'SupportController@message');
        });

        // Admin
        Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {
            Route::get('/cashes', 'CashController@index');
            Route::resource('/ips', 'IpsController');
            Route::get('/ips-ajax/data', 'IpsController@indexData');
            Route::get('/', 'DashboardController@index');
            Route::get('/dash', 'DashboardController@indexdash');
            Route::post('/note', 'DashboardController@saveNote');
            Route::get('/account/settings', 'AccountController@showSettings');
            Route::put('/account/password', 'AccountController@updatePassword');
            Route::get('/profit', 'DPController@profit');
            Route::get('/mprofit', 'DPController@wprofit');
            Route::get('/package/{package}/up', 'PackageController@up');
            Route::get('/package/{package}/down', 'PackageController@down');
            Route::resource('/services', 'ServiceController');
            
            Route::resource('/ads', 'AdsController');
            Route::get('/ads-ajax/data', 'AdsController@indexData');
            Route::resource('/newsletter', 'NewsletterController');
            Route::get('/export/newsletter', 'NewsletterController@export');
            Route::get('/newsletter-ajax/data', 'NewsletterController@indexData');
            Route::post('/services/sequence', 'ServiceController@saveSequence');
            Route::post('/packages/sequence', 'ServiceController@packageSequence');

            
            Route::get('/top-services', 'ServiceController@getTopServices');
            Route::get('/packages/top/{id}/edit', 'ServiceController@editTopServices');
            Route::post('topservice/store', 'ServiceController@storeTopServices');
            Route::delete('packages/top/{id}', 'ServiceController@deleteTopServices');
            Route::get('/top-services/create', 'ServiceController@createTopServices');
            Route::get('/top-services-ajax/data', 'ServiceController@TopindexData');
            Route::get('/services-index/data', 'ServiceController@indexData');
            Route::get('/codes', 'LicenseCodeController@index');
            Route::get('/codes-ajax/data', 'LicenseCodeController@indexData');
            Route::get('/service/{service}/up', 'ServiceController@ups');
            Route::get('/service/{service}/down', 'ServiceController@downs');
            Route::get('/service/package/{package}/up', 'ServiceController@up');
            Route::get('/service/package/{package}/down', 'ServiceController@down');
            Route::get('/services/{service}/details', 'ServiceController@details');
            Route::get('/active/{service}/{package}', 'ServiceController@activeSP');
            Route::get('/inactive/{service}/{package}', 'ServiceController@inactiveSP');
            Route::get('/delete/{service}/{package}', 'ServiceController@deleteSP');
            Route::get('/downloads','OrderController@downloads');
            Route::get('/downloadrecords-ajax/data', 'OrderController@downloadsindexData');
            Route::get('/systeminfo', 'ConfigController@index');
            Route::resource('/child-panels', 'ChildPanelController');
            Route::get('child-panels/orders/', 'ChildPanelController@show');
            Route::get('child-panels/orders/sync', 'ChildPanelController@sync');
            Route::put('child-panels/order/{id}', 'ChildPanelController@updateorder');
            Route::get('child-panels-orders/data', 'ChildPanelController@getorders');
            Route::post('/child-panels/update/price', 'ChildPanelController@updatePrice');
            Route::get('/system/settings', 'ConfigController@edit');
            Route::put('/system/settings', 'ConfigController@update');
            Route::get('/users/{id}/login', 'UserController@loginAs');

            Route::resource('/payment-methods', 'PaymentMethodController');
            Route::resource('/commission','CommissionController');
            Route::resource('/popup-notification','PopupNotificationController');
            Route::get('/affiliate_transactions','CommissionController@affiliate_transaction');
            Route::get('/remove_table/{id}','CommissionController@removetable');

            Route::get('/fund-records/{id}', 'UserController@newFundIndex');
            Route::get('/fund-records/data/{id}', 'UserController@indexFundData');
            Route::get('/blog-ajax/data', 'BlogController@indexData');
            Route::resource('/blog', 'BlogController');
            Route::get('blog/{id}/show','BlogController@show');
            Route::get('/apifetch', 'FetchController@index');
            Route::post('/apifetch/show', 'FetchController@showData');
            Route::get('/apifetch/getmap', 'FetchController@getMap');
            Route::post('/apifetch/savemap', 'FetchController@saveMap');
            Route::get('/apifetch/data', 'FetchController@getData');
            Route::post('/apifetch/save', 'FetchController@saveData');
            Route::get('/apifetch/redirect', 'FetchController@redirect');
            
            Route::get('/mail', 'SyncController@mail'); 
            Route::get('/synced', 'SyncController@syncIndex');
            Route::get('/synced-index/data', 'SyncController@syncIndexData');
            Route::resource('/services', 'ServiceController');
            Route::get('/services-index/data', 'ServiceController@indexData');
            Route::resource('/currency', 'CurrencyController');
            Route::get('/currency-data', 'CurrencyController@IndexData');
            Route::get('/currency/edit/{id}', 'CurrencyController@edit');
            Route::delete('/currency/delete/{id}', 'CurrencyController@destroy');
            Route::get('/currency/create', 'CurrencyController@create');
            Route::post('/currency/store', 'CurrencyController@store');
            Route::resource('/packages', 'PackageController');
            Route::get('/packages-index/data', 'PackageController@indexData');
            Route::post('/packages/ajax', 'PackageController@ajaxPost');
            Route::post('/packages/ajax/{id}', 'PackageController@update');
            Route::post('/packages/create', 'PackageController@ajaxPost');

            Route::post('/users/package-special-prices/{id}', 'UserController@packageSpecialPrices');
            Route::resource('/users', 'UserController');
            Route::resource('/groups', 'GroupController');
            Route::post('/users/add-funds/{id}', 'UserController@addFunds');
            Route::get('/users-ajax/data', 'UserController@indexData');
            Route::get('/groups-ajax/data', 'GroupController@indexData');
            Route::get('/users-referralajax/data', 'UserController@referralindexData');
             Route::get('/referral', 'UserController@referralindex');

                        Route::post('/add-funds/admin', 'UserController@addFundsAdmin');
            Route::post('order/search', 'OrderController@orderSearch');
            Route::get('order/search', 'OrderController@orderSearch');
            Route::post('/pending-orders-bulk-update', 'AutomateController@bulkUpdatePending');

            Route::get('/dripfeed', 'DripFeedController@index');
            Route::get('/dripfeed-index/data', 'DripFeedController@indexData');
            Route::get('/dripfeed/edit/{dripfeed}', 'DripFeedController@edit');
            Route::post('/dripfeed', 'DripFeedController@update');
            Route::get('/dripfeed/{df}/details', 'DripFeedController@details');
            Route::get('/orders-filters/manual', 'OrderController@indexmanual');
            Route::get('/orders-filters-ajax/manual/data', 'OrderController@indexDataManual');
            Route::get('/autolike', 'AutoLikeController@index');
            Route::get('/autolike-index/data', 'AutoLikeController@indexData');
            Route::get('/autolike/edit/{autolike}', 'AutoLikeController@edit');
            Route::post('/autolike', 'AutoLikeController@update');
            Route::get('/autolike/{al}/details', 'AutoLikeController@details');
            
            Route::get('/points-history', 'UserController@getRedeemHistory');
            Route::get('/points-history/data', 'UserController@getRedeemHistoryData');
             Route::put('/users/point-funds/{id}', 'UserController@redeemAccept');
            Route::put('/users/point-fundsreject/{id}', 'UserController@redeemReject');
            Route::resource('/orders', 'OrderController');
            Route::post('/order/{id}/complete', 'OrderController@completeOrder');
            Route::get('/orders-ajax/data', 'OrderController@indexData');
            Route::post('/orders-bulk-update', 'OrderController@bulkUpdate');
            Route::get('/orders-filter/{status}', 'OrderController@indexFilter');
            Route::get('/orders-filter-ajax/{status}/data', 'OrderController@indexFilterData');

            Route::get('/subscriptions', 'SubscriptionController@index');
            Route::get('/subscriptions-index/data', 'SubscriptionController@indexData');
            Route::get('/subscriptions/{id}/edit', 'SubscriptionController@edit');
            Route::post('/subscriptions/{id}', 'SubscriptionController@update');
            Route::put('/subscriptions/{id}/cancel', 'SubscriptionController@cancel');
            Route::put('/subscriptions/{id}/stop', 'SubscriptionController@stop');
            Route::get('/subscriptions/{id}/orders', 'SubscriptionController@orders');
            Route::post('/subscriptions/{id}/order', 'SubscriptionController@storeOrder');
            Route::get('/subscriptions-filter/{status}', 'SubscriptionController@indexFilter');
            Route::get('/subscriptions-filter-ajax/{status}/data', 'SubscriptionController@indexFilterData');

            Route::get('/broadcast', 'BroadcastController@index');
            Route::get('/broadcast-index/data', 'BroadcastController@indexData');
            Route::get('/broadcast/create', 'BroadcastController@create');
            Route::get('/broadcast/{id}', 'BroadcastController@edit');
            Route::get('/broadcast/delete/{id}', 'BroadcastController@destroy');
            Route::post('/broadcast/{id}/update', 'BroadcastController@update');
            Route::post('/broadcast', 'BroadcastController@addfunc');
            
            Route::get('/users/{user}/message', 'UserController@message');
            Route::post('/users/message', 'UserController@postmessage');
            Route::delete('support/message/destroy/{id}','SupportController@destroyMsg');
            Route::post('support/message/{id}','SupportController@editMessage');
            Route::resource('/support/tickets', 'SupportController');
            Route::get('/support/tickets/{id}/close', 'SupportController@close');
            Route::post('/support/{id}/message', 'SupportController@message');
            Route::get('/orders-index/data', 'SupportController@indexData');
            Route::get('/ticket-filter/{topic}', 'SupportController@indexFilter');
            Route::get('/ticket-filter-ajax/{topic}/data', 'SupportController@indexFilterData');
            Route::get('/ticket-new/{topic}', 'SupportController@indexNFilter');
            Route::get('/ticket-new-ajax/{topic}/data', 'SupportController@indexNFilterData');

            Route::get('/funds-load-history', 'UserController@getFundsLoadHistory');
            Route::get('/funds-load-history/data', 'UserController@getFundsLoadHistoryData');

            Route::get('/pages', 'PageController@index');
            Route::get('/page-edit/{slug}', 'PageController@edit');
            Route::put('/page-edit/{id}', 'PageController@update');
            Route::get('/automate/api/addmxz', 'AutomateController@addApimxz');
            Route::post('/automate/api/addmxz', 'AutomateController@storeApimxz');
            Route::get('/automate/api/addperfectpanel', 'AutomateController@addApiperfect');
            Route::post('/automate/api/addperfectpanel', 'AutomateController@storeApiperfect');
            Route::get('/automate/api-list', 'AutomateController@listApi');
            Route::get('/automate/send-orders', 'AutomateController@sendOrdersIndex');
            Route::get('/automate/send-orders-index/data', 'AutomateController@sendOrdersIndexData');
            Route::post('/automate/send-order-to-api', 'AutomateController@sendOrderToApi');

            Route::get('/automate/response-logs', 'AutomateController@getResponseLogsIndex');
            Route::get('/automate/response-logs-index/data', 'AutomateController@getResponseLogsIndexData');
            Route::get('notification/{id}','OrderController@notification');

            Route::get('/refills/list', 'RefillRequestController@index');
            Route::get('/refills-ajax/data', 'RefillRequestController@indexData');
            Route::get('/refills-filter/{status}', 'RefillRequestController@indexFilter');
            Route::get('/refills-filter-ajax/{status}/data', 'RefillRequestController@indexFilterData');
            Route::get('/refills/{order}/details', 'RefillRequestController@details');
            Route::get('/refill/{refill}/{status}', 'RefillRequestController@changeStatus');            
            
            Route::get('/automate/api/add', 'AutomateController@addApi');
            Route::post('/automate/api/add', 'AutomateController@storeApi');
            Route::get('/automate/api/{id}/edit', 'AutomateController@editApi');
            Route::delete('/automate/api/{id}', 'AutomateController@deleteApi');
            Route::put('/automate/api/{id}', 'AutomateController@updateApi');
            Route::post('/automate/api/mapping/{id}', 'AutomateController@storeMapping');
//Copuon routes
            Route::get('/coupons', 'CouponController@index');
            Route::get('/coupons/create', 'CouponController@create');
            Route::get('/coupons/{id}/edit', 'CouponController@edit');
            Route::put('/coupons/{id}/update', 'CouponController@update');
            Route::post('/coupons/store', 'CouponController@store');
            Route::get('/coupons/history', 'CouponController@history');
            Route::delete('/coupons/{id}', 'CouponController@destroy');
            Route::delete('/coupons/history/{id}', 'CouponController@destroyhistory');
            Route::get('/coupons-ajax/data', 'CouponController@indexData');
            Route::get('/coupons-history-ajax/data', 'CouponController@history');
            Route::get('/refill-complete', 'RefillRequestController@completeStatus');
            
            Route::get('/automate/get-status', 'AutomateController@getOrderStatusIndex');
            Route::get('/automate/get-status-index/data', 'AutomateController@getOrderStatusIndexData');
            Route::post('/automate/get-status-from-api', 'AutomateController@getOrderStatusFromAPI');
            Route::post('/automate/change-reseller', 'AutomateController@changeReseller');

            Route::get('/system/refresh', 'DashboardController@refreshSystem');
        });

        Route::group(['middleware' => 'admin'], function () {
            Route::get('/admin/system/transfer', 'InstallationController@transfer');
            Route::post('/admin/system/transfer/process', 'InstallationController@processTransfer');
            Route::get('/admin/system/transfer/success', 'InstallationController@transferSuccess');
        });
        // Moderator
        Route::group(['prefix' => 'moderator', 'namespace' => 'Moderator', 'middleware' => 'moderator'], function () {
            Route::resource('/', 'SupportController');

            Route::get('/account/settings', 'AccountController@showSettings');
            Route::get('/account/settings', 'AccountController@showSettings');
            Route::put('/account/password', 'AccountController@updatePassword');

            Route::resource('/orders', 'OrderController');
            Route::post('/order/{id}/complete', 'OrderController@completeOrder');
            Route::get('/orders-ajax/data', 'OrderController@indexData');
            Route::post('/orders-bulk-update', 'OrderController@bulkUpdate');
            Route::get('/orders-filter/{status}', 'OrderController@indexFilter');
            Route::get('/orders-filter-ajax/{status}/data', 'OrderController@indexFilterData');
            Route::get('/dripfeed', 'DripFeedController@index');
            Route::get('/dripfeed-index/data', 'DripFeedController@indexData');
            Route::get('/dripfeed/edit/{dripfeed}', 'DripFeedController@edit');
            Route::post('/dripfeed', 'DripFeedController@update');
            Route::get('/dripfeed/{df}/details', 'DripFeedController@details');
            
            Route::get('/autolike', 'AutoLikeController@index');
            Route::get('/autolike-index/data', 'AutoLikeController@indexData');
            Route::get('/autolike/edit/{autolike}', 'AutoLikeController@edit');
            Route::post('/autolike', 'AutoLikeController@update');
            Route::get('/autolike/{al}/details', 'AutoLikeController@details');


            Route::resource('/support/tickets', 'SupportController');
            Route::post('/support/{id}/message', 'SupportController@message');
             Route::get('/ticket-filter/{topic}', 'SupportController@indexFilter');
            Route::get('/ticket-filter-ajax/{topic}/data', 'SupportController@indexFilterData');
            Route::get('/ticket-new/{topic}', 'SupportController@indexNFilter');
            Route::get('/ticket-new-ajax/{topic}/data', 'SupportController@indexNFilterData');
            Route::get('/orders-index/data', 'SupportController@indexData');

            Route::get('/funds-load-history', 'UserController@getFundsLoadHistory');
            Route::get('/funds-load-history/data', 'UserController@getFundsLoadHistoryData');
            Route::get('/refills/list', 'RefillRequestController@index');
            Route::get('/refills-ajax/data', 'RefillRequestController@indexData');
            Route::get('/refill-complete', 'RefillRequestController@completeStatus');
            Route::get('/refills-filter/{status}', 'RefillRequestController@indexFilter');
            Route::get('/refills-filter-ajax/{status}/data', 'RefillRequestController@indexFilterData');
            Route::get('/refills/{order}/details', 'RefillRequestController@details');
            Route::get('/refill/{refill}/{status}', 'RefillRequestController@changeStatus');            
            Route::get('/system/refresh', 'DashboardController@refreshSystem');
        });

        Route::group(['middleware' => 'moderator'], function () {
            Route::get('/moderator/system/transfer', 'InstallationController@transfer');
            Route::post('/moderator/system/transfer/process', 'InstallationController@processTransfer');
            Route::get('/moderator/system/transfer/success', 'InstallationController@transferSuccess');
        });
    });

});
Route::get('clear', function () {    
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    dd("Done");
});

Route::post('/payment/cashmaal/success', 'CashmaalController@successful');
Route::post('newsletter','HomeController@newsletter');
Route::get('kb','HomeController@blog');
Route::get('kb/{slug}','HomeController@showpost');
Route::get('/login/{social}', 'Auth\LoginController@redirectToProvider');
Route::get('/login/{social}/callback','Auth\LoginController@handleProviderCallback');
Route::get('/transfer/ready', 'InstallationController@transferReady');
Route::get('/transfer/restore', 'InstallationController@restore');
Route::post('/transfer/restore/process', 'InstallationController@processRestore');
Route::get('/transfer/restore/success', 'InstallationController@restoreSuccess');
Route::get('download/{id}/{token}', 'HomeController@DownloadScript');
