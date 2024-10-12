@use('App\Models\Invoice')

<div class="text-center">
@if($row->status == 0 || $row->status == 2)
    <input type="checkbox" name="invoices_ids[]" disabled class="form-check-input" value="{{$row->id}}">
@else 
    <input type="checkbox" name="invoices_ids[]" class="form-check-input" value="{{$row->id}}">
@endif

</div>