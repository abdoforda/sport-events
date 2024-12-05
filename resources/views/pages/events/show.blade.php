@extends('layouts.app')

@section('content')
    <section class="kick-breadcromb-area rtl">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcromb-box">
                        <h2>
                            {{ $event->title }}
                        </h2>
                        <ul>
                            <li><a href="/"><i class="fa fa-home"></i> الرئيسية</a></li>
                            <li>/</li>
                            <li><a href="{{ Route('event.index') }}"> الفعاليات</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="kick-blog-page-area section_100 rtl text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="single-blog-page-section">
                        <div class="single-latest-post">
                            <img src="{{ Voyager::image($event->image) }}" alt="post image">
                            <div class="single-post-text">
                                <h3>
                                    {{ $event->title }}
                                </h3>
                            </div>
                        </div>

                        <div class="content-new">
                            {!! $event->content !!}
                        </div>

                        <div id="#scroll01"></div>

                        @auth
                        @if (auth()->user()->type == 'employee')
                        @if ($event->users->contains('id', auth()->user()->id))
                        <div class="my-4">
                            <a class="kick-btn animated fadeInDown danger" onclick="registerEvent({{ $event->id }})" style="opacity: 1; cursor: pointer;">
                                <i class="fa fa-arrow-left"></i>
                                إلغاء الإشتراك
                            </a>
                        </div>
                        @else
                        <div class="my-4">
                            <a class="kick-btn animated fadeInDown" onclick="registerEvent({{ $event->id }})" style="opacity: 1; cursor: pointer;">
                                <i class="fa fa-arrow-left"></i>
                                إشترك الآن
                            </a>
                        </div>
                        @endif
                        @endif
                        @else
                        <div class="my-4">
                            <div class="alert alert-info">
                                للإشتراك في الفعالية يجب عليك <a href="/register" style="color: #2a85d7">إنشاء عضوية</a>
                            </div>
                        </div>
                        @endauth
                        
                        <div class="message01">

                        </div>

                        <div class="post-text-bottom">
                            <div class="row ">
                                <div class="col">
                                    <span class="eventCount">{{ $event->users->count() }}</span> مشترك
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('scripts')
    <script>
        function registerEvent(id){
            $(".message01").html('جاري التحميل').fadeIn();
            $.ajax({
                type: "POST",
                url: "{{ route('event.register') }}",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function (data) {
                    $(".eventCount").hide().html(data.eventCount).fadeIn();
                    $(".message01").html(data.message).fadeIn();
                },
                error: function (data) {
                    alert(data.responseJSON.message);
                    $(".message01").html(data.responseJSON.message).fadeIn();
                }
            });
        }
    </script>
@endsection