@extends('layouts.app')

@section('content')
<section class="kick-breadcromb-area rtl">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcromb-box">
                    <h2>
                        {{ $cat->name }}
                    </h2>
                    <ul>
                        <li><a href="/"><i class="fa fa-home"></i> الرئيسية</a></li>
                        <li>/</li>
                        <li>{{ $cat->name }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="kick-blog-page-area section_100">
    <div class="container">
        
        
        <div class="row rtl">
            @foreach ($news as $new)
            <div class="col-md-6">
                <div class="single-latest-post">
                    <a href="{{ route('news.show', $new->slug) }}">
                        <img src="{{  Voyager::image($new->image) }}" alt="post image"></a>
                    <div class="single-post-text rtl">
                        <h3><a href="{{ route('news.show', $new->slug) }}" class="color-primary"> {{ $new->title }} </a></h3>
                        <p class="post-date mt-05">
                            تاريخ النشر :
                            
                            {{ $new->created_at->format('d-m-Y') }}
                        </p>
                        <p class="mt-1 text-justify">
                            {{ $new->excerpt }}
                        </p>
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
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="pagination-box">
                    {{ $news->links() }}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection