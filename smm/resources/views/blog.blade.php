@extends('layouts.app')
@section('title', getOption('app_name') . ' - Posts ')
@section('content')
<style>
    .blog-header h1 {
    font-size: 32px;
    text-transform: uppercase;
    font-weight: 800;
    margin-top: 0;
    color: #fff;
}
</style>
<link rel="stylesheet" href="/custom_main/19/css/font-awesome.min.css" />
<seciton class="blog-header">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h1>Knowledge Base</h1>
                <p>Welcome to the Opasocial Knowledge Base!</p>
            </div>
            <div class="col-sm-8">
                <img src="/images/blog-banner-21.png">
            </div>
        </div>
    </div>
</seciton>

<section class="blog-main">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                @foreach($posts as $post)
                <div class="post-wrap">
                    <div class="post-image-box">
                        <img src="{{ ($post->image)?url('blog/images/'.$post->image):'http://placehold.it/750x420' }}" class="post-img">
                        <span class="post-cate">Social Media</span>
                    </div>
                    <div class="post-lower">
                        <h4 class="post-title"><a href="{{ url('kb/'.$post->slug) }}">{{ str_limit($post->title, 100) }}</a></h4>
                        <ul class="post-meta">
							<li><span class="icon fa fa-clock-o"></span>{{ $post->created_at->diffforhumans() }}</li>
						<!--	<li><span class="icon fa fa-comment-o"></span>3</li> -->
							<li><span class="icon fa fa-eye"></span>{{ $post->views}}</li>
						</ul>
						<div class="post-text">{{ str_limit($post->short_description, 350) }}</div>
						<a href="{{ url('kb/'.$post->slug) }}" class="read-more">Read More </a>
                    </div>
                </div>
                <hr/>
                <div class='ad-block'>
                    @if(!empty($ad_top2) && $ad_top2->status=="Enabled")
                        @if(!empty($ad_top2->image))
                        <a target="_bank" href="{{$ad_top2->link}}"><img src="{{ url('ads/images/'.$ad_top2->image) }}"/></a>
                        @else
                        <a target="_bank" href="{{$ad_top2->link}}">{!! $ad_top2->code !!}</a>
                        @endif
                    @endif
                </div>
                <hr/>
                @endforeach
                <div class="clearfix"></div>
                <nav class="breadcrumbs">{{ $posts->render() }}</nav>
            </div>
            <div class="col-sm-4">
       <!--         <div class="sidebar-widget sidebar-social-widget">
					<div class="sidebar-title">
						<h2>Follow Us</h2>
					</div>
					<ul class="social-icon-one alternate">
						<li><a href="#"><span class="fa fa-facebook"></span></a></li>
						<li class="twitter"><a href="#"><span class="fa fa-twitter"></span></a></li>
						<li class="g_plus"><a href="#"><span class="fa fa-google-plus"></span></a></li>
						<li class="linkedin"><a href="#"><span class="fa fa-linkedin-square"></span></a></li>
						<li class="pinteret"><a href="#"><span class="fa fa-pinterest-p"></span></a></li>
						<li class="android"><a href="#"><span class="fa fa-android"></span></a></li>
						<li class="instagram"><a href="#"><span class="fa fa-instagram"></span></a></li>
						<li class="vimeo"><a href="#"><span class="fa fa-vimeo"></span></a></li>
					</ul>
				</div>
				<div class="sidebar-widget sidebar-adds-widget">
				    <div class="ad-title">Advertisement</div>
				    @if(!empty($ad_right_sidebar) && $ad_right_sidebar->status=="Enabled")
                    @if(!empty($ad_right_sidebar->image))
                    <a href="{{$ad_right_sidebar->link}}" target="_bank"><img src="{{ url('ads/images/'.$ad_right_sidebar->image) }}" style="width: 100%;"/></a>
                    @else
                    <a href="{{$ad_right_sidebar->link}}" target="_bank">{!! $ad_right_sidebar->code !!}</a>
                    @endif
                    @endif
				</div> -->
				<div class="sidebar-widget sidebar-recent-widget">
				    <div class="sidebar-title">
						<h2>Featured Posts</h2>
					</div>
				    @foreach($latestposts as $key => $post)
				    <article class="widget-post">
						<figure class="post-thumb"><a href="{{ url('kb/'.$post->slug) }}"><img src="{{ ($post->image)?url('blog/images/'.$post->image):'http://placehold.it/750x420' }}" alt=""></a></figure>
						<div class="text"><a href="{{ url('kb/'.$post->slug) }}">{{ str_limit($post->title, 50) }}</a></div>
						<div class="post-info">{{ $post->created_at->diffforhumans() }}</div>
					</article>
					@endforeach
			    </div>
			    @if(Session::has('alert'))
                <div class="row">
                    <div class="col-md-12">
                        <div style="margin-top: -15px;" class="alert alert-{{ Session::get('alertClass') }}">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ Session::get('alert') }}
                        </div>
                    </div>
                </div>
                @endif
			    <div class="sidebar-widget sidebar-newsletter-widget">
			        <div class="sidebar-title">
						<h2>Join our Newsletter</h2>
						
					</div>
					<div class="newsletter-icon"><i class="fas fa-mail-bulk"></i></div>
					<p class="text-center">Social Media Marketing tips, <br>latest news, and more.</p>   
					<form action="{{url('newsletter')}}" method="post" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input type="email" name="email" required class="form-control" id="inputEmail3" placeholder="Email">
                            @if ($errors->has('email'))
                            <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Join Us</button>
                    </form>
				</div>
			</div>
        </div>
    </div>
</section> 

@endsection
@push('scripts')
    
@endpush
