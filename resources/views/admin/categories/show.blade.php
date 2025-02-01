@extends('admin.master')

@section('title', __('keywords.show_category'))

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">
            <!-- Return Back Button -->
            <a href="{{ route('admin.categories') }}" class="btn btn-outline-secondary mb-4">
                <i class="fas fa-arrow-left me-2"></i>{{ __('keywords.return_back') }}
            </a>

            <!-- Category Details Card -->
            <div class="card shadow-sm rounded-3 mb-4">
                <div class="card-header bg-light py-3">
                    <h5 class="mb-0 text-primary">{{ __('keywords.category_details') }}</h5>
                </div>
                
                <div class="card-body">
                    <div class="row g-4">
                        <!-- Category Name -->
                        <div class="col-md-6">
                            <div class="p-4 bg-light rounded-3">
                                <label class="text-muted small text-uppercase">{{ __('keywords.category_name') }}</label>
                                <h4 class="mb-0 mt-1">{{ $category->name }}</h4>
                            </div>
                        </div>

                        <!-- Section Name -->
                        <div class="col-md-6">
                            <div class="p-4 bg-light rounded-3">
                                <label class="text-muted small text-uppercase">{{ __('keywords.section') }}</label>
                                <h4 class="mb-0 mt-1">{{ \App\Models\section::find($category->section_id)->name }}</h4>
                            </div>
                        </div>

                        <!-- Category Icon -->
                        <div class="col-md-6">
                            <div class="p-4 bg-light rounded-3 text-center">
                                <label class="text-muted small text-uppercase d-block mb-3">{{ __('keywords.icon') }}</label>
                                @if($category->icon)
                                    <img src="{{ asset($category->icon) }}" 
                                         alt="{{ $category->name }}" 
                                         class="img-thumbnail shadow-sm"
                                         style="width: 120px; height: 120px; object-fit: cover;">
                                @else
                                    <div class="text-muted">
                                        <i class="fas fa-image fa-3x mb-2"></i>
                                        <p class="mb-0">{{ __('keywords.no_icon_available') }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Members Card -->
            <div class="card shadow-sm rounded-3">
                <div class="card-header bg-light py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-primary">{{ __('keywords.members') }}</h5>
                    <span class="badge bg-primary">{{ $members->count() }} {{ __('keywords.total') }}</span>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="px-4">{{ __('keywords.member_name') }}</th>
                                    <th class="text-end px-4" width="150">{{ __('keywords.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($members as $member)
                                    <tr>
                                        <td class="px-4 py-3">{{ $member->name }}</td>
                                        <td class="text-end px-4 py-3">
                                            <!-- Show Member Button -->
                                            <a href="{{ route('admin.members.show', $member->id) }}" 
                                               class="btn btn-sm btn-outline-primary me-2" 
                                               title="{{ __('keywords.show') }}">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <!-- Delete Member Button -->
                                            <form action="{{ route('admin.members.destroy', $member->id) }}" 
                                                  method="POST" 
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-outline-danger" 
                                                        onclick="return confirm('{{ __('keywords.confirm_delete') }}')"
                                                        title="{{ __('keywords.delete') }}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center py-4 text-muted">
                                            <i class="fas fa-folder-open fa-2x mb-2"></i>
                                            <p class="mb-0">{{ __('keywords.no_members_found') }}</p>
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
