<div class="row">
    <div class="col-lg-3 col-sm-12">
        @if ($invoice->status == \App\Models\Invoice::DRAFT)
        {{ Form::label('client_id', __('messages.invoice.client') . ':', ['class' => 'form-label required fs-6 mb-3']) }}
        {{ Form::select('client_id', $clients, $client_id ?? null, ['class' => 'form-select io-select2', 'id' => 'client_id', 'placeholder' => __('messages.invoice.client'), 'required', 'data-control' => 'select2']) }}
        @else
        {{ Form::label('client_id', __('messages.invoice.client') . ':', ['class' => 'form-label mb-3']) }}
        <br>
        <span class="text-muted h3">{{ $invoice->client->user->full_name }}</span>
        <input type="hidden" value="{{ $invoice->client->user_id }}" name="client_id">
        @endif
    </div>
    <div class="col-lg-3 col-sm-12 mt-3 mt-lg-1 mb-lg-0 mb-3">
        <h4 class="align-items-center">{{ __('messages.invoice.invoice') }} # <span class="text-gray-500">{{ $invoice->invoice_id }}</span></h4>
        <input type="hidden" id="invoiceId" value="{{ $invoice->invoice_id }}" name="invoice_id" />
    </div>
    <div class="col-lg-6 col-sm-12">
        <div class="mb-5">
            {{ Form::label('status', __('messages.common.status') . ':', ['class' => 'form-label required mb-3']) }}
            {{ Form::select('status', $statusArr, isset($invoice) ? $invoice->status : null, ['class' => 'form-select', 'id' => 'status', 'required', 'data-control' => 'select2']) }}
        </div>
    </div>
