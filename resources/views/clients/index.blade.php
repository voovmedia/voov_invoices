@extends('layouts.app')

@section('title', __('messages.clients'))

@section('content')
<div class="container-fluid">
    <div class="d-flex flex-column">
        @include('flash::message')
        <livewire:client-table />
    </div>
</div>

@endsection
<script>
    document.addEventListener("DOMContentLoaded", function() {

        listenClick(".delete-clients-btn", function(event) {
            var recordIds = $('input[name^=selectedClients]:checked').map(function(idx, elem) {
                return $(elem).val();
            }).get();
            if (recordIds.length == 0) {
                swal({
                    icon: "success",
                    title: "Can't delete",
                    text: 'Please select clent those you want to delete',
                    timer: 2000,
                    button: Lang.get("js.ok"),
                });
                return;
            }
            var callFunction =
                arguments.length > 3 && arguments3 !== undefined ? arguments3 : null;
            header = Lang.get("js.client");
            swal({
                title: Lang.get("js.delete") + " !",
                text: Lang.get("js.are_you_sure_delete") + ' "' + header + '" ?',
                buttons: [Lang.get("js.no_cancel"), Lang.get("js.yes_delete")],
                icon: sweetAlertIcon,
            }).then(function(willDelete) {
                if (willDelete) {
                    $.ajax({
                        url: route("clients.deleteSelected"),
                        type: "DELETE",
                        dataType: "json",
                        data: {
                            clientWithInvoices: true,
                            selectedClients: recordIds

                        },
                        success: function(obj) {
                            if (obj.success) {
                                Livewire.dispatch("refreshDatatable");
                                Livewire.dispatch("resetPageTable");
                            }
                            swal({
                                icon: "success",
                                title: Lang.get("js.deleted"),
                                text: header + " " + Lang.get("js.has_been_deleted"),
                                timer: 2000,
                                button: Lang.get("js.ok"),
                            });
                            if (callFunction) {
                                eval(callFunction);
                            }
                        },
                        error: function(data) {
                            swal({
                                title: Lang.get("js.delete") + " !",
                                text: Lang.get(
                                    "js.are_sure_want_to_delete_this_client_related_all_invoices"
                                ),
                                buttons: [
                                    Lang.get("js.no_cancel"),
                                    Lang.get("js.yes_delete"),
                                ],
                                icon: sweetAlertIcon,
                            }).then(function(willDelete) {
                                if (willDelete) {
                                    $.ajax({
                                        url: route("clients.deleteSelected"),
                                        type: "DELETE",
                                        dataType: "json",
                                        data: {
                                            selectedClients: recordIds
                                        },
                                        success: function(obj) {
                                            if (obj.success) {
                                                Livewire.dispatch("refreshDatatable");
                                                Livewire.dispatch("resetPageTable");
                                            }
                                            swal({
                                                icon: "success",
                                                title: Lang.get("js.deleted"),
                                                text: header +
                                                    " " +
                                                    Lang.get("js.has_been_deleted"),
                                                timer: 2000,
                                                button: Lang.get("js.ok"),
                                            });
                                            if (callFunction) {
                                                eval(callFunction);
                                            }
                                        },
                                        error: function(data) {},
                                    });
                                }
                            });
                        },
                    });
                }
            });
        });
    });
</script>