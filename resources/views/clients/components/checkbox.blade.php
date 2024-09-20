@use('App\Models\Invoice')
<?php
if($row->status == 0 || $row->status == 2){
    return '';
}
?>
<div class="text-center">
<input type="checkbox" name="invoices[]" class="form-check-input" value="{{$row->invoice_id}}">
</div>