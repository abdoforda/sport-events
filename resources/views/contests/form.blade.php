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
    <h3 class="mb-4">إعداد الفورم الديناميكي</h3>

    <form id="form-builder">
        <div id="fields-container"></div>
        @php
    $existingForm = \App\Formss::where('contest_id', $contest_id)->first();
    $formFields = [];
    if ($existingForm && $existingForm->form_data) {
        $decoded = json_decode($existingForm->form_data, true);
        // أحيانًا البيانات تكون مغلفة داخل "formData"
        $formFields = $decoded['formData'] ?? $decoded;
    }
@endphp

<div id="fields-container">
    @if(!empty($formFields))
        @foreach($formFields as $index => $field)
            <div class="field-item mb-3 border rounded p-3 bg-light">
                <div class="mb-2">
                    <label class="form-label">اسم الحقل (Label):</label>
                    <input type="text" name="fields[{{ $index }}][label]" class="form-control"
                           value="{{ $field['label'] ?? '' }}" required>
                </div>

                <div class="mb-2">
                    <label class="form-label">الاسم الداخلي (name):</label>
                    <input type="text" name="fields[{{ $index }}][name]" class="form-control"
                           value="{{ $field['name'] ?? '' }}" required>
                </div>

                <div class="mb-2">
                    <label class="form-label">النوع:</label>
                    <select name="fields[{{ $index }}][type]" class="form-control">
                        <option value="text" {{ ($field['type'] ?? '') == 'text' ? 'selected' : '' }}>نص</option>
                        <option value="number" {{ ($field['type'] ?? '') == 'number' ? 'selected' : '' }}>رقم</option>
                        <option value="email" {{ ($field['type'] ?? '') == 'email' ? 'selected' : '' }}>إيميل</option>
                        <option value="textarea" {{ ($field['type'] ?? '') == 'textarea' ? 'selected' : '' }}>منطقة نصية</option>
                    </select>
                </div>

                <div class="mb-2 form-check">
                    <input type="checkbox" name="fields[{{ $index }}][required]" value="1"
                           class="form-check-input"
                           id="req-{{ $index }}"
                           {{ !empty($field['required']) ? 'checked' : '' }}>
                    <label for="req-{{ $index }}" class="form-check-label">مطلوب</label>
                </div>

                <button type="button" class="remove-field btn btn-danger btn-sm">🗑 حذف</button>
            </div>
        @endforeach
    @endif
</div>


        <button type="button" id="add-field" class="btn btn-primary mt-3">➕ إضافة حقل</button>
        <button type="submit" class="btn btn-success mt-3">💾 حفظ الفورم</button>
    </form>
</div>

<script>
$(document).ready(function () {
    let fieldIndex = 0;

    // زر إضافة حقل جديد
    $('#add-field').click(function () {
        let html = `
            <div class="field-item mb-3 border rounded p-3 bg-light">
                <div class="mb-2">
                    <label class="form-label">اسم الحقل (Label):</label>
                    <input type="text" name="fields[${fieldIndex}][label]" class="form-control" required>
                </div>

                <div class="mb-2">
                    <label class="form-label">الاسم الداخلي (name):</label>
                    <input type="text" name="fields[${fieldIndex}][name]" class="form-control" required>
                </div>

                <div class="mb-2">
                    <label class="form-label">النوع:</label>
                    <select name="fields[${fieldIndex}][type]" class="form-control">
                        <option value="text">نص</option>
                        <option value="number">رقم</option>
                        <option value="email">إيميل</option>
                        <option value="textarea">منطقة نصية</option>
                    </select>
                </div>

                <div class="mb-2 form-check">
                    <input type="checkbox" name="fields[${fieldIndex}][required]" value="1" class="form-check-input" id="req-${fieldIndex}">
                    <label for="req-${fieldIndex}" class="form-check-label">مطلوب</label>
                </div>

                <button type="button" class="remove-field btn btn-danger btn-sm">🗑 حذف</button>
            </div>
        `;
        $('#fields-container').append(html);
        fieldIndex++;
    });

    // حذف حقل
    $(document).on('click', '.remove-field', function () {
        $(this).closest('.field-item').remove();
    });

    // عند الضغط على حفظ
    $('#form-builder').submit(function (e) {
        e.preventDefault();
        let data = $(this).serializeArray();
        
        let formData = {};
        data.forEach(item => {
            let match = item.name.match(/fields\[(\d+)\]\[(\w+)\]/);
            if (match) {
                let index = match[1];
                let key = match[2];
                if (!formData[index]) formData[index] = {};
                formData[index][key] = item.value;
            } else {
                formData[item.name] = item.value;
            }
        });
        formData = Object.values(formData); // تحويل إلى مصفوفة بدون مفاتيح
        $.ajax({
            url: '/admin/contests/{{ $contest_id }}/form', // ضع هنا معرف المسابقة الديناميكي
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                formData: formData
            },
            success: function (response) {
                alert('تم حفظ الفورم بنجاح!');
            },
            error: function () {
                alert('حدث خطأ أثناء الحفظ.');
            }
        });
        
    });
});
</script>

</body>
</html>
