@extends('layouts.app')

@section('content')
    <section class="kick-breadcromb-area rtl">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcromb-box">
                        <h2>{{ $rentalType->title }}</h2>
                        <ul>
                            <li><a href="/"><i class="fa fa-home"></i> الرئيسية</a></li>
                            <li>/</li>
                            <li><a href="#">منطقة الحجز</a></li>

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
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="about-page-welcome-right">
                        <ul class="float-right">
                            <li>
                                <a href="#">
                                    <i class="fa fa-check"></i>
                                    قيمة الحجز {{  $rentalType->price }} درهم للساعة الواحدة
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
        </div>
    </section>

    <section class="kick-contact-form-area section_100 rtl">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="contact-form styleBlock">
                        <div class="kick-section-heading text-center">
                            <h2>  إحجز ملعبك الآن  </h2>
                            <div class="title-line-one m-auto"></div>
                            <div class="title-line-two m-auto mt-05"></div>
                        </div>

                        <div class="contact-heading">
                            <p>يمكنك إضافة بيانات الحجز الخاصة بك</p>
                        </div>
                        <form action="{{ route('rentals.store', $rentalType->id) }}" class="ajax-form" method="POST">
                            <div class="row">
                                <div class="col-md-4">
                                    <p>
                                        <input type="text" name="name" disabled value="{{ Auth::user()->name }}" placeholder="اسم طالب الحجز">
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <input type="email" name="email" disabled value="{{ Auth::user()->email }}" placeholder="البريد الإلكتروني">
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <input type="tel" name="phone" value="{{ Auth::user()->phone }}" placeholder="الهاتف المتحرك">
                                    </p>
                                </div>
                            </div>
                            <div class="row rtl">
                                <div class="col-md-6">
                                    <p>
                                        <input type="text" name="date_start" value="{{ Auth::user()->address }}" id="datetime" placeholder="تاريخ وساعة الحجز">
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        <select name="number_of_hours" id="">
                                            <option value="" disabled selected>عدد ساعات الحجز</option>
                                            <option value="1">1 ساعة</option>
                                            <option value="2">2 ساعات</option>
                                            <option value="3">3 ساعات</option>
                                            <option value="4">4 ساعات</option>
                                            <option value="5">5 ساعات</option>
                                            <option value="6">6 ساعات</option>
                                            <option value="7">7 ساعات</option>
                                            <option value="8">8 ساعات</option>
                                            <option value="9">9 ساعات</option>
                                            <option value="10">10 ساعات</option>
                                        </select>
                                    </p>
                                </div>
                                
                                
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="contact-form-button">
                                        <button class="kick-btn my-4" type="submit" name="submit"> حجز الآن </button>
                                    </div>
                                </div>
                            </div>
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @auth
    <section class="kick-contact-form-area rtl" style="margin-bottom: 80px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="contact-form styleBlock">
                        <div class="kick-section-heading text-center">
                            <h2> مشاهدة الحجوزات حسب التاريخ </h2>
                            <div class="title-line-one m-auto"></div>
                            <div class="title-line-two m-auto mt-05"></div>
                        </div>


                        <center>
                            <input type="date" name="date" id="datetime2">
                        </center>

                        <div class="mt-3" style="margin-top: -1px;">
                            <table class="tt01">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>تاريخ الحجز</th>
                                        <th>ساعة الحجز</th>
                                        <th>عدد ساعات الحجز</th>
                                        <th>ساعة الإنتهاء</th>
                                    </tr>
                                </thead>
                                <tbody class="resultData">
                                
                                </tbody>
                            </table>

                            
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    @endauth
    
    <style>
        .styleBlock{
            padding: 40px 20px;
    background: #ffffff;
    border-radius: 8px;
    box-shadow: rgb(100 100 111 / 28%) 0px 7px 29px 0px;
    border: 2px solid var(--primary-color);
        }

        .row.rtl .col-md-6{
            float: right;
        }

        p .invalid-feedback{
            position: relative;
    z-index: 9;
    font-size: 14px;
    left: 0;
    top: 0;
    color: #ff0000;
    background: #dddddd54;
    text-indent: 7px;
        }
        table, th, td {
  border: 1px solid; 
  direction: rtl;
    text-align: right;
    padding: 8px;
    border: 1px solid #ddd;
}

table {
  width: 100%;
}
table {
  border-collapse: collapse;
  
}

    </style>
@endsection

@section('scripts')
    <script>

        function removeErrors(form){
            $(".is-invalid").removeClass("is-invalid");
            $(".invalid-feedback").remove();
        }

        
        function errors(form, data) {
    
    obj = data.errors;
    for (var key in data.errors) {
        var value = obj[key];
        console.log(value);
        find_error_name_and_display_message(form, key, value);
    }
  }

  function find_error_name_and_display_message(form, key, value) {

$(form).find("[name='" + key + "']").addClass("is-invalid");
$(form).find("[name='" + key + "']").after(`<div class="invalid-feedback">${value}</div>`);

}


        $(document).ready(function() {

            var forms = $(".ajax-form");
            forms.each(function() {
                var oldSubmit = '';
                $(this).ajaxForm({
                    beforeSend: function() {
                        // get submit button and change its text
                        var btn = $(".ajax-form").find("button[type='submit']");
                        oldSubmit = btn.text();
                        btn.text("جاري التحميل...");
                        btn.attr("disabled", "disabled");
                        removeErrors(".ajax-form");
                    },
                    uploadProgress: function(event, position, total, percentComplete) {},
                    complete: function(data) {

                        btn = $(".ajax-form").find("button[type='submit']");
                        btn.text(oldSubmit);
                        btn.removeAttr("disabled");

                        if (data.status == 422) {
                            errors(".ajax-form", data.responseJSON);
                        }
                        if (data.status == 201) {

                            window.location = '/rental/show/' + data.responseJSON.id;
                        }
                    }
                });
            });

            $("#datetime2").change(function() {
                $(".resultData").html(`<center>جاري التحميل...</center>`);
                var date = $(this).val();
                var id = "{{ $rentalType->id }}";
                $.get("/rental/getHours/" + id ,{date},function (dd){
                    $(".resultData").hide().html(dd).fadeIn();
                });
            });

        });
    </script>

<link rel="stylesheet" href="{{ asset('assets/js/flatpickr/flatpickr.min.css') }}">
<script src="{{ asset('assets/js/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('assets/js/flatpickr/ar.js') }}"></script>
<script>
    flatpickr("#datetime", {
        "locale": "ar",
    dateFormat: "d/m/Y h:i K", // تعديل لعرض الدقائق
    enableTime: true,
    noCalendar: false,
    minuteIncrement: 1 // السماح بتحديد الدقائق
    });

    flatpickr("#datetime2", {
        "locale": "ar",
        dateFormat: "d/m/Y", // تعديل لعرض الدقائق
        enableTime: false,
        noCalendar: false,
        minuteIncrement: 1 // السماح بتحديد الدقائق
    });

</script>
@endsection