<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>تفاصيل المسابقة</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }
    .contest-img {
      max-height: 300px;
      object-fit: cover;
      border-radius: 8px;
    }
    .form-section {
      background-color: #ffffff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }
  </style>
</head>
<body>
@php
        $contest = \App\Contest::find($contest_id);
        @endphp
<div class="container py-5">
  <!-- معلومات المسابقة -->
  <div class="row mb-5">
    <div class="col-md-6">
      <img src="{{ Voyager::image($contest->image) }}" alt="صورة المسابقة" class="img-fluid contest-img w-100">
    </div>
    <div class="col-md-6 d-flex flex-column justify-content-center">
        
      <h2>{{ $contest->name }}</h2>
      <p class="lead">
        {{ $contest->desc }}
      </p>
    </div>
  </div>

  <!-- فورم التسجيل -->
  <div class="row">
    <div class="col-lg-8 mx-auto">
      <div class="form-section">
        <h4 class="mb-4">نموذج التسجيل في المسابقة</h4>
        <form  method="POST" action="{{ route('contests.form.store_user', $contest_id) }}"
        
        id="register-form" class="needs-validation" novalidate
        
        >

        @csrf
          <div class="mb-3">
    <label for="name" class="form-label">الاسم الكامل</label>
    <input type="text" class="form-control" id="name" name="name" required>
    <div class="invalid-feedback">يرجى إدخال الاسم.</div>
  </div>

  <div class="mb-3">
    <label for="employeeId" class="form-label">الرقم الوظيفي</label>
    <input type="text" class="form-control" id="employeeId" name="employeeId" required>
    <div class="invalid-feedback">يرجى إدخال الرقم الوظيفي (أرقام فقط).</div>
  </div>

  <div class="mb-3">
    <label for="jobTitle" class="form-label">المسمى الوظيفي</label>
    <input type="text" class="form-control" id="jobTitle" name="jobTitle" required>
    <div class="invalid-feedback">يرجى إدخال المسمى الوظيفي.</div>
  </div>

  <div class="mb-3">
    <label for="email" class="form-label">البريد الإلكتروني</label>
    <input type="email" class="form-control" id="email" name="email" required>
    <div class="invalid-feedback">يرجى إدخال بريد إلكتروني صحيح.</div>
  </div>

  <div class="mb-3">
    <label for="phone" class="form-label">رقم الهاتف المتحرك</label>
    <input type="tel" class="form-control" id="phone" name="phone" required>
    <div class="invalid-feedback">يرجى إدخال رقم هاتف إماراتي صحيح.</div>
  </div>


          @php
    $existingForm = \App\Formss::where('contest_id', $contest_id)->first();
    $formFields = [];
    if ($existingForm && $existingForm->form_data) {
        $decoded = json_decode($existingForm->form_data, true);
        // أحيانًا البيانات تكون مغلفة داخل "formData"
        $formFields = $decoded['formData'] ?? $decoded;
    }
@endphp

@if(!empty($formFields))
        @foreach($formFields as $index => $field)

            <div class="mb-3">
                <label for="{{ $field['name'] }}" class="form-label">{{ $field['label'] }}</label>
                @if($field['type'] == 'textarea')
                    <textarea class="form-control" id="{{ $field['name'] }}" name="{{ $field['name'] }}" {{ !empty($field['required']) ? 'required' : '' }}></textarea>
                @else
                    <input type="{{ $field['type'] }}" class="form-control" id="{{ $field['name'] }}"
                    placeholder="أدخل {{ strtolower($field['label']) }}" 
                    name="{{ $field['name'] }}" {{ !empty($field['required']) ? 'required' : '' }}>
                @endif
            </div>
        @endforeach
    @endif


          <button type="submit" class="btn btn-primary w-100">تسجيل</button>
        </form>
      </div>
    </div>
  </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    
    <script src="{{ asset('assets/js/ajax.form.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#register-form').ajaxForm({
                beforeSend: function() {
                    var isValid = true;
                    $('.form-control').removeClass('is-invalid');

                    
    // الاسم
    var name = $('#name').val().trim();
    if (name === '') {
      $('#name').addClass('is-invalid');
      isValid = false;
    }

    // الرقم الوظيفي
    var employeeId = $('#employeeId').val().trim();
    if (employeeId === '' || !/^\d+$/.test(employeeId)) {
      $('#employeeId').addClass('is-invalid');
      isValid = false;
    }

    // المسمى الوظيفي
    var jobTitle = $('#jobTitle').val().trim();
    if (jobTitle === '') {
      $('#jobTitle').addClass('is-invalid');
      isValid = false;
    }

    // البريد الإلكتروني
    var email = $('#email').val().trim();
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email === '' || !emailRegex.test(email)) {
      $('#email').addClass('is-invalid');
      isValid = false;
    }

    // رقم الهاتف الإماراتي
    var phone = $('#phone').val().trim();
    var emiratesPhoneRegex = /^05[0245689]\d{7}$/;
    if (!emiratesPhoneRegex.test(phone)) {
      $('#phone').addClass('is-invalid');
      isValid = false;
    }

    // إذا لم تكن البيانات صحيحة، منع الإرسال
    if (!isValid) {
      e.preventDefault();
    }
                    // يمكنك إضافة أي إجراءات قبل الإرسال هنا
                },
                success: function(response) {
                    alert('تم إرسال النموذج بنجاح!');
                    $('#contestForm')[0].reset(); // إعادة تعيين النموذج بعد الإرسال الناجح
                },
                error: function(xhr) {
                    alert('حدث خطأ أثناء إرسال النموذج. الرجاء المحاولة مرة أخرى.');
                }
            });
        });
    </script>
</body>
</html>
