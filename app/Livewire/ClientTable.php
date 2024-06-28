<?php

namespace App\Livewire;

use App\Models\Client;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Livewire\Component;

class ClientTable extends LivewireTableComponent
{
    protected $model = Client::class;
    protected string $tableName = 'clients';

    // for table header button
    public $showButtonOnHeader = true;
    public $buttonComponent = 'clients.components.add-button';

    public $selectedClients = [];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('created_at', 'desc');
        $this->setQueryStringStatus(false);

        $this->setThAttributes(function (Column $column) {
            if ($column->getField() == 'id') {
                return [
                    'style' => 'width:9%;text-align:center',
                ];
            }

            return [];
        });

        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->getField() === 'first_name') {
                return [
                    'class' => 'w-75',
                ];
            }

            return [];
        });
    }

    public function columns(): array
    {
        return [
            Column::make('Select', 'id')
                ->format(function ($value, $row, Column $column) {
                    return '<input type="checkbox" wire:model="selectedClients" value="'.$row->id.'">';
                })
                ->html(),
            Column::make(__('messages.client.client'), 'user.first_name')
                ->searchable(function (Builder $query, $direction) {
                    $query->whereRaw("TRIM(CONCAT(first_name,' ',last_name,' ')) like '%{$direction}%'");
                })
                ->sortable()
                ->view('clients.components.full_name'),
            Column::make('email', 'user.email')
                ->searchable()
                ->hideIf(1),
            Column::make(__('messages.common.invoice'), 'channel_name')
                ->sortable(fn(Builder $query, string $direction) => $query->orderBy('invoices_count', $direction))
                ->view('clients.components.invoice-count'),
            Column::make(__('messages.common.action'), 'id')
                ->format(function ($value, $row, Column $column) {
                    return view('livewire.action-button')->with([
                        'editRoute' => route('clients.edit', $row->id),
                        'dataId' => $row->id,
                        'editClass' => 'user-edit-btn',
                        'deleteClass' => 'client-delete-btn',
                    ]);
                }),
        ];
    }

    public function builder(): Builder
    {
        $query = Client::with(['user.media'])->withCount('invoices');
        return $query;
    }

    public function resetPageTable()
    {
        $this->customResetPage('clientsPage');
    }

    public function deleteSelected()
    {
        if (empty($this->selectedClients)) {
            session()->flash('error', 'No clients selected for deletion');
            return;
        }

        try {
            Client::whereIn('id', $this->selectedClients)->each(function ($client) {
                $client->user()->delete();
                $client->invoices()->delete();
                $client->delete();
            });

            $this->selectedClients = [];
            session()->flash('message', 'Selected clients have been deleted successfully');
            $this->emit('clientDeleted');
        } catch (Exception $exception) {
            session()->flash('error', 'An error occurred while deleting clients: ' . $exception->getMessage());
        }
    }
}
