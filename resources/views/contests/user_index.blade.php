<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>مستعرض المسابقات</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }
    .contest-card {
      transition: transform 0.3s, box-shadow 0.3s;
    }
    .contest-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    }
    .card-img-top {
      height: 200px;
      object-fit: cover;
    }
  </style>
</head>
<body>

<div class="container py-5">
  <h2 class="text-center mb-5">مستعرض المسابقات</h2>

  <div class="row g-4">

    @php
        $contests = \App\Contest::orderBy('created_at', 'desc')->get();
    @endphp

    @foreach ($contests as $item)
        <div class="col-md-6 col-lg-4">
      <div class="card contest-card h-100">
        <img src="{{ Voyager::image($item->image) }}" class="card-img-top" alt="صورة المسابقة">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title">{{ $item->name }}</h5>
          <p class="card-text">{{ $item->desc }}</p>
          <a href="{{ route('contests.form_user', $item->id) }}" class="btn btn-primary mt-auto">اشترك الآن</a>
        </div>
      </div>
    </div>
    @endforeach

    

  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
