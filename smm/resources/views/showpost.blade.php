@extends('layouts.app')
@section('title', $post->title . ' - ' .  getOption('app_name'))
@section('content')
<link rel="stylesheet" href="/custom_main/19/css/font-awesome.min.css" />
<meta name="keywords" content="{{$post->meta_tags}}">
<seciton class="blog-header post-header">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h1>{{$post->title}}</h1>
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
                <div class="post-single-img-wrap">
                    <img src="{{ ($post->image)?url('blog/images/'.$post->image):'http://placehold.it/750x420' }}" alt="" class="post-single-img" />
                </div>
                <div class="post-date">{{ $post->created_at->diffforhumans() }}</div>
                <div class="post-content">
                    <h2 class="entry-title">{{$post->title}}</h2>
                    <div class="post-meta">
                        <span class="meta-author"><i class="far fa-user"></i> By Admin</span>
                        <span class="meta-cats"><i class="far fa-folder"></i> Social Media</span>
                        <span class="meta-comments"><i class="far fa-eye"></i> {{ $post->views}} Views</span>
                    </div>
                    <div class="entry-content">
                        {!! $post->description !!}
                    </div>
                    
                </div>
                <div class="back-link text-center">
                    <a href="{{ url()->previous() }}"><i class="fas fa-chevron-circle-left"></i> Back</a>
                </div>
            </div>
            <div class="col-sm-4">
           <!--     <div class="sidebar-widget sidebar-social-widget">
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
				<!-- <div class="ad-title">Advertisement</div> -->
				    @if(!empty($ad_right_sidebar) && $ad_right_sidebar->status=="Enabled")
                    @if(!empty($ad_right_sidebar->image))
                    <a href="{{$ad_right_sidebar->link}}" target="_bank"><img src="{{ url('ads/images/'.$ad_right_sidebar->image) }}" style="width: 100%;"/></a>
                    @else
                    <a href="{{$ad_right_sidebar->link}}" target="_bank">{!! $ad_right_sidebar->code !!}</a>
                    @endif
                    @endif
			<!--	</div> -->
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
