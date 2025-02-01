@extends('admin.master')
@section('title', __('keywords.show_member'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">{{ __('keywords.member_details') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <img src="{{ asset($member->icon) }}" class="img-fluid rounded-circle mb-3" style="max-width: 200px;" alt="{{ $member->name }}">
                            <h4 class="mb-1">{{ $member->name }}</h4>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <strong>{{ __('keywords.section') }}:</strong>
                                <p>{{ $section }}</p>
                            </div>
                            <div class="col-6">
                                <strong>{{ __('keywords.category') }}:</strong>
                                <p>{{ $category }}</p>
                            </div>
                            <div class="col-12">
                                <strong>{{ __('keywords.location') }}:</strong>
                                <p>{{ $member->location }}</p>
                            </div>
                            <div class="col-12">
                                <strong>{{ __('keywords.contact_info') }}:</strong>
                                <p>
                                    <i class="bi bi-phone"></i> {{ $member->phone }}<br>
                                    <i class="bi bi-whatsapp"></i> {{ $member->whatsapp }}<br>
                                    <i class="bi bi-facebook"></i> {{ $member->facebook }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">{{ __('keywords.member_cover') }}</h5>
                    </div>
                    <div class="card-body">
                        <img src="{{ asset($member->cover) }}" class="img-fluid w-100" alt="{{ $member->name }} Cover">
                    </div>
                </div>

                <div class="card shadow mt-4">
                    <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">{{ __('keywords.member_ads') }}</h5>
                        <a href="{{ route('admin.ads', ['member_id' => $member->id]) }}" class="btn btn-light btn-sm">
                            <i class="bi bi-plus"></i> {{ __('keywords.add_ad') }}
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mb-0">
                                <thead>
                                <tr>
                                    <th>{{ __('keywords.ad_title') }}</th>
                                    <th class="text-end">{{ __('keywords.actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($ads as $ad)
                                    <tr>
                                        <td>{{ $ad->title }}</td>
                                        <td class="text-end">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.ads.show', $ad->id) }}" class="btn btn-info btn-sm">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <form action="{{ route('admin.ads.destroy', $ad->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('{{ __('keywords.confirm_delete') }}')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center py-3">
                                            {{ __('keywords.no_ads_found') }}
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
