<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="icon" href="{{ asset('web/media/logos/favicon.ico') }}" type="image/png">
    <title>{{ __('messages.invoice.invoice_pdf') }}</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/invoice-pdf.css') }}" rel="stylesheet" type="text/css" />
    <style>
        body {
            padding: 30px 15px !important;
            margin: 0;
            font-family: Arial, sans-serif;
            /* Example: Change font family */
        }

        .container {
            width: 90%;
            margin: 0 auto;
            padding:20px;
            overflow: hidden;
            /* Clearfix */
        }

        .left-side {
            float: left;
            width: 48%;
        }

        .right-side {
            float: right;
            width: 48%;
            /* Adjust as needed */
        }

        .header {
            text-align: center;
            margin-top:-56px;
        }

        .right-side .header {
            margin-top: 110px;
        }

        .header img {
            max-width: 220px;
            height: auto;
        }

        .header h1 {
            font-size: 2.8rem;
            margin: 0;
            color: #37bfec;
            padding:0px;
            
            /* Padding for better visual appearance */
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            margin-top: 50px;
        }

        th,
        td {
            text-align: left;
            padding: 10px;
            /* Increased padding for cells */

        }

        th {
            background-color: #37bfec;
            /* Background color for table headings */
        }

        .text-align-right {
            text-align: right;
        }

        .text-align-left {
            text-align: left;
        }

        .align-container {
            display: table;
            width: 100%;
        }

        .align-left,
        .align-right {
            display: table-cell;
            vertical-align: middle;
        }

        .align-left {
            text-align: left;
        }

        .align-right {
            text-align: right;
            font-size: 1em;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="left-side">
            <div class="header">
                <img src="{{ getLogoUrl() }}" alt="Logo">
            </div>
            <div class="table-container ">
                <table>
                    <thead>
                        <tr>
                            <th>Supplier:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$client->channel_name}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Customer:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                            {{ $client->user->full_name }}
                            @if (!empty($client->user->address))
                                <br/><br/>{{ $client->user->address }}
                            @endif
                            <br/>
                            <br/>
                            <a href="tel:+{{ $client->user->region_code }}{{ $client->user->contact }}">+{{ $client->user->region_code }} {{ $client->user->contact }}</a>
                            <br/>
                            <br/>
                            {{ $client->user->email }}
                          
                            </td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="right-side">
            <div class="header">
                <h1>Billing Invoice</h1>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>INVOICE NO.</th>
                            <th class="text-align-right">DATE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#{{ $invoice->invoice_id }}</td>
                            <td class="text-align-right">{{ \Carbon\Carbon::parse($invoice->invoice_date)->translatedFormat(currentDateFormat()) }}</td>

                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th> Supplier ID </th>
                            <th class="text-align-right">PAYOUT CYCLEL</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$client->uuid}}</td>
                            <td class="text-align-right">{{ \Carbon\Carbon::parse($invoice->recurring_cycle)->translatedFormat(currentDateFormat()) }}</td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div style="clear: both;"></div> <!-- Clear floats -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th> DESCRIPTION </th>
                        <th class="text-align-right">Generated Revenue</th>
                        <th class="text-align-right">Percentage</th>
                        <th class="text-align-right">AMOUNT</th>

                    </tr>
                </thead>
                <tbody>
                    @if (isset($invoice) && !empty($invoice))
                        @foreach ($invoice->invoiceItems as $key => $invoiceItems)
                        <tr>
                        <td>{{ isset($invoiceItems->product->name) ? $invoiceItems->product->name : $invoiceItems->product_name ?? __('messages.common.n/a') }}</td>
                        <td class="text-align-right"> {{ isset($invoiceItems->price) ? getInvoiceCurrencyAmount($invoiceItems->price, $invoice->currency_id, true) : __('messages.common.n/a') }}</td>
                        <td class="text-align-right">   @foreach ($invoiceItems->invoiceItemTax as $keys => $tax)
                                            {{ $tax->tax ?? '--' }}%
                                            @if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach</td>
                        <td class="text-align-right">{{ isset($invoiceItems->price) ? getInvoiceCurrencyAmount($invoiceItems->price, $invoice->currency_id, true) : __('messages.common.n/a') }} </td>


                    </tr>
                        @endforeach
                    @endif
                   
                 
                </tbody>
            </table>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>
                            <div class="align-container">
                                <div class="align-left">
                                    <h6 style="margin: 0;">Thank you for your business</h2>
                                </div>
                                <div class="align-right">
                                    Total USD
                                </div>
                            </div>
                        </th>
                        <th class="text-align-right" style="width: 45%; background-color: #81d7f3;"> {{ isset($invoiceItems->total) ? getInvoiceCurrencyAmount($invoiceItems->total, $invoice->currency_id, true) : __('messages.common.n/a') }}</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div style="
        margin: 0 auto;
        width: 50%;
        text-align: center;
        line-height: 1.7;
        margin-top: 2rem;
    ">
                <p>If you have any Question  about this invoice please contact <b>  {{ html_entity_decode($setting['app_name']) }}</b>, <a href="tel:{{ $setting['company_phone'] }}">{{ $setting['company_phone'] }}</a> ,<b>billing@voovmedia.com</b></p>
            </div>
    </div>
</body>

</html>