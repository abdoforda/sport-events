<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>منشئ الفورم الديناميكي</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body dir="rtl">

<div class="container mt-5">
    <h3 class="mb-4">
        منطقة المسابقات
    </h3>

    <table class="table">
        <thead>
            <tr>
                <td>#</td>
                <td>اسم المسابقة</td>
                <td>الوصف</td>
                <td>عدد المشتركين</td>
                <td>إعدادات</td>
            </tr>
        </thead>
        <tbody>


        @php
            $contests = \App\Contest::all();
        @endphp
        @foreach($contests as $index => $contest)
            <tr>
                <td>{{ $index }}</td>
                <td>{{ $contest->name }}</td>
                <td>{{ $contest->desc }}</td>
                <td>{{ $contest->users->count() }}</td>
                <td>
                    <a href="/admin/contests/{{ $contest->id }}/users" class="btn btn-sm btn-primary">الاعضاء المسجليين ({{ $contest->users->count() }})</a>
                    <a href="/admin/contests/{{ $contest->id }}/form" class="btn btn-sm btn-secondary">إعداد الفورم</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>



</body>
</html>
