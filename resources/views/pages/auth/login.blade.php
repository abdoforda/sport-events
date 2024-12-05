@extends('layouts.app')


@section('content')
    <section class="kick-breadcromb-area rtl">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcromb-box">
                        <h2>
                            منطقة الدخول
                        </h2>
                        <ul>
                            <li><a href="/"><i class="fa fa-home"></i> الرئيسية</a></li>
                            <li>/</li>
                            <li>الأعضاء</li>
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
                            <h3>تسجيل الدخول</h3>

                        </div>
                        <form id="form1" method="POST">
                            @csrf
                            <div class="account-form-group">
                                <input type="email" placeholder="البريد الألكتروني" name="email">
                                <i class="fa fa-envelope-o"></i>
                            </div>
                            <div class="account-form-group">
                                <input type="password" placeholder="كلمة المرور" name="password">
                                <i class="fa fa-lock"></i>
                            </div>
                            
                            <div class="remember">
                                <label>
                                    <input name="remember" type="checkbox">
                                    <span>تذكر تسجيل الدخول علي هذا الجهاز</span>
                                </label>
                            </div>
                            <div class="submit-login">
                                <button type="submit">دحول</button>
                            </div>
                        </form>
                        <div class="login-sign-up">
                            إذهب إلي
                            <a href="{{ route('register') }}" class="color-primary">منطقة التسجيل</a>
                        </div>
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
                        window.location = '/';
                    }

                }
            });


        });
    </script>
@endsection
