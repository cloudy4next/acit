@extends(backpack_view('blank'))
@push('after_styles')
    <style>
        .btn {
            position: absolute;
            right: 3%;
            bottom: 3%;
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
@endpush
@section('content')
    <div class="">
        <div class="row mt-4">
            <div class="col-sm-6 col-lg-4">
                <div class="card text-white bg-danger mb-3" style="width: 18rem;">
                    <div class="card-body">
                        <h4 style="margin-top: 0.25em;" class="card-title text-center bolded"> {{ $post }}</h4>
                        <p class="card-text
                            text-center">Total Post</p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4">
                <div class="card text-white bg-primary mb-3" style="width: 18rem;">
                    <div class="card-body">
                        <h4 style="margin-top: 0.25em;" class="card-title text-center">
                            {{ $tutorial }}
                        </h4>
                        <p class="card-text text-center">Total Tutorial</p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4">
                <div class=" card text-white bg-dark mb-3" style="width: 18rem;">
                    <div class="card-body">
                        <h4 style="margin-top: 0.25em;" class="card-title text-center"> {{ $notice }}</h4>
                        <p class="card-text text-center">Total Notice</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <!-- /.col-->
            <div class="col-sm-6 col-lg-4">
                <div class="card text-white bg-primary mb-3" style="width: 18rem;">
                    <div class="card-body">
                        <h4 style="margin-top: 0.25em;" class="card-title text-center">
                            {{ $diagnosis }}
                        </h4>
                        <p class="card-text text-center"> Total Diagnosis</p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4">
                <div class="card text-white bg-dark mb-3" style="width: 18rem;">
                    <div class="card-body">
                        <h4 style="margin-top: 0.25em;" class="card-title text-center">{{ $farmer }}</h4>
                        <p class="card-text text-center">Total Farmer </p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4">
                <div class="card text-white bg-info mb-3" style="width: 18rem;">
                    <div class="card-body">
                        <h4 style="margin-top: 0.25em;" class="card-title text-center"> {{ $user }}</h4>
                        <p class="card-text text-center">Total User</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title"><span style="color:red">Expense</span> <small>VS</small> <span
                            style="color:blue">Profit</span>
                </div>
            </div>
            <div class="card-body">

                <div class="position-relative mb-4">
                    <canvas id="visitors-chart" height="200"></canvas>
                </div>
            </div>
        </div> --}}

    </div>
    </div>
@endsection

@push('after_scripts')
    <script src="{{ asset('assets/js/chart.js/Chart.min.js') }}"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="{{ asset('assets/js/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard3.js') }}"></script>
@endpush

@push('styles')
    <style>
        .card {
            padding: 1.5em .5em .5em;
            border-radius: 2em;
            text-align: center;
            box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
        }

        .card .card-title {
            font-weight: 700;
            font-size: 1.5em;
        }
    </style>
@endpush
