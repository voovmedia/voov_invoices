@if(isset($value['invoice-date']))
    <div class="badge bg-primary">
        <div>{{ \Carbon\Carbon::parse($value['invoice-date'])->translatedFormat(currentDateFormat()) }}</div>
    </div>
@endif
