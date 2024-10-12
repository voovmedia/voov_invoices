@php
$isDisabled = ($row->status == 2 || $row->status == 0);
@endphp
<button
    type="button"
    class="btn btn-primary addPayment btn-sm"
    title="{{ __('messages.payment.add_payment') }}"
    {{ $isDisabled ? 'disabled' : '' }}
    data-invoice-id="{{ $row->id }}">
    {{ __('messages.payment.add_payment') }}
</button>