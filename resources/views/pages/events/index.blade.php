@extends('layouts.app')
@php
    $title = "الفعاليات";
    if(isset($archive)){
        $title = "أرشيف الفعاليات";
    }
@endphp

@section('content')
<section class="kick-breadcromb-area rtl">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcromb-box">
                    <h2>
                        {{ $title }}
                    </h2>
                    <ul>
                        <li><a href="/"><i class="fa fa-home"></i> الرئيسية</a></li>
                        <li>/</li>
                        <li>{{ $title }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="kick-blog-page-area section_100">
    <div class="container">
        
        
        <div class="row rtl">
            @foreach ($events as $new)
            <div class="col-md-6">
                <div class="single-latest-post">
                    <a href="{{ route('event.show', $new->id) }}">
                        <img src="{{ Voyager::image($new->image) }}" alt="event image"></a>
                    <div class="single-post-text rtl">
                        <h3><a href="{{ route('event.show', $new->id) }}" class="color-primary"> {{ $new->title }} </a></h3>
                       
                        <p class="mt-1 text-justify">
                            {{ $new->excerpt }}
                        </p>
                        <div class="post-text-bottom">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="post-date mt-05">
                                        التاريخ:
                                        
                                        {{ $new->date }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="pagination-box">
                    {{ $events->links() }}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection