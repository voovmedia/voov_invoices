<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="icon" href="{{ asset('web/media/logos/favicon.ico') }}" type="image/png">
    <title>{{ __('messages.invoice.invoice_pdf') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/invoice-pdf.css') }}" rel="stylesheet" type="text/css" />
    <style>
        * {
            font-family: DejaVu Sans, Arial, "Helvetica", Arial, "Liberation Sans", sans-serif;
        }

        @page {
            margin-top: 40px !important;
            margin-bottom: 40px !important;
        }

        @if (getInvoiceCurrencyIcon($invoice->currency_id) == '€')
            .euroCurrency {
                font-family: Arial, "Helvetica", Arial, "Liberation Sans", sans-serif;
            }
        @endif
    </style>
</head>

<body>
    <div class="main-wrapper">
        <div class="invoice-wrapper">
            <div class="invoice-header">
                <a href="{{ route('home') }}">
                    <img src="https://invoices.voovmedia.com/assets/images/favicon.jpg" alt="Logo" width="100px">
                </a>
                <div class="text-blue">
                    {{ __('messages.common.invoice') }}
                </div>
            </div>
            <div class="download-invoice">
                <button type="button" class="bg-blue text-white" onclick="window.print()">
                    {{ __('messages.invoice.download_invoice') }}
                </button>
            </div>

            <div class="invoice-detail">
                <div class="left-box">
                    <div class="left-box-head">
                        {{ __('messages.common.supplier') }}
                    </div>
                    <div>{{ $supplier->name }}</div>
                    <div>{{ $supplier->address }}</div>
                    <div>{{ $supplier->contact }}</div>
                </div>
                <div class="right-box">
                    <div class="right-box-head">
                        <p>{{ __('messages.invoice.invoice_id') }}</p>
                        <p>{{ __('messages.invoice.date') }}</p>
                    </div>
                    <div>#{{ $invoice->invoice_id }}</div>
                    <div>{{ \Carbon\Carbon::parse($invoice->invoice_date)->translatedFormat(currentDateFormat()) }}</div>
                </div>
            </div>
            <div class="invoice-detail">
                <div class="left-box">
                    <div class="left-box-head">
                        {{ __('messages.common.customer') }}
                    </div>
                    <div>{{ $client->user->full_name }}</div>
                    <div>{{ $client->user->email }}</div>
                    <div>{{ $client->address }}</div>
                    @if (!empty($client->vat_no))
                        <div>{{ getVatNoLabel() }}: {{ $client->vat_no }}</div>
                    @endif
                </div>
                <div class="right-box">
                    <div class="right-box-head">
                        <p>{{ __('messages.invoice.supplier_id') }}</p>
                        <p>{{ __('messages.invoice.payout_cycle') }}</p>
                    </div>
                    <div>{{ $supplier->id }}</div>
                    <div>{{ $invoice->payout_cycle }}</div>
                </div>
            </div>

            <div class="invoice-description-cont">
                <div class="invoice-description-head">
                    <div class="left-desc">
                        {{ __('messages.invoice.description') }}
                    </div>
                    <div class="right-desc">
                        <div>{{ __('messages.invoice.generated_revenue') }}</div>
                        <div>{{ __('messages.invoice.percentage') }}</div>
                        <div>{{ __('messages.invoice.amount') }}</div>
                    </div>
                </div>
                <div class="invoice-description-content">
                    <div class="left-content">
                        {{ __('messages.invoice.revenue_generated') }}
                    </div>
                    <div class="right-content">
                        <div>{{ $invoice->generated_revenue }}</div>
                        <div>{{ $invoice->percentage }}%</div>
                        <div>{{ $invoice->amount }}</div>
                    </div>
                </div>
            </div>

            <div class="regard-box">
                <div class="left-regard-box">
                    <p><i>{{ __('messages.invoice.thank_you') }}</i></p>
                    <p><i>{{ __('messages.invoice.total') }} {{ $invoice->currency }}</i></p>
                </div>
                <div class="right-regard-box">{{ $invoice->amount }}</div>
            </div>

            <div class="footer-msg">
                <div>
                    {{ __('messages.invoice.questions') }}
                    <br>
                    <b>{{ $company->name }}, {{ $company->phone }}, {{ $company->email }}</b>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
