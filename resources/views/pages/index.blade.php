@extends('layouts.app')

@section('content')
    
    <!-- Slider Area Start -->
    <section class="kick-slider-area">
        <div class="kick-slide">
            
            @php
                $banners = \App\Slidshow::all();
            @endphp
            @foreach ($banners as $index => $banner)
            <div class="kick-main-slide slide-item-{{ $index+1 }}" style="    background-color: #eee;
    background-position: center center;
    background-size: cover; background-image: url('{{ Voyager::image($banner->image) }}') repeat scroll 0 0 !important;">
                <div class="kick-main-caption">
                    <div class="kick-caption-cell">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2 ar-normal">
                                    @if ($banner->title != null)
                                        <h2>{{$banner->title}}</h2>    
                                    @endif

                                    @if ($banner->desc != null)
                                    <p class="rtl">
                                        {{$banner->desc}}
                                    </p>
                                    @endif
                                    @if ($banner->url != null)
                                    <a href="{{ $banner->url }}" class="kick-btn">
                                        <i class="fa fa-arrow-left"></i>
                                        المزيد
                                        
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            
        </div>
    </section>
    <!-- Slider Area End -->
    
    
    <!-- About Area Start -->
    <section class="kick-about-area section_100 rtl">
        <div class="container">
            <div class="row rtl">
                <div class="col-md-10">
                    <div class="kick-about-right">
                        <div class="kick-section-heading">
                            <h2> <span>فعاليات</span> رياضية </h2>
                            <div class="title-line-one"></div>
                            <div class="title-line-two"></div>
                        </div>
                        <p>
                            تتميز الفعاليات الرياضية في الإمارات بتنوعها وجذبها لاهتمام المجتمع، من الفورمولا 1 في أبوظبي إلى بطولات التنس في دبي. تشمل الفعاليات الرياضية ماراثونات الجري وركوب الدراجات التي تشجع على نمط حياة صحي. تنظيمها الرائع والبنية التحتية المتقدمة تجعل الإمارات وجهة مفضلة لعشاق الرياضة عالمياً.
                        </p>
                        <div class="row">
                            @php
                                $events = \App\Event::where('status', 1)->orderBy('id', 'desc')->take(4)->get();
                            @endphp
                            @foreach ($events as $e)
                            <div class="col-md-6">
                                <div class="single-about-right">
                                    <div class="single-about-right-con">
                                        <i class="fa fa-trophy"></i>
                                    </div>
                                    <div class="single-about-right-text">
                                        <h3>{{$e->title}}</h3>
                                        <p>{{$e->desc}}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Area End -->

    
    <!-- Last Match Result Area Start -->
    <section class="kick-last-match-result section_100">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="kick-section-heading text-center">
                        <h2>  إحجز ملعبك الآن  </h2>
                        <div class="title-line-one m-auto"></div>
                        <div class="title-line-two m-auto mt-05"></div>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="last-match-box">

                    @php
                        $take = 2;
                        if (auth()->check() && auth()->user()->type == 'employee') {
                            $take = 3;
                        }
                        $rentals_type = \App\RentalType::take($take)->get();
                    @endphp

                    @foreach ($rentals_type as $index => $rt)
                    @php
                        $o = "one";
                        $imageClass = "last-match-logo";
                        if($index == 1){
                            $o = "two";
                            $imageClass = "last-match-logo-right";
                        }
                    @endphp
                    <div class="col-md-5 {{ $index == 2 ? 'center-col' : '' }} ">
                        @if ($index == 1)
                        {{-- <div class="row mobileO my-60">
                            <div class="col-md-12">
                                <div class="kick-section-heading text-center">
                                    <h2>  احجز دراجتك الهوائية الآن </h2>
                                    <div class="title-line-one m-auto"></div>
                                    <div class="title-line-two m-auto mt-05"></div>
                                </div>
                            </div>
                        </div> --}}
                        @endif
                        <div class="last-match-result-one last-match-result">
                            <div class="col-md-12">
                                <div class="result-details">
                                    <h3 class="result-details-left">
                                        <a href="{{ asset('index.html#') }}">
                                        {{$rt->title}}
                                    </a>
                                    </h3>
                                    <p class="text-center mt-1">
                                        {{$rt->title}}
                                        سعر الساعة {{$rt->price}}
                                        درهم
                                        <a
                                        name=""
                                        id=""
                                        class="btn btn-primary kick-btn d-table m-auto mt-1"
                                        href="/rental/{{ $rt->id }}"
                                        role="button"
                                        > احجز الآن </a
                                    >
                                    </p>
                                    
                                    <div class="{{$imageClass}}">
                                        <a href="{{ asset('index.html#') }}"><img loading="lazy"src="{{ asset('assets/img/logo.png') }}" alt="logo" /></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if (!$loop->last && $index < 1)
                        <div class="col-md-2">
                            <div style="height: 70px"></div>
                        </div>
                    @endif
                    @if ($index == 1)
                        <div class="col-md-12">
                            <div style="height: 70px"></div>
                        </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Last Match Result Area End -->
    
    
    
    
    <!-- Match Gallery Area Start -->
    <section class="kick-match-gallery-area section_100">
        <div class="container">
            <div class="row">
                <div class="col-md-12 rtl">
                    <div class="kick-section-heading">
                        <h2> معرض <span>الصور</span> </h2>
                        <div class="title-line-one"></div>
                        <div class="title-line-two"></div>
                    </div>
                </div>
            </div>
            <div class="row">

                @php
                    $images = \App\Image::inRandomOrder()->take(3)->get();
                    $x1 = 6;
                    $x2 = 1;
                @endphp

                @foreach ($images as $allImage)
                @php
                    $imgs = json_decode($allImage->image);
                @endphp
                @foreach ($imgs as $img)
                    @if ($x2 <= $x1)
                    <div class="col-sm-4">
                        <div class="single-match-gallery">
                           <a href="{{ Voyager::image($img) }}" class="gallery-lightbox">
                                <div class="project-img">
                                    <img loading="lazy"src="{{ Voyager::image($img) }}" alt="single project" />
                                    <div class="single-pro-overlay">
                                        <i class="fa fa-search-plus"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endif
                    @php
                        $x2++;
                    @endphp
                @endforeach
                @endforeach
                
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="load-more">
                        <a href="/gallery" class="kick-btn hover-black">
                            المزيد
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Match Gallery Area End -->
    
    
    
    <!-- Latest Post Area Start -->
    <section class="kick-latest-post-area section_100">
        <div class="container">
            <div class="row">
                <div class="col-md-12 rtl">
                    <div class="kick-section-heading">
                        <h2> آخر <span>الأخبار</span></h2>
                        <div class="title-line-one"></div>
                        <div class="title-line-two"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                
                @php
                    $news = \App\News::take(2)->latest()->get();
                @endphp

                @foreach ($news as $n)
                <div class="col-md-6">
                    <div class="single-latest-post">
                        <a href="{{ route('news.show', $n->slug) }}"><img loading="lazy"src="{{ Voyager::image($n->image) }}" alt="post image" /></a>
                        <div class="single-post-text rtl">
                            <h3><a href="{{ route('news.show', $n->slug) }}" class="color-primary">{{$n->title}}</a></h3>
                            <p class="post-date mt-05">
                                تاريخ النشر:  {{ $n->created_at->format('d-m-Y') }}
                            </p>
                            <p class="mt-1 text-justify">
                                {{$n->excerpt}}
                            </p>
                            <div class="post-text-bottom">
                                <div class="row">
                                    
                                    <div class="col-sm-6">
                                        <div class="admin-image-right">
                                            <ul class="rtl">
                                                <li>
                                                    <a href="{{ route('news.show', $n->slug) }}">
                                                        
                                                    {{ $n->views }}
                                                    <i class="fa fa-eye"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('news.show', $n->slug) }}">
                                                        
                                                    489
                                                    <i class="fa fa-heart-o"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="admin-image">
                                            <img loading="lazy"src="{{ asset('assets/img/logo3.png') }}" alt="admin" />
                                            <a href="{{ route('news.show', $n->slug) }}">نادي النيابة العامة</a>
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
                    <div class="load-more">
                        <a href="/news" class="kick-btn hover-black">
                            المزيد
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Post Area End -->
    
    
    <!-- About Area Start -->
    <section class="kick-about-area section_100 rtl">
        <div class="container">
            <div class="row rtl">
                <div class="col-md-12">
                    <div class="kick-about-right">
                        <div class="kick-section-heading">
                            <h2> <span>القواعد</span>  </h2>
                            <div class="title-line-one"></div>
                            <div class="title-line-two"></div>
                        </div>
                        <p>
                            قواعد الملعب للنادي تهدف إلى ضمان سلامة اللاعبين والمشاهدين وضمان تجربة ممتعة وآمنة للجميع. 
                            <br>
                            إليك بعض النقاط الأساسية التي قد تتضمنها قواعد الملعب للنادي
                        </p>
                        

                        <div class="qua3ed">
                            
                        <div>
                            <h4>الدخول والخروج</h4>
                            <p>يجب على المشجعين دخول الملعب عبر البوابات المحددة وعرض التذاكر الخاصة بهم عند الدخول.
                                </p>
                                <p>
                                    يمنع دخول الأفراد بدون تذاكر سارية.
                                </p>
                        </div>
                        <div>
                            <h4>السلوك</h4>
                            <p>يجب على جميع المشجعين التصرف بطريقة محترمة تجاه الآخرين، بما في ذلك اللاعبين والحكام والجماهير الأخرى.
                          </p>
                          <p>
                            يمنع التصرف العدواني أو العنيف أو استخدام الألفاظ النابية.
                          </p>
                        </div>
                        <div>
                            <h4>الأمان والسلامة</h4>
                            <p>يجب على الجميع الالتزام بتعليمات السلامة الصادرة عن الموظفين أو من خلال الإعلانات داخل الملعب.
                               
                                </p>
                                <p>
                                    يمنع إلقاء الأشياء أو النفايات داخل الملعب أو على أرضية الملعب.
                                </p>
                        </div>
                        <div>
                            <h4>استخدام الكاميرات والأجهزة الإلكترونية</h4>
                            <p>يسمح باستخدام الكاميرات الشخصية لأغراض غير تجارية.
                                </p>
                                <p>
                                    يمنع التصوير التجاري أو البث المباشر بدون تصريح.
                                </p>
                        </div>
                        <div>
                            <h4>مناطق الجلوس</h4>
                            <p>يجب على المشجعين الجلوس في المقاعد المخصصة لهم وعدم الانتقال إلى مناطق جلوس أخرى بدون إذن.
                            </p>
                        </div>
                        <div>
                            <h4>الاستجابة للحالات الطارئة</h4>
                            <p>يجب على الجميع اتباع تعليمات الطوارئ وإخلاء الملعب بسرعة وهدوء إذا لزم الأمر.
                               </p>
                               <p>
                                الالتزام بهذه القواعد يساهم في خلق بيئة رياضية ممتعة وآمنة للجميع.
                               </p>
                        </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Area End -->
    
@endsection