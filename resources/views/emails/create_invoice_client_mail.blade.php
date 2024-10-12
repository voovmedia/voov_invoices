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
        <h2>Dear {{ $clientName }}, <b></b></h2><br>
        <p>I hope you are well.</p>
        <p>Please see attached the invoice <b>#{{$invoiceNumber}}.</b> The invoice is due by <b>placeholder</b>.</p>
        <p>Please don't hesitate to get in touch if you have any questions or need clarifications.</p>
        <p>Also you can see the attachment invoice PDF.</p><br>

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            <h6>© {{ date('Y') }} {{ getAppName() }}.</h6>
        @endcomponent
    @endslot
@endcomponent
