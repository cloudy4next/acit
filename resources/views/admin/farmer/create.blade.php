@extends('admin.layout.master', [
'breadcrumb' => [
{{-- 'Farmer' => route('admin.farmer'), --}}
'Farmer add' => false,
]
])

@section('Farmer-name', 'Create Farmer')

@section('content')
    @parent
    <div class="row" id="content">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card">
                {!! Form::open([
                    'route' => 'admin.farmer.store',
                    'autocomplete' => 'off',
                    'class' => 'form-horizontal',
                    'novalidate',
                    'files' => true,
                ]) !!}
                <div class="card-header">
                    <i class="la la-plus"></i> Create Farmer
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-12 col-sm-12 col-md-9 col-lg-4 col-xl-4">
                            <label for="Name">Farmer Name </label> <span class="text-danger">*</span>
                            {!! Form::text('name', null, [
                                'class' => 'form-control name',
                                'id' => 'name',
                                'tabindex' => 1,
                                'required' => 'required',
                                'data-error' => 'name field is require',
                                'placeholder' => 'Enter name',
                            ]) !!}
                            <div class="help-block with-errors text-danger"></div>
                            @if ($errors->has('name'))
                                <span class="text-danger"><strong>{{ $errors->first('name') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group col-12 col-sm-12 col-md-9 col-lg-4 col-xl-4">
                            <label for="mobile">Mobile</label> <span class="text-danger">*</span>
                            {!! Form::text('mobile', null, [
                                'class' => 'form-control mobile',
                                'id' => 'mobile',
                                'tabindex' => 1,
                                'required' => 'required',
                                'data-error' => 'mobile field is require',
                                'placeholder' => 'Enter mobile',
                            ]) !!}
                            <div class="help-block with-errors text-danger"></div>
                            @if ($errors->has('mobile'))
                                <span class="text-danger"><strong>{{ $errors->first('mobile') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group col-12 col-sm-12 col-md-9 col-lg-4 col-xl-4">
                            <label for="address">Address </label> <span class="text-danger">*</span>
                            {!! Form::text('address', null, [
                                'class' => 'form-control address',
                                'id' => 'addressaddress',
                                'tabindex' => 1,
                                'required' => 'required',
                                'data-error' => 'address field is require',
                                'placeholder' => 'Enter address',
                            ]) !!}
                            <div class="help-block with-errors text-danger"></div>
                            @if ($errors->has('address'))
                                <span class="text-danger"><strong>{{ $errors->first('address') }}</strong></span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-12 col-sm-12 col-md-9 col-lg-4 col-xl-4">
                            <label for="profession">Farmer Name </label> <span class="text-danger">*</span>
                            {!! Form::text('profession', null, [
                                'class' => 'form-control profession',
                                'id' => 'profession',
                                'tabindex' => 1,
                                'required' => 'required',
                                'data-error' => 'profession field is require',
                                'placeholder' => 'Enter profession',
                            ]) !!}
                            <div class="help-block with-errors text-danger"></div>
                            @if ($errors->has('profession'))
                                <span class="text-danger"><strong>{{ $errors->first('profession') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group col-12 col-sm-12 col-md-3 col-lg-6 col-xl-6">
                            <label for="upload" class="form-label">Upload(max 2 MB)</label> <span
                                class="text-danger">*</span>
                            {!! Form::file('image', [
                                'class' => 'form-control image',
                                'id' => 'image',
                                'rows' => '2',
                                'placeholder' => 'Upload Image',
                                'tabindex' => 5,
                                'required' => 'required',
                            ]) !!}
                            @if ($errors->has('image'))
                                <span class="text-danger"><strong>{{ $errors->first('image') }}</strong></span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success question-set-submit">
                        <span class="la la-save"></span> &nbsp;
                        <span class="mr-3"> Save </span>
                    </button>

                    <a href="{!! url('/admin/farmer') !!}" class="btn btn-default"><span class="la la-ban"></span>
                        &nbsp;Cancel</a>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
