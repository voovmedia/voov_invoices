<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <title>{{ __('messages.invoice.invoice_pdf') }}</title>
</head>

<body>
    <div class="main-wrapper">
        <div class="invoice-wrapper">
            <div class="invoice-header">
                <div class="companylogo">
                    <a href="{{ route('home') }}">
                        <img src="https://invoices.voovmedia.com/assets/images/favicon.jpg" alt="Logo" class="img-logo">
                    </a>
                </div>
                <div class="invoice-header-inner heading-text">
                    <h3 class="main-heading">{{ __('messages.common.invoice') }}</h3>
                </div>
            </div>
            <div class="text-end">
                <button type="button" class="bg-blue text-white" onclick="window.print()">
                    {{ __('messages.invoice.download_invoice') }}
                </button>
            </div>

            <div class="details-section">
                <div class="row">
                    <div class="col-6 from border-top border-bottom-gray">
                        <div class="font-weight-bold">{{ __('messages.common.supplier') }}</div>
                        <p>{{ $setting['company_name'] }}</p>
                        <p>{{ $setting['company_address'] }}</p>
                        <p>{{ $setting['company_phone'] }}</p>
                    </div>
                    <div class="col-6 billedto border-top border-bottom-gray text-end">
                        <div class="font-weight-bold">{{ __('messages.invoice.invoice_id') }}: #{{ $invoice->invoice_id }}</div>
                        <div>{{ __('messages.invoice.date') }}: {{ \Carbon\Carbon::parse($invoice->invoice_date)->translatedFormat(currentDateFormat()) }}</div>
                    </div>
                </div>
            </div>

            <div class="details-section">
                <div class="row">
                    <div class="col-6 from border-top border-bottom-gray">
                        <div class="font-weight-bold">{{ __('messages.common.customer') }}</div>
                        <p>{{ $client->user->full_name }}</p>
                        <p>{{ $client->user->email }}</p>
                        <p>{{ $client->address }}</p>
                        @if (!empty($client->vat_no))
                            <p>{{ getVatNoLabel() }}: {{ $client->vat_no }}</p>
                        @endif
                    </div>
                    <div class="col-6 billedto border-top border-bottom-gray text-end">
                        <div class="font-weight-bold">{{ __('messages.invoice.supplier_id') }}: {{ $supplier->id }}</div>
                        <div>{{ __('messages.invoice.payout_cycle') }}: {{ $invoice->payout_cycle }}</div>
                    </div>
                </div>
            </div>

            <div class="details-section">
                <table class="items-table">
                    <thead>
                        <tr>
                            <th>{{ __('messages.invoice.description') }}</th>
                            <th class="text-end">{{ __('messages.invoice.generated_revenue') }}</th>
                            <th class="text-end">{{ __('messages.invoice.percentage') }}</th>
                            <th class="text-end">{{ __('messages.invoice.amount') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoice->invoiceItems as $invoiceItem)
                            <tr>
                                <td>{{ $invoiceItem->product->name ?? $invoiceItem->product_name ?? __('messages.common.n/a') }}</td>
                                <td class="text-end">{{ number_format($invoiceItem->quantity, 2) }}</td>
                                <td class="text-end">{{ $invoiceItem->price }}</td>
                                <td class="text-end">{{ $invoiceItem->total }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="invoice-footer">
                <div class="d-invoice-footer">
                    <p class="thank">{{ __('messages.invoice.thank_you') }}</p>
                    <p class="font-weight-bold">{{ __('messages.invoice.total') }} {{ $invoice->currency }}: {{ $invoice->final_amount }}</p>
                </div>
            </div>

            <div class="footer-msg">
                <div class="border-top-gray px-10 py-10">
                    <p>{{ __('messages.invoice.questions') }}</p>
                    <b>{{ $setting['app_name'] }}, {{ $setting['company_phone'] }}, {{ $setting['company_email'] }}</b>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
