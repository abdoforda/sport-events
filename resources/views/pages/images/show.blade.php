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
                        <li><a href="{{ Route('gallery.index') }}">الألبومات</a></li>
                        <li>/</li>
                        <li>{{ $album->title }}</li>
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
                            <h2>  صور الألبوم </h2>
                            <div class="title-line-one m-auto"></div>
                            <div class="title-line-two m-auto mt-05"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="clearfix projectContainer projectContainer3column">
                                    
                                    
                                        @foreach ($album->images as $image)
                                            @php
                                                $images = json_decode($image->image, true);
                                            @endphp
                                            @foreach ($images as $item)
                                            <div class="element-item  construction">
                                            <div class="single-match-gallery">
                                                <a href="{{ Voyager::image($item) }}" class="gallery-lightbox">
                                                     <div class="project-img">
                                                         <img src="{{ Voyager::image($item) }}" alt="{{ $image->title }}" />
                                                         <div class="single-pro-overlay">
                                                             <i class="fa fa-search-plus"></i>
                                                         </div>
                                                     </div>
                                                 </a>
                                             </div>
                                            </div>
                                            @endforeach
                                        @endforeach
                                    
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
            
        </div>
    </section>
    <!-- Gallery Masonary Page Start -->
    
@endsection