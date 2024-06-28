@extends('layouts.app')
@section('title')
    {{__('messages.client.add_client')}}
@endsection
@section('content')
    @php $styleCss = 'style'; @endphp
    <div class="container-fluid">
        @include('flash::message')
        <div class="d-flex flex-column">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-end mb-5">
                        <h1>@yield('title')</h1>
                        <div class="d-flex">
                           <form id="csvUploadForm" action="{{ route('upload.csv') }}" method="POST" enctype="multipart/form-data" class="d-flex">
            @csrf
          
            <input type="file" id="csvFile" name="csv_file" style="display: none;" required>
            <button type="button" id="uploadButton" class="btn btn-success me-3">{{ __('Import') }}</button>
        </form>
        <script>
    document.getElementById('uploadButton').addEventListener('click', function() {
        var fileInput = document.getElementById('csvFile');
        if (fileInput.files.length === 0) {
            fileInput.click();
        } else {
            document.getElementById('csvUploadForm').submit();
        }
    });

    document.getElementById('csvFile').addEventListener('change', function() {
        var uploadButton = document.getElementById('uploadButton');
        if (this.files.length > 0) {
            uploadButton.innerText = 'Submit';
        } else {
            uploadButton.innerText = 'Upload CSV File';
        }
    });
</script>
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
