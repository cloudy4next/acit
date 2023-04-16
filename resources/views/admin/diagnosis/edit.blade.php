@extends('admin.layout.master', [
'breadcrumb' => [
{{-- 'diagnosis' => route('admin.diagnosis'), --}}
'diagnosis replay' => false,
]
])

@section('diagnosis-title', 'edit diagnosis')

@section('content')
    @parent
    <div class="row" id="content">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card">
                {!! Form::open([
                    'route' => ['admin.diagnosis.update', $diagnosis->id],
                    'autocomplete' => 'off',
                    'class' => 'form-horizontal',
                    'novalidate',
                    'files' => true,
                ]) !!}
                <div class="card-header">
                    <i class="la la-plus"></i> Replay diagnosis
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
                            <label for="tile"> Title </label> <span class="text-danger"></span>
                            {!! Form::text('title', $diagnosis->title, [
                                'class' => 'form-control title',
                                'id' => 'job-title',
                                'tabindex' => 1,
                                'diagnosis-error' => 'Title field is require',
                                'placeholder' => 'Enter title',
                                'readonly',
                            ]) !!}
                            <div class="help-block with-errors text-danger"></div>
                            @if ($errors->has('title'))
                                <span class="text-danger"><strong>{{ $errors->first('title') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
                            <label for="tile"> Description </label> <span class="text-danger"></span>
                            {!! Form::textarea('description', $diagnosis->description, [
                                'class' => 'form-control description',
                                'tabindex' => 4,
                                'rows' => 4,
                                'readonly',
                            ]) !!}
                        </div>
                    </div>

                    <div class="row">

                        <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <label class="form-label">Uploaded Image : </label>
                            @if ($diagnosis->image == null)
                                <div><i class="las la-times"></i><small style="color:red;>File not found."</small></div>
                            @else
                                @foreach (json_decode($diagnosis->image) as $image)
                                    <a href="{{ URL::to('/uploads/diagnosis/image/' . $image) }}" download>
                                        <i class="las la-download"></i><b>Download </b></a>
                                @endforeach

                                <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <img id="preview-image-before-upload"
                                        src="{{ url('/uploads/diagnosis/image/' . $image) }}" alt="preview image"
                                        style="max-height: 130px; max-width: 220px; border: 5px solid #8b14cb">
                                </div>
                            @endif

                        </div>
                        <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <label class="form-label">Uploaded Video : </label>
                            @php
                                $fileDatum = $diagnosis->video;
                                if ($fileDatum == null) {
                                    echo '<div> <h6 style="color:red;"><i class="las la-times">File not uploaded/found!!</i></h6></div>';
                                }
                            @endphp

                            <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <video controls style="max-height: 130px; max-width: 220px; border: 5px solid #8f0bf4">
                                    <source src="{{ url('/uploads/diagnosis/video/' . $diagnosis->video) }}"
                                        type="video/mp4">
                                </video>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-10">
                            <label for="replay"> Replay </label><span class="text-danger">*</span>
                            {!! Form::textarea('replay', $diagnosis->replay, [
                                'class' => 'form-control replay',
                                'id' => 'replay',
                                'rows' => '2',
                                'placeholder' => 'Enter Reply',
                                'tabindex' => 2,
                                'required' => 'required',
                                'diagnosis-error' => trans('exam.validator_massege'),
                            ]) !!}
                            <div class="help-block with-errors text-danger"></div>
                            @if ($errors->has('description'))
                                <span class="text-danger"><strong>{{ $errors->first('description') }}</strong></span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success question-set-submit">
                        <span class="la la-save"></span> &nbsp;
                        <span class="mr-3"> Save </span>
                    </button>

                    <a href="{!! url('/admin/diagnosis') !!}" class="btn btn-default"><span class="la la-ban"></span>
                        &nbsp;Cancel</a>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@push('after_styles')
    <link rel="stylesheet" href="{{ asset('/packages/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" />
@endpush

@push('after_scripts')
    <script src="{{ asset('/packages/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.14.0/jquery.validate.min.js"></script>
    <script src="{{ asset('assets/js/jquery/select2/js/select2.min.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.15.1/standard-all/ckeditor.js"></script>

    <script type="text/javascript">
        function initMap() {
            const myLatLng = {
                lat: 22.2734719,
                lng: 70.7512559
            };
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 5,
                center: myLatLng,
            });

            new google.maps.Marker({
                position: myLatLng,
                map,
                title: "Hello Rajkot!",
            });
        }

        window.initMap = initMap;
        $(document).ready(function() {

            $('.category').select2({
                theme: "bootstrap",
                placeholder: "Select category"
            });

            $('.status').select2({
                theme: "bootstrap",
                placeholder: "Select status"
            });
        });
    </script>
    <script type="text/javascript"
        src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap"></script>
@endpush
