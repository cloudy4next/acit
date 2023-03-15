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
                            <label for="tile"> Title </label> <span class="text-danger">*</span>
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
                    </div>

                    <div class="row">

                        <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <label class="form-label">Uploaded Image : </label>
                            @php
                                $fileDatum = $diagnosis->image;
                                if ($fileDatum == null) {
                                    echo '<div><small>File not found.</small></div>';
                                }
                            @endphp
                            {{-- {{ $diagnosis->image }} --}}

                            <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <img id="preview-image-before-upload"
                                    src="{{ url('/uploads/diagnosis/image/' . $diagnosis->image) }}" alt="preview image"
                                    style="max-height: 120px; border: 5px solid #555">
                            </div>
                            <a href="{{ URL::to('/uploads/diagnosis/image/' . $diagnosis->image) }}" download>
                                Download </a>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <label for="replay"> Replay </label><span class="text-danger">*</span>
                            {!! Form::textarea('replay', $diagnosis->replay, [
                                'class' => 'form-control replay',
                                'id' => 'replay',
                                'rows' => '2',
                                'placeholder' => 'Enter Reply',
                                'tabindex' => 5,
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
        $(document).ready(function() {

            CKEDITOR.replace('description', {
                height: 200
            });

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
@endpush
