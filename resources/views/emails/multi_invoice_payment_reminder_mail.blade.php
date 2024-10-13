@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <img src="{{ asset(getLogoUrl()) }}" class="logo" alt="{{ getAppName() }}" width="200" height="50" style="max-width: 200%; height: auto;">
        @endcomponent
    @endslot

    {{-- Body --}}
    <div>
        <h2>Dear {{ $clientFullName }}, <b></b></h2><br>
        <p>I hope you are well.</p>
        <p>I hope you're well. This is a reminder about the outstanding payment of <b>${{$totalDueAmount}}</b>. Please find the invoices attached.</p>
        <br>
    </div>

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            <h6>© {{ date('Y') }} {{ getAppName() }}.</h6>
        @endcomponent
    @endslot
@endcomponent