</div>
<div class="row mb-2">
    <div class="mb-5 col-lg-3 col-sm-12">
        {{ Form::label('invoice_date', __('messages.invoice.invoice_date') . ':', ['class' => 'form-label required mb-3']) }}
        {{ Form::text('invoice_date', null, ['class' => 'form-select', 'id' => 'editInvoiceDate', 'autocomplete' => 'off', 'required']) }}
    </div>
    <div class="mb-5 col-lg-3 col-sm-12">
        {{ Form::label('due_date', __('Due Date') . ':', ['class' => 'form-label required mb-3']) }}
        {{ Form::text('due_date', $invoice->due_date, ['class' => 'form-select', 'id' => 'editDueDate', 'autocomplete' => 'off', 'required']) }}
    </div>
    <div class="mb-5 col-lg-3 col-sm-12">
        {{ Form::label('payout_cycle', __('Payout cycle') . ':', ['class' => 'form-label required mb-3']) }}
        {!! Form::text('payout_cycle', null, ['class' => 'form-select', 'id' => 'payout_cycle', 'autocomplete' => 'off', 'required']) !!}
    </div>

    <div class="mb-5 col-lg-3 col-sm-12">
        {{ Form::label('templateId', __('messages.setting.invoice_template') . ':', ['class' => 'form-label mb-3']) }}
        {{ Form::select('template_id', $template, isset($invoice) ? $invoice->template_id : null, ['class' => 'form-select', 'id' => 'templateId', 'required', 'data-control' => 'select2']) }}
    </div>


    <div class="mb-5 col-lg-3 col-sm-12">
        {{ Form::label('currencyType', __('messages.setting.currencies') . ':', ['class' => 'form-label mb-3']) }}
        <select id="currencyType" class="form-select invoice-currency-type" name="currency_id">
            <option value="">{{ __('messages.flash.select_currency') }}</option>
            @foreach ($currencies as $key => $currency)
            <option value="{{ $currency['id'] }}" {{ $invoice->currency_id == $currency['id'] ? 'selected' : '' }}>{{ $currency['icon'] }}
                &nbsp;&nbsp;&nbsp; {{ $currency['name'] }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="mt-5 col-lg-3 col-sm-12">
        <!--   <label class="form-check form-switch form-check-custom mt-5">
            <input class="form-check-input recurring-status" type="checkbox" name="recurring_status"
                id="recurringStatusToggle" {{ $invoice->recurring_status ? 'checked' : '' }}>
            <span class="form-check-label text-gray-600"
                for="recurringStatusToggle">{{ __('messages.invoice.this_is_recurring_invoice') }}</span>&nbsp;&nbsp;
        </label>
    </div>
    <div class="mb-5 col-lg-3 col-sm-12 recurring-cycle-content">
        {{ Form::label('recurringCycle', __('messages.invoice.recurring_cycle') . ':', ['class' => 'form-label mb-3']) }}
        {{ Form::number('recurring_cycle', $invoice->recurring_cycle, ['class' => 'form-control', 'id' => 'recurringCycle', 'autocomplete' => 'off', 'placeholder' => __('messages.flash.number_of_days_for_recurring_cycle')]) }}
    -->
    </div>
</div>
<div class="mb-0">
    <div class="col-12 text-end my-5">
        <button type="button" class="btn btn-primary text-start" id="addItem">
            {{ __('messages.invoice.add') }}</button>
    </div>
    <div class="table-responsive">
        <table class="table table-striped box-shadow-none mt-4" id="billTbl">
            <thead>
                <tr class="border-bottom fs-7 fw-bolder text-gray-700 text-uppercase">
                    <th scope="col">#</th>
                    <th scope="col" class="required">{{ __('messages.product.product') }}</th>
                    <th scope="col" class="required">{{ __('messages.product.unit_price') }}</th>
                    <th scope="col">{{ __('Perecentage') }}</th>
                    <th scope="col" class="required">{{ __('messages.invoice.amount') }}</th>
                    <th scope="col" class="text-end">{{ __('messages.common.action') }}</th>
                </tr>
            </thead>
            <tbody class="invoice-item-container">
                @php
                $i = 1;
                @endphp
                @foreach ($invoice->invoiceItems as $invoiceItem)
                <tr class="tax-tr">
                    <td class="text-center item-number align-center">{{ $i++ }}</td>
                    <td class="table__item-desc w-25">
                        {{ Form::select('product_id[]', $products, isset($invoiceItem->product_id) ? $invoiceItem->product_id : $invoiceItem->product_name ?? [], ['class' => 'form-select productId product io-select2', 'required', 'placeholder' => __('messages.flash.select_product_or_enter_free_text'), 'data-control' => 'select2']) }}
                        {{ Form::hidden('id[]', $invoiceItem->id) }}
                    </td>
                    <td class="table__qty d-none">
                        {{ Form::number('quantity[]', number_format($invoiceItem->quantity, 2), ['class' => 'form-control qty ', 'id' => 'qty', 'required', 'type' => 'number', 'min' => '0', 'step' => '.01', 'oninput' => "validity.valid||(value=value.replace(/[e\+\-]/gi,''))"]) }}
                    </td>
                    <td>
                        {{ Form::number('price[]', $invoiceItem->price, ['class' => 'form-control price-input price ', 'oninput' => "validity.valid||(value=value.replace(/[e\+\-]/gi,''))", 'min' => '0', 'step' => '.01', 'required', 'onKeyPress' => 'if(this.value.length==8) return false;']) }}
                    </td>
                    <td>
                        <!-- <select name="tax[]" class='form-select  fw-bold tax io-select2' data-control='select2' multiple="multiple">
                            @foreach ($taxes as $tax)
                            @if (empty($selectedTaxes))
                            <option value="{{ $tax->value }}" data-id="{{ $tax->id }}">
                                {{ $tax->name }}
                            </option>
                            @elseif(in_array($tax->id, $selectedTaxes[$invoiceItem->id]))
                            <option value="{{ $tax->value }}" {{ in_array($tax->id, $selectedTaxes[$invoiceItem->id]) && in_array($tax->id, $selectedTaxes[$invoiceItem->id]) ? 'selected' : '' }} data-id="{{ $tax->id }}">
                                {{ $tax->name }}
                            </option>
                            @else
                            <option value="{{ $tax->value }}" data-id="{{ $tax->id }}">
                                {{ $tax->name }}
                            </option>
                            @endif
                            @endforeach
                        </select> -->
                        {{ Form::number('percentage', $invoice->percentage ?? 0, ['class' => 'form-control percentage', 'id' => 'percentage', 'readonly'=>true, 'oninput' => "validity.valid||(value=value.replace(/[e\+\-]/gi,''))", 'min' => '0', 'value' => '0', 'step' => '.01', 'pattern' => "^\d*(\.\d{0,2})?$", 'required', 'onKeyPress' => 'if(this.value.length==8) return false;']) }}

                    </td>
                    <td class="text-end item-total pt-8 text-nowrap">
                        {{ number_format($invoiceItem->total, 2) }}
                    </td>
                    <td class="text-end">
                        <button type="button" title="Delete" class="btn btn-icon fs-3 text-danger btn-active-color-danger delete-invoice-item">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">

        <div class="col-xxl-3 col-lg-5 col-md-6 ms-md-auto mt-4 mb-lg-10 mb-6">
            <div class="border-top">
                <table class="table table-borderless box-shadow-none mb-0 mt-5">
                    <tbody>
                        <tr>
                            <!--       <td class="ps-0">{{ __('messages.invoice.sub_total') . ':' }}</td>
                            <td class="text-gray-900 text-end pe-0">
                                @if (!getSettingValue('currency_after_amount'))
                                    <span
                                        class="invoice-selected-currency">{{ getInvoiceCurrencyIcon($invoice->currency_id) }}</span>
                                @endif
                                <span id="total" class="price">
                                    {{ isset($invoice) ? number_format($invoice->amount, 2) : 0 }}
                                </span>
                                @if (getSettingValue('currency_after_amount'))
                                    <span
                                        class="invoice-selected-currency">{{ getInvoiceCurrencyIcon($invoice->currency_id) }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-0">{{ __('messages.invoice.discount') . ':' }}</td>
                            <td class="text-gray-900 text-end pe-0">
                                @if (!getSettingValue('currency_after_amount'))
                                    <span
                                        class="invoice-selected-currency">{{ getInvoiceCurrencyIcon($invoice->currency_id) }}</span>
                                @endif
                                <span id="discountAmount">
                                    @if (isset($invoice) && $invoice->discount_type == \App\Models\Invoice::FIXED)
                                        {{ $invoice->discount ?? 0 }}
                                    @else
                                        {{ isset($invoice) ? number_format(($invoice->amount * $invoice->discount) / 100, 2) : 0 }}
                                    @endif
                                </span>
                                @if (getSettingValue('currency_after_amount'))
                                    <span
                                        class="invoice-selected-currency">{{ getInvoiceCurrencyIcon($invoice->currency_id) }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-0">{{ __('messages.invoice.total_tax') . ':' }}</td>
                            <td class="text-gray-900 text-end pe-0">
                                @if (!getSettingValue('currency_after_amount'))
                                    <span
                                        class="invoice-selected-currency">{{ getInvoiceCurrencyIcon($invoice->currency_id) }}</span>
                                @endif
                                <span id="totalTax">
                                    0
                                </span>
                                @if (getSettingValue('currency_after_amount'))
                                    <span
                                        class="invoice-selected-currency">{{ getInvoiceCurrencyIcon($invoice->currency_id) }}</span>
                                @endif
                            </td>
                        </tr>-->
                        <tr>
                            <td class="ps-0">{{ __('messages.invoice.total') . ':' }}</td>
                            <td class="text-gray-900 text-end pe-0">
                                @if (!getSettingValue('currency_after_amount'))
                                <span class="invoice-selected-currency">{{ getInvoiceCurrencyIcon($invoice->currency_id) }}</span>
                                @endif
                                <span id="finalAmount">
                                    {{ isset($invoice) ? number_format($invoice->amount - ($invoice->amount * $invoice->discount) / 100, 2) : 0 }}
                                </span>
                                @if (getSettingValue('currency_after_amount'))
                                <span class="invoice-selected-currency">{{ getInvoiceCurrencyIcon($invoice->currency_id) }}</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>
    <div class="row justify-content-left">
        <div class="col-lg-12 col-md-12 col-sm-12 end justify-content-left mb-sm-0 mb-5">
            <button type="button" class="btn btn-primary note" id="addNote">
                <i class="fas fa-plus"></i> {{ __('messages.invoice.add_note_term') }}
            </button>
            <button type="button" class="btn btn-danger note" id="removeNote">
                <i class="fas fa-minus"></i> {{ __('messages.invoice.remove_note_term') }}
            </button>
        </div>
        <div class="col-lg-6 mb-0 mb-sm-5 mt-0 mt-sm-5" id="noteAdd">
            {{ Form::label('note', __('messages.invoice.note') . ':', ['class' => 'form-label fs-6 mb-3']) }}
            {{ Form::textarea('note', isset($invoice) ? $invoice->note : null, ['class' => 'form-control', 'id' => 'note', 'rows' => '5']) }}
        </div>
        <div class="col-lg-6 mt-5 mb-5" id="termRemove">
            {{ Form::label('term', __('messages.invoice.terms') . ':', ['class' => 'form-label fs-6 mb-3']) }}
            {{ Form::textarea('term', isset($invoice) ? $invoice->term : null, ['class' => 'form-control', 'id' => 'term', 'rows' => '5']) }}
        </div>
    </div>
</div>
<!-- Total Amount Field -->
{{ Form::hidden('amount', isset($invoice) ? number_format($invoice->amount - ($invoice->amount * $invoice->discount) / 100, 2) : 0, ['class' => 'form-control', 'id' => 'total_amount']) }}

<!-- Final Amount Field -->
{{ Form::hidden('final_amount', isset($invoice) ? $invoice->final_amount : 0, ['class' => 'form-control', 'id' => 'finalTotalAmt']) }}

<!-- Submit Field -->
<div class="float-end">
    <div class="form-group col-sm-12">
        <button type="button" name="save" class="btn btn-primary mx-1 ms-ms-3 mb-3 mb-sm-0" id="editSave" data-status="0" value="0">{{ __('messages.common.save') }}
        </button>
        @if ($invoice->status == \App\Models\Invoice::DRAFT)
        <button type="button" name="save_send" class="btn btn-primary mx-1 ms-ms-3 mb-3 mb-sm-0" id="editSaveAndSend" data-status="1" value="1">{{ __('messages.common.save_send') }}
        </button>
        @endif
        <a href="{{ route('invoices.index') }}" class="btn btn-secondary btn-active-light-primary">{{ __('messages.common.cancel') }}</a>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#payout_cycle", {
            mode: "range",
            dateFormat: "m/d/Y",
            defaultDate: [
                "{{ $invoice->payout_cycle_start }}", 
                "{{ $invoice->payout_cycle_end }}"
            ],
            minDate: "today", 
        });
    });
</script>
