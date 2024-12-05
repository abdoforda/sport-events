@extends('layouts.app')

@section('content')
<section class="kick-breadcromb-area rtl">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcromb-box">
                    <h2>
                        الحجوزات الخاصة بك
                    </h2>
                    <ul>
                        <li><a href="/"><i class="fa fa-home"></i> الرئيسية</a></li>
                        <li>/</li>
                        <li>الحجوزات</li>
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
                    <h2>الحجوزات</h2>
                    <div class="title-line-one m-auto"></div>
                    <div class="title-line-two m-auto mt-05"></div>
                </div>
            </div>

            @if (count($rentals) == 0)
                {{-- alert --}}
                <div class="col-md-12">
                    <div class="alert alert-info my-4">
                        لا يوجد حجوزات تم حجزها من قبل 
                    </div>
                </div>
            @endif

            <div class="my-4" style="margin-top: 100px; overflow-x: auto;">
                <table class="table" style="direction: rtl;
    text-align: right;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>النوع</th>
                        <th>تاريخ الحجز</th>
                        <th>ساعة الحجز</th>
                        <th>ساعة الإنتهاء</th>
                        <th>المبلغ</th>
                        <th>عرض</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rentals as $r)
                    <tr>
                        <td>{{ $r->id }}</td>
                        <td>{{ $r->rentalType->title }}</td>
                        <td>{{ Carbon\Carbon::parse($r->date_start)->format('Y-m-d') }} <span class="sp001">{{ Carbon\Carbon::parse($r->date_start)->translatedFormat('l') }}</span></td>
                        <td>{{ tranlateTime($r->date_start) }}</td>
                        <td>{{ tranlateTime($r->date_end) }}</td>
                        <td>{{ $r->rentalType->price }} درهم</td>
                        <td><a class="bt001" href="rental/show/{{ $r->id }}">عرض</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            
        </div>
    </div>
</section>
<style>
    .bt001{
        background: var(--primary-color) none repeat scroll 0 0;
    padding: 4px 7px;
    border-radius: 4px;
    font-size: 12px;
    color: #fff;
    }
    table, th, td {
  border: 1px solid;
  white-space: nowrap;
}
    .table td, .table th {
        border: 1px solid #dee2e6;
        border-collapse: collapse;
    }
    .table > thead > tr > th{
        border: 1px solid #dee2e6;
        text-align: right;
    }
    .sp001{
        font-size: 10px;
    background: var(--primary-color);
    color: #fff;
    padding: 2px 8px;
    border-radius: 50px;
    }
</style>
@endsection