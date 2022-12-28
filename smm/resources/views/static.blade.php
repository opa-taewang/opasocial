@extends('layouts.app')
@section('title', getOption('app_name') . ' - ' .  title_case(str_replace('-', ' ', $page->slug)))
@section('content')
    <div class="inner-dashboard @if( $page->slug=='faqs' ) faqPage @elseif( $page->slug=='terms-and-conditions') termsPage @endif">
        <div class="row">
            <div class="@if( $page->slug=='faqs' ) col-xs-12 @elseif( $page->slug=='terms-and-conditions') col-md-8 col-md-offset-2 @endif">
                <div class="well ">{!! $page->content !!}</div>
            </div>
        </div>
    </div>
@endsection