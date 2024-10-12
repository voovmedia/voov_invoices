@php 
$payoutcycle = \Carbon\Carbon::parse($value['payout_cycle_start'])->translatedFormat(currentDateFormat());
if(isset($value['payout_cycle_end'])){
    $payoutcycle = $payoutcycle.' to '.\Carbon\Carbon::parse($value['payout_cycle_end'])->translatedFormat(currentDateFormat());;
}
@endphp
    <div class="badge bg-primary">
         <div>{{$payoutcycle}}</div>
    </div>
