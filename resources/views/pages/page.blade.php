@extends('layouts.app')


@section('content')
    <section class="kick-breadcromb-area rtl">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcromb-box">
                        <h2>
                            {{ $page->title }}
                        </h2>
                        <ul>
                            <li><a href="/"><i class="fa fa-home"></i> الرئيسية</a></li>
                            <li>/</li>
                            <li>{{ $page->title }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <!-- About Page Something Start -->
    <section class="kick-about-page-something section_100 rtl">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="kick-section-heading">
                        <h2>
                            {{ $page->title }}
                        </h2>
                        <div class="title-line-one"></div>
                        <div class="title-line-two"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="something-text">
                        {!! $page->content !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Page Something End -->


    @endsection