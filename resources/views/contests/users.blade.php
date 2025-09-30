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
        $contest = \App\Contest::find($id);
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
    <div class="col-lg-12 mx-auto">
        <table class="table">
        <thead>
            <tr>
                <td>#</td>
                <td>الإسم</td>
                <td>الرقم الوظيفي</td>
                <td>المسمى الوظيفي</td>
                <td>الإيميل</td>
                <td>الهاتف</td>
                <td>بيانات إضافية</td>
                <td>تاريخ التسجيل</td>
            </tr>
        </thead>
        <tbody>


            
        @foreach($Contestsuser as $index => $contest)
            <tr>
                <td>{{ $index }}</td>
                <td>{{ $contest->name }}</td>
                <td>{{ $contest->employeeId }}</td>
                <td>{{ $contest->jobTitle }}</td>
                <td>{{ $contest->email }}</td>
                <td>{{ $contest->phone }}</td>
                <td>
                    @php
                        $additionalData = json_decode($contest->form_data, true);
                    @endphp
                    @if(is_array($additionalData))
                        <ul class="list-unstyled mb-0">
                            @foreach($additionalData as $key => $value)
                                <li><strong>{{ $key }}:</strong> {{ $value }}</li>
                            @endforeach
                        </ul>
                    @else
                        لا توجد بيانات إضافية
                    @endif
                </td>
                <td>{{ $contest->created_at->format('d-m-Y h:i A') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
  </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
