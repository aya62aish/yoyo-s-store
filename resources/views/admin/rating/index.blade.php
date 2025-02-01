@extends('admin.master')

@section('title', __('keywords.show'))

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow-lg mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">{{ __('keywords.rating') }}</h5>
                    </div>
                    @foreach($ratings as $rating)

                        <div class="card-body">
                            <!-- Display each attribute in a separate row -->
                            <div class="row mb-3">
                                <div class="col-md-3 font-weight-bold">{{ __('keywords.rating_number') }}</div>
                                <div class="col-md-9">{{ $rating->rating }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3 font-weight-bold">{{ __('keywords.rating_review') }}</div>
                                <div class="col-md-9">{{ $rating->review }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
