@extends('layouts.app')


@section('content')
    <section class="kick-breadcromb-area rtl">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcromb-box">
                        <h2>
                            منطقة الأعضاء
                        </h2>
                        <ul>
                            <li><a href="/"><i class="fa fa-home"></i> الرئيسية</a></li>
                            <li>/</li>
                            <li>تعديل</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Login Area Start -->
    <section class="kick-login-page-area section_100">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="login-page-box rtl">
                        <div class="login-page-heading">
                            <i class="fa fa-lock"></i>
                            <h3>بيانات العضوية</h3>

                        </div>
                        <form id="form1" method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            <div class="account-form-group">
                                <input type="text" placeholder="إسم المستخدم" name="name" value="{{ auth()->user()->name }}">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="account-form-group">
                                <input type="email" placeholder="البريد الألكتروني" name="email" value="{{ auth()->user()->email }}">
                                <i class="fa fa-envelope-o"></i>
                            </div>

                            @if (auth()->user()->type == 'employee')
                            <div class="account-form-group ifEmployee">
                                <input type="text" placeholder="المسمى الوظيفي" name="job_name" value="{{ auth()->user()->job_name }}">
                                <i class="fa fa-address-card-o"></i>
                            </div>
                            <div class="account-form-group ifEmployee">
                                <input type="text" placeholder="الرقم الوظيفي" name="job_number" value="{{ auth()->user()->job_number }}">
                                <i class="fa fa-university"></i>
                            </div>
                            <div class="account-form-group ifEmployee">
                                <select name="tshirt_size">
                                    <option value="" selected disabled>قياس الملابس</option>
                                    <option value="s" @if (auth()->user()->tshirt_size == 'S') selected @endif>S</option>
                                    <option value="M" @if (auth()->user()->tshirt_size == 'M') selected @endif>M</option>
                                    <option value="L" @if (auth()->user()->tshirt_size == 'L') selected @endif>L</option>
                                    <option value="XL" @if (auth()->user()->tshirt_size == 'XL') selected @endif>XL</option>
                                    <option value="XXL" @if (auth()->user()->tshirt_size == 'XXL') selected @endif>XXL</option>
                                </select>
                                <i class="fa fa-male"></i>
                            </div>
                            @endif

                            <p style="font-size: 12px;
    text-align: right;
    color: #afafaf;">
                                أترك كلمة المرور فارغة إذا لم ترد تغيرها
                            </p>
                            <div class="account-form-group">
                                <input type="password" placeholder="كلمة المرور" name="password">
                                <i class="fa fa-lock"></i>
                            </div>
                            <div class="account-form-group">
                                <input type="password" placeholder="تأكيد كلمة المرور" name="password_confirmation">
                                <i class="fa fa-lock"></i>
                            </div>
                            <div class="submit-login">
                                <button type="submit">حفظ</button>
                            </div>

                            <div class="responseR">

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Login Area End -->
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
    $(".invalid-feedback").hide().fadeIn();
  }
  
  function find_error_name_and_display_message(form, key, value) {

    $(form).find("[name='" + key + "']").addClass("is-invalid");
    $(form).find("[name='" + key + "']").after(`<div class="invalid-feedback">${value}</div>`);

  }

        $(document).ready(function() {
            $("input[name='name']").focus();

            var forms = $("#form1");
            var oldSubmit = '';
            $(forms).ajaxForm({
                beforeSend: function() {
                    // get submit button and change its text
                    var btn = $(forms).find("button[type='submit']");
                    oldSubmit = btn.text();
                    btn.text("جاري التحميل...");
                    btn.attr("disabled", "disabled");
                    removeErrors(forms);
                },
                uploadProgress: function(event, position, total, percentComplete) {},
                complete: function(data) {

                    btn = $(forms).find("button[type='submit']");
                    btn.text(oldSubmit);
                    btn.removeAttr("disabled");

                    if (data.status == 422) {
                        errors(forms, data.responseJSON);
                    }
                    if (data.status == 200) {
                        $(".responseR").hide().html(data.responseText).fadeIn();
                        $(".updateName").hide().html($("#form1").find("input[name='name']").val()).fadeIn();
                    }

                }
            });


        });
    </script>
    <style>
        .responseR{
            padding: 20px;
        }
    </style>
@endsection
