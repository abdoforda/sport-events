@extends('layouts.app')

@section('content')
<section class="kick-breadcromb-area rtl">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcromb-box">
                    <h2>
                        الفعاليات التي اشتركت بها
                    </h2>
                    <ul>
                        <li><a href="/"><i class="fa fa-home"></i> الرئيسية</a></li>
                        <li>/</li>
                        <li>الفعاليات</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="kick-blog-page-area section_100">
    <div class="container">
        

        
        <div class="row rtl">

            <div class="col-md-12">
                <div class="kick-section-heading text-center">
                    <h2> الفعاليات المشترك بها </h2>
                    <div class="title-line-one m-auto"></div>
                    <div class="title-line-two m-auto mt-05"></div>
                </div>
            </div>

            @if (count($events) == 0)
                {{-- alert --}}
                <div class="col-md-12">
                    <div class="alert alert-info my-4">
                        لا يوجد فعاليات مشترك بها
                    </div>
                </div>
            @endif

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
                            <div class="row text-center">
                                <div class="col-md-6">
                                    التاريخ:
                                        {{ $new->date }}
                                </div>
                                <div class="col-md-6">
                                   تم الإشتراك
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