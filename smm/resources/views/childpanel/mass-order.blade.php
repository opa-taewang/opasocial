@extends('layouts.app')
@section('title', getOption('app_name') . ' - Mass Order')
@section('content')

<div class="inner-dashboard neworderPage">
    <div class="row">
        <div class="col-sm-6">
            <div class="well neworderStats tab">
                <ul id="myTabs" class=" centerTabs nav nav-pills" role="tablist" data-tabs="tabs">
                  <li><a href="{{ url('/order/new') }}"><i class="material-icons">add_circle_outline</i> @lang('menus.new_order')</a></li>
                  <li class="active"><a href="#mass-order" data-toggle="tab"><i class="material-icons">queue</i> @lang('menus.mass_order')</a></li>
                </ul>
                <div class="tab-content">
                    <div id="massOrder" class="tab-pane fade in active" role="tabpanel">
                        <form role="form" method="POST" action="{{ url('/order/mass-order') }}">
                            {{ csrf_field() }}
                            <fieldset class="scheduler-border">
                                <div class="form-group">
                                    <h6 style="margin: 0">@lang('forms.mass_order')</h6>
                                    <p class="label label-default">@lang('forms.each_order_on_new_line')</p>
                                </div>
                                <div class="form-group">
                                    <span class="label label-success">@lang('forms.mass_order_format')</span>
                                    <textarea rows="15" name="content" id="content" data-validation="required" style=" resize: vertical;" class="form-control">{{ old('content') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">@lang('buttons.place_order')</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="well">
                <ul id="myTabs" class="centerTabs nav nav-pills" role="tablist" data-tabs="tabs">
                  <li class="active"><a href="#latestNews" data-toggle="tab" aria-expanded="true"><i class="material-icons">rss_feed</i> Latest News</a></li>
                  <li class=""><a href="#contactUs" data-toggle="tab" aria-expanded="false"><i class="material-icons">mail</i> Get in Touch</a></li>
                  <li class=""><a href="#videoTut" data-toggle="tab" aria-expanded="false"><i class="material-icons">play_circle_filled</i> Video Tutorial</a></li>
                </ul>
                <div class="tab-content">
                    <div id="latestNews" class="tab-pane fade active in" role="tabpanel">
                        <div class="timeLineWrapper">
                            {!!  getPageContent('new-order') !!}
                        </div>
                    </div>
                    <div id="contactUs" class="tab-pane fade" role="tabpanel">
                        <div class="contactInfo">
                            <p>Need help? We are always ready to help you in any of your needs! Choose the best way to get in touch and we'll contact you ASAP!</p>
                        </div>
                        <h2>Support Ticket <span>(easiest &amp; fastest)</span></h2>
                        <a class="openTicket" href="/tickets">Open New Ticket</a>
                        <div class="media">
                            <div class="media-left">
                              <a href="#" style="color:#00aff1;">
                                <i class="fa fa-skype"></i>
                              </a>
                            </div>
                            <div class="media-body">
                              <h4 class="media-heading">Skype</h4>
                              <p>example123</p>
                            </div>
                          </div>
                        <div class="media">
                            <div class="media-left">
                              <a href="#" style="color:#5ee78d;">
                                <i class="fa fa-envelope"></i>
                              </a>
                            </div>
                            <div class="media-body">
                              <h4 class="media-heading">Email</h4>
                              <p>example@abcd.net</p>
                            </div>
                        </div>
                    </div>
                    <div id="videoTut" class="tab-pane fade" role="tabpanel">
                        <div id="accordionOne" class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a data-toggle="collapse" data-parent="#accordionOne" href="#collapse1" aria-expanded="false" class="faq_question collapsed" style="color: #00a7fb;">Video Tutorial One</a>
                                    </h4>
                                </div>
                                <div id="collapse1" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body">
                                      <div style="font-size: 13.3333px;">
                                        <div class="faq_answer">
                                          <iframe src="https://player.vimeo.com/video/64654583" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" width="100%" height="345" frameborder="0"></iframe>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a data-toggle="collapse" data-parent="#accordionTwo" href="#collapse2" aria-expanded="false" class="faq_question collapsed" style="color: #00a7fb;">Video Tutorial One</a>
                                    </h4>
                                </div>
                                <div id="collapse2" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body">
                                      <div style="font-size: 13.3333px;">
                                        <div class="faq_answer">
                                          <iframe src="https://player.vimeo.com/video/64654583" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" width="100%" height="345" frameborder="0"></iframe>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a data-toggle="collapse" data-parent="#accordionThree" href="#collapse3" aria-expanded="false" class="faq_question collapsed" style="color: #00a7fb;">Video Tutorial One</a>
                                    </h4>
                                </div>
                                <div id="collapse3" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body">
                                      <div style="font-size: 13.3333px;">
                                        <div class="faq_answer">
                                          <iframe src="https://player.vimeo.com/video/64654583" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" width="100%" height="345" frameborder="0"></iframe>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection