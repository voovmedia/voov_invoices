<?php

namespace App\Livewire;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ClientDetailInvoiceTable extends LivewireTableComponent
{
    protected $model = Invoice::class;

    public $clientId = null;

    public $showButtonOnHeader = true;

    public $buttonComponent = 'components.multi-send-reminder-button';

    public function mount(int $clientId): void
    {
        $this->clientId = $clientId;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('created_at', 'asc');
        $this->setQueryStringStatus(false);
        $this->setThAttributes(function (Column $column) {
            if ($column->isField('final_amount')) {
                return [
                    'class' => 'd-flex justify-content-end',
                ];
            }
            if ($column->isField('amount')) {
                return [
                    'class' => 'text-end',
                ];
            }

            return ['class' => 'text-center'];
        });

        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->getField() === 'status') {
                return [
                    'class' => 'text-center',
                ];
            }
            if (in_array($column->getField(), ['final_amount', 'amount'])) {
                return [
                    'class' => 'text-end',
                ];
            }

            return [
            ];
        });
    }

    public function columns(): array
    {
        return [
            Column::make(__('Select Invoices'), 'invoice_id')
            ->view('clients.components.checkbox'),    
            Column::make(__('messages.invoice.invoice_id'), 'id')
                ->sortable()
                ->searchable()
                ->view('clients.components.invoice-id'),
            Column::make('invoice_id', 'invoice_id')
                ->sortable()
                ->searchable()->hideIf(1),
            Column::make(__('messages.invoice.invoice_date'), 'invoice_date')
                ->sortable()
                ->searchable()
                ->format(function ($value, $row, Column $column) {
                    return view('invoices.components.invoice-due-date')
                        ->withValue([
                            'invoice-date' => $row->invoice_date,
                        ]);
                }),
                
           Column::make(__('Payout Cycle'), 'payout_cycle_start')
                ->sortable()
                ->searchable()
                ->format(function ($value, $row, Column $column) {
                    return view('invoices.components.invoice-payout-cycle')
                        ->withValue([
                            'payout_cycle_start' => $row->payout_cycle_start,
                            'payout_cycle_end' => $row->payout_cycle_end,
                        ]);
                }),
                Column::make(__('Reminder Send'), 'last_rem_sent_at')
                ->sortable()
                ->searchable()
                ->format(function ($value, $row, Column $column) {
                    return view('invoices.components.invoice-last-reminder-sent')
                        ->withValue([
                            'last_rem_sent_at' => $row->last_rem_sent_at,
                            'status' => $row->status,
                        ]);
                }),
            Column::make(__('messages.invoice.amount'), 'final_amount')
                ->sortable()
                ->searchable()
                ->format(function ($value, $row, Column $column) {
                    return getInvoiceCurrencyAmount($row->final_amount, $row->currency_id, true);
                }),
            Column::make(__('messages.invoice.transactions'), 'amount')
                ->searchable()
                ->view('invoices.components.transaction'),
            Column::make(__('messages.common.status'), 'status')
                ->searchable()
                ->view('invoices.components.transaction-status'),
        ];
    }

    public function builder(): Builder
    {
        return Invoice::where('client_id', $this->clientId)->with('payments')->select('invoices.*')->orderByRaw("FIELD(status, 1, 0,2) ASC")->orderBy('created_at', 'asc');
}
}
