@extends('layouts.app')
@section('title')
    {{ __('messages.quote.new_quote') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between mb-5">
            <h1 class="mb-0">@yield('title')</h1>
            <a class="btn btn-outline-primary float-end"
               href="{{ url()->previous() }}">{{ __('messages.common.back') }}</a>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="row">
                <div class="col-12">
                    @include('layouts.errors')
                    <div class="alert alert-danger display-none hide" id="validationErrorsBox"></div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['route' => 'client.quotes.store', 'id' => 'clientQuoteForm', 'name' => 'quoteForm']) }}
                    @include('client_panel.quotes.fields')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    @include('quotes.templates.templates')
    {{ Form::hidden('clients',json_encode($clients, true),['id' => 'clients']) }}
    {{ Form::hidden('products',json_encode($associateProducts, true),['id' => 'products']) }}
    {{ Form::hidden('quote_note',isset($quote->note) ,['id' => 'quoteNote']) }}
    {{ Form::hidden('quote_term',isset($quote->term) ,['id' => 'quoteTerm']) }}
    {{ Form::hidden('quote_recurring',isset($quote->recurring) ,['id' => 'quoteRecurring']) }}
    {{ Form::hidden('thousand_separator',getSettingValue('thousand_separator') ,['id' => 'thousandSeparator']) }}
    {{ Form::hidden('decimal_separator',isset($quote->recurring) ,['id' => 'decimalSeparator']) }}

@endsection
