<span class="badge badge-circle bg-success me-2">
    <a href="{{route('clients.show',$row->id.'?Active=invoices')}}" data-turbo="false"
       class="text-decoration-none text-white">{{ $row->paid_invoices_count }}</a>
</span>
