@extends('layouts.app')
@section('title', getOption('app_name') . ' - FAQS')
@section('content')
<div class="inner-dashboard faqPage">
  <div class="row">
    <div class="col-md-12">
      <div class="well">
        <div class="wellHeader">
            <h2>FAQ's <small>(Frequently Asked Questions)</small></h2>
        </div>
        <div class="panel-group" id="accordion">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a aria-expanded="false" class="" data-parent="#accordion" data-toggle="collapse" href="#collapse1">How
                  To Add Funds In Panel ?</a></h4>
            </div>
            <div aria-expanded="false" class="panel-collapse collapse in" id="collapse1" style="">
              <div class="panel-body">
                Simply Go This Page <a href="http://opasocial.com/payment/add-funds" title="" target="">Add Funds</a>
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a aria-expanded="false" class="collapsed" data-parent="#accordion" data-toggle="collapse"
                  href="#collapse2">How To Order Service ?</a>
              </h4>
            </div>
            <div aria-expanded="false" class="panel-collapse collapse" id="collapse2" style="height: 0px;">
              <div class="panel-body">
                Simply Go to This Page.<a href="http://opasocial.com/order/new"> Order Services</a> (Order The Service
                You Want Facebook, Instagram, Youtube &amp; Manymore)
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a aria-expanded="false" class="collapsed" data-parent="#accordion" data-toggle="collapse"
                  href="#collapse3">How Much time it will take to complete an order ?</a>
              </h4>
            </div>
            <div aria-expanded="false" class="panel-collapse collapse" id="collapse3" style="height: 0px;">
              <div class="panel-body">
                Every Service Have Its Description Box Where The Exact Time Is Mentioned.
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a aria-expanded="false" class="collapsed" data-parent="#accordion" data-toggle="collapse"
                  href="#collapse4">How To Fill The Field Link Depending On The Type Of Service ?</a>
              </h4>
            </div>
            <div aria-expanded="false" class="panel-collapse collapse" id="collapse4" style="height: 0px;">
              <div class="panel-body">
                Instagram Likes Fast: <a href="http://instagram.com/p/xxx/" rel="nofollow"
                  target="_blank">http://instagram.com/p/xxx/</a><br>
                Instagram Likes Fake HQ: <a href="http://instagram.com/p/xxx/" rel="nofollow"
                  target="_blank">http://instagram.com/p/xxx/</a> or <a href="http://instagram.com/username/p/xxx/"
                  rel="nofollow" target="_blank">http://instagram.com/username/p/xxx/</a><br>
                Instagram Comments: <a href="http://instagram.com/p/xxx/" rel="nofollow"
                  target="_blank">http://instagram.com/p/xxx/</a><br>
                Real Instagram Followers: username<br>
                Real Instagram Likes: <a href="http://instagram.com/p/xxx/" rel="nofollow"
                  target="_blank">http://instagram.com/p/xxx/</a><br>
                Real Instagram Followers RUS: <a href="http://instagram.com/username" rel="nofollow"
                  target="_blank">http://instagram.com/username</a><br>
                Real Instagram Likes RUS: <a href="http://instagram.com/p/xxx/" rel="nofollow"
                  target="_blank">http://instagram.com/p/xxx/</a>Twitter Followers: <a
                  href="http://twitter.com/username" rel="nofollow" target="_blank">http: //twitter.com/username</a><br>
                Twitter Retweets / Favorite/Likes: <a href="https://twitter.com/username/status/344828701747339264"
                  rel="nofollow" target="_blank">https://twitter.com/username/status/344828701747339264</a>
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a aria-expanded="false" class="collapsed" data-parent="#accordion" data-toggle="collapse"
                  href="#collapse5">The Average Time Of Completion On Orders ?</a>
              </h4>
            </div>
            <div aria-expanded="false" class="panel-collapse collapse" id="collapse5" style="height: 0px;">
              <div class="panel-body">
                All Orders Will Complete Within 24 hours Of The Order. Instagram &amp; Twitter Orders May Take Longer To
                Complete (1-3 days) Will I Be Refunded For Drop Followers Or Likes? No, Likes/followers May Possibly
                Drop, This Is Because Of The Updates In Twitter/Instagram/Facebook/Youtubr. This Would Only Be Around
                2-3 Followers Per Update. (Max). No Refunds For The Payments.
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a aria-expanded="false" class="collapsed" data-parent="#accordion" data-toggle="collapse"
                  href="#collapse6">Can I Cancel An Order That I Gave ?</a>
              </h4>
            </div>
            <div aria-expanded="false" class="panel-collapse collapse" id="collapse6" style="height: 0px;">
              <div class="panel-body">
                No, Orders are Permanent, Cannot Be Canceled By Admin. All Users Must Be To The Public Before The Order
                Is Placed Until The Order Is Finished. If The User Is On Private, Please Note That a Refund Is Not
                Issued as It Will Still Hit Our Servers No Matter What!
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a aria-expanded="false" class="collapsed" data-parent="#accordion" data-toggle="collapse"
                  href="#collapse7">When can you activate my Paypal?</a>
              </h4>
            </div>
            <div aria-expanded="false" class="panel-collapse collapse" id="collapse7" style="height: 0px;">
              <div class="panel-body">
                You can use Paypal whenever you want by following the instructions in the Add Funds page (manual use) To
                have it automatically enabled, you have to have added at least 200$ in your account, and then you can
                send us a ticket with your email to enable it for you!
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a aria-expanded="false" class="collapsed" data-parent="#accordion" data-toggle="collapse"
                  href="#collapse8">Do you accept Paytm?</a>
              </h4>
            </div>
            <div aria-expanded="false" class="panel-collapse collapse" id="collapse8" style="height: 0px;">
              <div class="panel-body">
                Yes, Paytm is only available in India and we are accepting Paytm payments!
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a aria-expanded="false" class="collapsed" data-parent="#accordion" data-toggle="collapse"
                  href="#collapse9">How to get youtube comment link?</a>
              </h4>
            </div>
            <div aria-expanded="false" class="panel-collapse collapse" id="collapse9" style="height: 0px;">
              <div class="panel-body">
                Find the timestamp that is located next to your username above your comment (for example: "3 days ago")
                and hover over it then right click and "Copy Link Address".
                The link will be something like this: <a href="https://www.youtube.com/watch?v=12345&amp;lc=a1b21etc"
                  style="background-color: rgb(255, 255, 255); font-size: 14px;">https://www.youtube.com/watch?v=12345&amp;lc=a1b21etc</a>
                instead of just <a
                  href="https://www.youtube.com/watch?v=12345">https://www.youtube.com/watch?v=12345</a>
                To be sure that you got the correct link, paste it in your browser's address bar and you will see that
                the comment is now the first one below the video and it says "Highlighted comment".
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a aria-expanded="false" class="collapsed" data-parent="#accordion" data-toggle="collapse"
                  href="#collapse10">Which youtube view service can be used with monetizable video?</a>
              </h4>
              <div aria-expanded="false" class="panel-collapse collapse" id="collapse10" style="height: 0px;">
                <div class="panel-body">
                  The one that has "Monetized" in its service' name.
                </div>
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a aria-expanded="false" class="collapsed" data-parent="#accordion" data-toggle="collapse"
                  href="#collapse11">What is "Instagram mentions", how do you use it?</a>
              </h4>
            </div>
            <div aria-expanded="false" class="panel-collapse collapse" id="collapse11" style="height: 0px;">
              <div class="panel-body">
                Instagram Mention is when you mention someone on Instagram.<br>
                Example @abcde this means you have mentioned abcde under this post and abcde will receive a notification
                to check the post.<br>
                Basically the Instagram Mentions [User Followers], you put the link to your post and the username of the
                person that you want us to mention HIS FOLLOWERS!
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a aria-expanded="false" class="collapsed" data-parent="#accordion" data-toggle="collapse"
                  href="#collapse12">What is Partial status?</a>
              </h4>
            </div>
            <div aria-expanded="false" class="panel-collapse collapse" id="collapse12" style="height: 0px;">
              <div class="panel-body">
                Partial Status is when we partially refund the remains of an order. Sometimes for some reasons, we are
                unable to deliver a full order, so we refund you the remaining undelivered amount.<br> <br>
                Example: You bought an order with quantity 10,000 and charges 10$<br> let's say we delivered 9,000 and
                the remaining 1,000 we couldn't deliver, then we will "Partial" the order and refund you the remaining
                1,000 (1$ in this example).
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a aria-expanded="false" class="collapsed" data-parent="#accordion" data-toggle="collapse"
                  href="#collapse13">I want a panel like yours / I want to resell your services how?</a>
              </h4>
            </div>
            <div aria-expanded="false" class="panel-collapse collapse" id="collapse13" style="height: 0px;">
              <div class="panel-body">
                We're working on getting a rental panel for our clients!
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a aria-expanded="false" class="collapsed" data-parent="#accordion" data-toggle="collapse"
                  href="#collapse14">What is "Instagram impressions"? </a>
              </h4>
            </div>
            <div aria-expanded="false" class="panel-collapse collapse" id="collapse14" style="height: 0px;">
              Impression means reach (also how many users have seen your post) it is mostly used with brands, they will
              ask you to show them statistic of the impressions your posts have.
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a aria-expanded="false" class="collapsed" data-parent="#accordion" data-toggle="collapse"
                  href="#collapse15">The link must be added before the user goes live or after?</a>
              </h4>
            </div>
            <div aria-expanded="false" class="panel-collapse collapse" id="collapse15" style="height: 0px;">
              <div class="panel-body">
                After he goes live, or just 5 seconds before he goes!
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a aria-expanded="false" class="collapsed" data-parent="#accordion" data-toggle="collapse"
                  href="#collapse16">What is "Instagram Saves", and what do they do?</a>
              </h4>
            </div>
            <div aria-expanded="false" class="panel-collapse collapse" id="collapse16" style="height: 0px;">
              <div class="panel-body">
                Instagram Saves is when a user saves a post to his history on Instagram (by pressing the save button
                near the like button). A lot of saves for a post increase its impression.
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a aria-expanded="false" class="collapsed" data-parent="#accordion" data-toggle="collapse"
                  href="#collapse17">How do I use mass order?</a></h4>
            </div>
            <div aria-expanded="false" class="panel-collapse collapse" id="collapse17" style="height: 0px;">
              <div class="panel-body">
                You put the package ID followed by | followed by the link followed by | followed by quantity on each
                line To get the package ID of a package please check here: </span> <a
                  href="http://opasocial.com/services">https://opasocial.com/services</a><br>
                Let’s say you want to use the Mass Order to add Instagram Followers to your 3 accounts: abcd, asdf, qwer
                From the Package List @ </span> <a href="http://opasocial.com/services"
                  style="background-color: rgb(255, 255, 255); font-family: "
                  target="_blank">https://opasocial.com/services</a> <span style="color: rgb(0, 0, 0); font-family: "
                  trebuchet="">, the service ID for this service “Instagram Followers [15K] [REAL] ” is 102<br>
                  Let’s say you want to add 1000 followers for each account, the output will be like this:<br>
                  ID|Link|Quantity<br>
                  or in this example:<br>
                  102|abcd|1000 102|asdf|1000 102|qwer|1000<br>
              </div>
            </div>
          </div>
        </div>
        <div style="text-align: center;">
          <span>For more information, you can open a ticket here: <a
              href="http://opasocial.com/support">https://opasocial.com/support</a></span>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection