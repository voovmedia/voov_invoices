<span class="badge badge-circle bg-danger me-2">
    <a href="{{route('clients.show',$row->id.'?Active=invoices')}}" data-turbo="false"
       class="text-decoration-none text-white">{{ $row->unpaid_invoices_count -$row->paid_invoices_count}}</a>
</span>
