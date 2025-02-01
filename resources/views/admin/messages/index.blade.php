@extends('admin.master')

@section('title', __('keywords.show'))

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <!-- Messages Table Card -->
                <div class="card shadow-lg mb-4">
                    <div class="card-header bg-primary text-white d-flex align-items-center">
                        <h5 class="card-title mb-0">{{ __('keywords.messages') }}</h5>
                    </div>

                    <!-- Messages Table -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="fw-bold">{{ __('keywords.sender') }}</th>
                                    <th scope="col" class="fw-bold">{{ __('keywords.message') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($messages as $message)
                                    <tr class="table-row">
                                        <!-- Sender Name with Initial Icon -->
                                        <td class="d-flex align-items-center">
                                            <span class="fw-bold">{{ $message->name }}</span>
                                        </td>

                                        <!-- Full Message Content -->
                                        <td class="text-muted">
                                            {{ $message->message }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        <div class="pagination pagination-sm">
                            {{ $messages->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
