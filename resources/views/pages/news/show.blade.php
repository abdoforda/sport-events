@extends('layouts.app')

@section('content')
    <section class="kick-breadcromb-area rtl">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcromb-box">
                        <h2>آخر الأخبار</h2>
                        <ul>
                            <li><a href="/"><i class="fa fa-home"></i> الرئيسية</a></li>
                            <li>/</li>
                            <li><a href="{{ Route('news.index') }}"> الأخبار</a></li>
                            <li>/</li>
                            <li>
                                {{ $new->title }}
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="kick-blog-page-area section_100">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="single-blog-page-section">
                        <div class="single-latest-post">
                            <img src="{{ Voyager::image($new->image) }}" alt="post image">
                            <div class="single-post-text">
                                <h3>
                                    {{ $new->title }}
                                </h3>
                                <p>{{ $new->excerpt }}</p>
                            </div>
                        </div>

                        <div class="content-new">
                            {!! $new->content !!}
                        </div>

                        <div class="post-text-bottom">
                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="admin-image-right">
                                        <ul class="rtl">
                                            <li>
                                                <a href="#">

                                                    {{ $new->views }}
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="admin-image">
                                        <img src="{{ asset('assets/img/logo3.png') }}" alt="admin">
                                        <a href="#">نادي النيابة العامة</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="kick-comment-list">
                            <div class="comment-group-title">
                                <h2>3 Comments</h2>
                            </div>
                            <div class="single-comment-item">
                                <div class="single-comment-box">
                                    <div class="main-comment">
                                        <div class="author-image">
                                            <img src="assets/img/author-7.jpg" alt="author">
                                        </div>
                                        <div class="comment-text">
                                            <div class="comment-info">
                                                <h4>david kamal</h4>
                                                <p>12 february 2015 At 11:30 pm</p>
                                            </div>
                                            <div class="comment-text-inner">
                                                <p>Ne erat velit invidunt his. Eum in dicta veniam interesset, harum lupta
                                                    definitionem. Vocibus suscipit prodesset vim ei, equidem perpetua eu
                                                    per.</p>
                                            </div>
                                            <a href="single-blog.html#" class="reply">Reply</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-comment-box reply-comment">
                                    <div class="main-comment">
                                        <div class="author-image">
                                            <img src="assets/img/author-8.jpg" alt="author">
                                        </div>
                                        <div class="comment-text">
                                            <div class="comment-info">
                                                <h4>Danial Martin</h4>
                                                <p>12 february 2015 At 11:30 pm</p>
                                            </div>
                                            <div class="comment-text-inner">
                                                <p>Ne erat velit invidunt his. Eum in dicta veniam interesset, harum lupta
                                                    definitionem. Vocibus suscipit prodesset vim ei, equidem perpetua eu
                                                    per.</p>
                                            </div>
                                            <a href="single-blog.html#" class="reply">Reply</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-comment-box">
                                    <div class="main-comment">
                                        <div class="author-image">
                                            <img src="assets/img/author-6.jpg" alt="author">
                                        </div>
                                        <div class="comment-text">
                                            <div class="comment-info">
                                                <h4>sumaiya mim</h4>
                                                <p>12 february 2015 At 11:30 pm</p>
                                            </div>
                                            <div class="comment-text-inner">
                                                <p>Ne erat velit invidunt his. Eum in dicta veniam interesset, harum lupta
                                                    definitionem. Vocibus suscipit prodesset vim ei, equidem perpetua eu
                                                    per.</p>
                                            </div>
                                            <a href="single-blog.html#" class="reply">Reply</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="comment-form-template">
                            <div class="comment-group-title">
                                <h2>Leave a Reply</h2>
                                <p>Your must sing-in to make or comment a post</p>
                            </div>
                            <form>
                                <input class="ns-com-name" name="name" placeholder="Name" type="text">
                                <input class="ns-com-name" name="email" placeholder="Email" type="email">
                                <textarea class="comment" placeholder="Comment..." name="comment"></textarea>
                                <button type="submit">
                                    Post comment
                                </button>
                            </form>
                        </div> --}}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-fixture-page-right margin-top">
                        <div class="single-fixture-right-widget">
                            <form>
                                <input type="search" placeholder="محرك بحث">
                                <button type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>
                        </div>
                        
                        <div class="single-fixture-right-widget">
                            <h3>
                                أهم الأخبار
                            </h3>
                            <div class="moment-slider">
                                @foreach ($bestNewsViews as $item)
                                <div class="single-moment">
                                    <a href="{{ Route('news.show', $item->slug) }}"><img src="{{ Voyager::image($item->image) }}" alt="{{ $item->title }}" /></a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="single-fixture-right-widget">
                            <h3>صور مختاره</h3>
                            @php
                    $images = \App\Image::inRandomOrder()->take(3)->get();
                    $x1 = 8;
                    $x2 = 1;
                @endphp

@foreach ($images as $allImage)
@php
    $imgs = json_decode($allImage->image);
@endphp
@foreach ($imgs as $img)
    @if ($x2 <= $x1)
    <a href="single-blog.html#">
        <img src="{{ Voyager::image($img) }}" alt="Gallery" />
    </a>
    
    @endif
    @php
        $x2++;
    @endphp
@endforeach
@endforeach

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
