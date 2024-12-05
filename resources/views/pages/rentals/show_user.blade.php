@extends('layouts.app')

@section('content')
    <section class="kick-breadcromb-area rtl">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcromb-box">
                        <h2>معلومات الحجز</h2>
                        <ul>
                            <li><a href="/"><i class="fa fa-home"></i> الرئيسية</a></li>
                            <li>/</li>
                            <li><a href="#">حجز خاص بـ {{ $rental->user->name }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="kick-about-page-welcome section_100 rtl" style="padding-bottom: 0;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="kick-section-heading">
                        <h2> معلومات عن <span>الحجز</span></h2>
                        <div class="title-line-one"></div>
                        <div class="title-line-two"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="about-page-welcome-right">
                        <ul class="float-right">
                            <li>
                                <a href="#">
                                    <i class="fa fa-check"></i>
                                    تاريخ الحجز <span class="color-primary">{{ Carbon\Carbon::parse($rental->date_start)->format('d-m-Y') }}</span>
                                     يوم <span class="color-primary">{{ Carbon\Carbon::parse($rental->date_start)->translatedFormat('l') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-check"></i>
                                    @php
                                        // get hours between two dates
                                        $date1 = new DateTime($rental->date_start);
                                        $date2 = new DateTime($rental->date_end);
                                        $diff = $date1->diff($date2);
                                        $rental->number_of_hours = $diff->h + ($diff->days * 24);
                                    @endphp
                                      سعر الحجز <span class="color-primary">{{ ($rental->rentalType->price * $rental->number_of_hours) }} درهم</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-check"></i>
                                     ساعة الحجز <span class="color-primary">{{ tranlateTime($rental->date_start) }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-check"></i>
                                     ساعة الإنتهاء <span class="color-primary">{{ tranlateTime($rental->date_end) }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-check"></i>
                                     نوع الحجز <span class="color-primary">{{  $rental->rentalType->title }} </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-check"></i>
                                    قيمة الحجز <span class="color-primary">{{  $rental->rentalType->price }}</span> درهم للساعة الواحدة
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-check"></i>
                                    يتم احتساب المبلغ بمجرد دخول الملعب
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-check"></i>
                                    تجاوز الوقت المحدد يترتب عليه نفس القيمة السابقة
                                </a>
                            </li>
                        </ul>
                    </div>
            </div>
        </div>
    </section>
    
@endsection

