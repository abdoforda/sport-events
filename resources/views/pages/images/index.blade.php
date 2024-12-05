@extends('layouts.app')


@section('content')
    
    
<section class="kick-breadcromb-area rtl">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcromb-box">
                    <h2>
                        مكتبة الصور
                    </h2>
                    <ul>
                        <li><a href="/"><i class="fa fa-home"></i> الرئيسية</a></li>
                        <li>/</li>
                        <li>الألبومات</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

    
    
    <!-- Gallery Masonary Page Start -->
    <section class="kick-gallery-masonary section_100">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="big-isotope-project">
                        <div class="kick-section-heading text-center">
                            <h2>  الألبومات </h2>
                            <div class="title-line-one m-auto"></div>
                            <div class="title-line-two m-auto mt-05"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="clearfix projectContainer projectContainer3column">
                                    
                                        @foreach ($albums as $album)
                                        <div class="element-item  construction">
                                        <div class="single-match-gallery">
                                            <a href="{{ Route('gallery.show', $album->id) }}" class="">
                                                 <div class="project-img">
                                                     <img src="{{ Voyager::image($album->image) }}" alt="{{ $album->title }}" />
                                                 </div>
                                             </a>
                                             <h4 class="h4style01" style="padding: 8px;">{{ $album->title }}</h4>
                                         </div>
                                        </div>
                                        @endforeach
                                    
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="pagination-box">
                        
                        {{ $albums->links() }}
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Gallery Masonary Page Start -->
    
@endsection