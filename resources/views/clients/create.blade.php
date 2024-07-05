@extends('layouts.app')
@section('title')
    {{__('messages.client.add_client')}}
@endsection
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS and dependencies (Popper.js and jQuery) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@section('content')
    @php $styleCss = 'style'; @endphp
    <div class="container-fluid">
        @include('flash::message')
        <div class="d-flex flex-column">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-end mb-5">
                        <h1>@yield('title')</h1>
                        <div class="d-flex">
                       <button type="button" class="btn btn-success" data-toggle="modal" data-target="#uploadModal">
    {{ __('Import') }}
</button>

                        <a class="btn btn-outline-primary"
                           href="{{ route('clients.index') }}">{{ __('messages.common.back') }}</a>
                    </div>
                </div>
                <div class="col-12">
                    @include('layouts.errors')
                </div>
                <div class="card">
                    <div class="card-body">
                        {{ Form::open(['route' => 'clients.store','files' => 'true','id'=>'clientForm']) }}
                        @include('clients.fields')
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Upload CSV</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="csvUploadForm" action="{{ route('upload.csv') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="csvFile">Choose CSV file</label>
                        <input type="file" class="form-control-file" id="csvFile" name="csv_file"  accept=".csv,text/csv,application/csv,text/comma-separated-values,text/csv,application/excel,application/vnd.ms-excel,application/vnd.msexcel"  required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
    {{ Form::hidden('is_edit', false ,['id' => 'isEdit']) }}
    {{ Form::hidden('default_avatar_image_url', asset('assets/images/avatar.png'),['id' => 'defaultAvatarImageUrl']) }}
    {{ Form::hidden('country_id', old('country_id'),['id' => 'clientCountryId']) }}
    {{ Form::hidden('state_id', old('state_id') ,['id' => 'clientStateId']) }}
    {{ Form::hidden('city_id', old('city_id') ,['id' => 'clientCityId']) }}
@endsection
@section('phone_js')
    <script>
        phoneNo = "{{ old('region_code').old('contact') }}"
    </script>

    
@endsection
