@extends('admin.layout.master', [
'breadcrumb' => [
{{-- 'bulk-sms' => route('admin.bulk-sms'), --}}
'Bulk SMS' => false,
]
])

@section('bulk-sms-title', 'Send Bulk SMS')

@section('content')
    @parent
    <div class="row" id="content">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('admin.bulk-sms.send') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="form-group col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
                                <label for="tile"> Select Farmers </label> <span class="text-danger">*</span>
                                <select class="selectpicker form-control" multiple data-live-search="true" name="number[]">
                                    {{-- <option value="0" selected disabled hidden>Choose here</option> --}}
                                    <option value="all" selected>ALL</option>
                                    @foreach ($data as $farmer)
                                        <option value={{ $farmer->mobile }}>{{ $farmer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <label><strong>Message :</strong></label>
                                {{-- <textarea class="ckeditor form-control" name="message"></textarea> --}}
                                <textarea class="form-control" name="message"></textarea>

                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-success question-set-submit">
                                <span class="la la-save"></span> &nbsp;
                                <span class="mr-3"> Send </span>
                            </button>
                        </div>
                    </form>
                </div>
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
    {{-- <script src="https://cdn.ckeditor.com/4.15.1/standard-all/ckeditor.js"></script> --}}

    <script type="text/javascript">
        $(document).ready(function() {
            // CKEDITOR.replace('description', {
            //     height: 200
            // });

            $('.selectpicker').select2({
                theme: "bootstrap",
                placeholder: "Select Farmer"
            });

        });
    </script>
@endpush
