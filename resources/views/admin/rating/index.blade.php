@extends('admin.master')

@section('title', __('keywords.show'))

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="h5 page-title mb-4">{{ __('keywords.rating') }}</h2>

                @foreach($ratings as $rating)
                    <div class="card mb-3 shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center bg-light py-3">
                            <span class="fw-bold text-dark">{{ __('keywords.reviewer') }}: {{ $rating->user->name ?? __('keywords.anonymous') }}</span>
                            <small class="text-muted">{{ $rating->created_at->format('d M Y, H:i') }}</small>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <span class="mr-2 fw-bold">{{ __('keywords.rating') }}:</span>
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star{{ $i <= $rating->rating ? ' text-warning' : ' text-secondary' }}"></i>
                                @endfor
                            </div>
                            <p class="text-dark mb-0"><strong class="mr-1">{{ __('keywords.review') }}:</strong> {{ $rating->review }}</p>
                        </div>
                    </div>
                @endforeach

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                                       {{ $ratings->links('pagination::bootstrap-4') }}

                </div>
            </div>
        </div>
    </div>
@endsection

