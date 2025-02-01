@extends('admin.master')

@section('title', __('keywords.show'))

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow-lg mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">{{ __('keywords.messages') }}</h5>
                    </div>
                    @foreach($messages as $message)

                        <div class="card-body">
                            <!-- Display each attribute in a separate row -->
                            <div class="row mb-3">
                                <div class="col-md-3 font-weight-bold">{{ __('keywords.message_name') }}</div>
                                <div class="col-md-9">{{ $message->name }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3 font-weight-bold">{{ __('keywords.message_message') }}</div>
                                <div class="col-md-9">{{ $message->message }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
