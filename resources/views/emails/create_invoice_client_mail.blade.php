@php
use Illuminate\Support\Facades\Crypt;
@endphp
@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <img src="{{ asset(getLogoUrl()) }}" class="logo" alt="{{ getAppName() }}" width="200" height="50" style="max-width: 200%; height: auto;">
        @endcomponent
    @endslot

    {{-- Body --}}
    <div>
        <h2>Dear {{ $clientName }}, <b></b></h2><br>
        <p>I hope you are well.</p>
        <p>Please see attached the invoice <b>#{{$invoiceNumber}}.</b> The invoice is due by <b>{{$dueDate}}</b>.</p>
        <p>Please don't hesitate to get in touch if you have any questions or need clarifications.</p>
        <p>Also you can see the attachment invoice PDF.</p><br>
        <div style="display: flex;justify-content: center">
            <a href="{{route('client.invoices.show',['invoice'=>Crypt::encrypt($id)])}}"
               style="padding: 7px 15px;text-decoration: none;font-size: 14px;background-color: #df4645;font-weight: 500;border: none;border-radius: 8px;color: white;margin-right: 5px;">
                View Invoice
            </a>
            <a href="{{route('invoice-show-url',['invoiceId'=>$invoiceId])}}"
               style="padding: 7px 15px;text-decoration: none;font-size: 14px;background-color: #df4645;font-weight: 500;border: none;border-radius: 8px;color: white; margin-left: 5px;">
                Public View
            </a>
        </div>
    </div>

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            <h6>© {{ date('Y') }} {{ getAppName() }}.</h6>
        @endcomponent
    @endslot
@endcomponent
