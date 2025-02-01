@extends('admin.master')

@section('title', __('keywords.show'))

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow-lg mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">{{ __('keywords.ad_details') }}</h5>
                    </div>
                    <div class="card-body">
                        <!-- Display each attribute in a separate row -->
                        <div class="row mb-3">
                            <div class="col-md-3 font-weight-bold">{{ __('keywords.title') }}</div>
                            <div class="col-md-9">{{ $section }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 font-weight-bold">{{ __('keywords.category_name') }}</div>
                            <div class="col-md-9">{{ $category }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 font-weight-bold">{{ __('keywords.member_name') }}</div>
                            <div class="col-md-9">{{ $member }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 font-weight-bold">{{ __('keywords.ad_title') }}</div>
                            <div class="col-md-9">{{ $ad->title }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 font-weight-bold">{{ __('keywords.ad_image') }}</div>
                            <div class="col-md-9">
                                @if ($ad->image)
                                    <img src="{{ asset($ad->image) }}" alt="{{ $ad->title }}" class="img-fluid rounded shadow" style="max-width: 300px; height: auto;">
                                @else
                                    <p class="text-muted">{{ __('keywords.no_image_available') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 font-weight-bold">{{ __('keywords.ad_description') }}</div>
                            <div class="col-md-9">{{ $ad->description }}</div>
                        </div>
                      <div class="row mb-3">
                            <div class="col-md-3 font-weight-bold">{{ __('keywords.ad_discount') }}</div>
                            <div class="col-md-9">{{ $ad->discount }} %</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 font-weight-bold">{{ __('keywords.ad_status') }}</div>
                            <div class="col-md-9">{{ $ad->status }}</div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
