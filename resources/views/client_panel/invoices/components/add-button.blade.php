<div class="dropdown my-3 my-sm-3">
    <button class="btn btn-success text-white dropdown-toggle" type="button" data-bs-toggle="dropdown"
        aria-expanded="false">
        {{ __('messages.common.export') }}
    </button>
    <ul class="dropdown-menu export-dropdown">
        <a href="{{ route('client.invoicesExcel') }}" class="dropdown-item" data-turbo="false">
            <i class="fas fa-file-excel me-1"></i> {{ __('messages.invoice.excel_export') }}
        </a>
        <a href="{{ route('client.invoices.pdf') }}" class="dropdown-item" data-turbo="false">
            <i class="fas fa-file-pdf me-1"></i> {{ __('messages.pdf_export') }}
        </a>
    </ul>
</div>
