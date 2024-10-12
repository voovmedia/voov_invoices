@if(isset($value['last_rem_sent_at']))
    <div class="badge bg-primary">
        <div>{{ \Carbon\Carbon::parse($value['last_rem_sent_at'])->translatedFormat(currentDateFormat()) }}</div>
    </div>
@else
@if($value['status'] != 0 && $value['status'] != 2)
  <div class="badge bg-danger">
    <div>Not Send</div>
    </div>
@else
N/A  
@endif
@endif
