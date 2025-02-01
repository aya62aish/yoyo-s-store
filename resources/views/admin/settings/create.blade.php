@extends('admin.master')

@section('title', __('keywords.update_contact_info'))

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="h5 page-title">{{ __('keywords.update_contact_info') }}</h2>

                <!-- Contact Information Update Form -->
                <div class="card shadow mt-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">{{ __('keywords.edit_contact_info') }}</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.setting.update') }}" method="post" class="row g-3">
                            @csrf
                            @method('PUT')

                            <!-- Phone Number Field -->
                            <div class="col-md-6">
                                <label for="phone" class="form-label fw-bold">{{ __('keywords.phone') }}</label>
                                <input type="text" name="phone" id="phone" class="form-control" placeholder="{{ __('keywords.enter_phone') }}" value="{{ old('phone', \App\Models\Setting::find(1)->phone) }}" required>
                                <x-validation-error field="phone"></x-validation-error>
                            </div>

                            <!-- Email Field -->
                            <div class="col-md-6">
                                <label for="email" class="form-label fw-bold">{{ __('keywords.email') }}</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="{{ __('keywords.enter_email') }}" value="{{ old('email', \App\Models\Setting::find(1)->email) }}" required>
                                <x-validation-error field="email"></x-validation-error>
                            </div>

                            <!-- Update Button -->
                            <div class="col-12 d-flex justify-content-end mt-2">
                                <button type="submit" class="btn btn-success">{{ __('keywords.update') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
