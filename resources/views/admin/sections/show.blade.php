@extends('admin.master')

@section('title', __('keywords.show'))

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">
            <!-- Return Back Button -->
            <a href="{{ route('admin.sections') }}" class="btn btn-outline-secondary mb-4">
                <i class="fas fa-arrow-left me-2"></i>{{ __('keywords.return_back') }}
            </a>

            <!-- Section Details Card -->
            <div class="card shadow-sm rounded-3 mb-4">
                <div class="card-header bg-light py-3">
                    <h5 class="mb-0 text-primary">{{ __('keywords.section_details') }}</h5>
                </div>
                
                <div class="card-body">
                    <div class="row g-4">
                        <!-- Section Name -->
                        <div class="col-md-6">
                            <div class="p-4 bg-light rounded-3">
                                <label class="text-muted small text-uppercase">{{ __('keywords.title') }}</label>
                                <h4 class="mb-0 mt-1">{{ $section->name }}</h4>
                            </div>
                        </div>

                        <!-- Section Icon -->
                        <div class="col-md-6">
                            <div class="p-4 bg-light rounded-3 text-center">
                                <label class="text-muted small text-uppercase d-block mb-3">{{ __('keywords.icon') }}</label>
                                @if($section->icon)
                                    <img src="{{ asset($section->icon) }}" 
                                         alt="{{ $section->name }}" 
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

            <!-- Categories Card -->
            <div class="card shadow-sm rounded-3">
                <div class="card-header bg-light py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-primary">{{ __('keywords.categories') }}</h5>
                    <span class="badge bg-primary">{{ $categories->total() }} {{ __('keywords.total') }}</span>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="px-4">{{ __('keywords.category_name') }}</th>
                                    <th class="text-end px-4" width="150">{{ __('keywords.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $category)
                                    <tr>
                                        <td class="px-4 py-3">{{ $category->name }}</td>
                                        <td class="text-end px-4 py-3">
                                            <a href="{{ route('admin.categories.show', $category->id) }}" 
                                               class="btn btn-sm btn-outline-primary me-2" 
                                               title="{{ __('keywords.show') }}">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <form action="{{ route('admin.categories.destroy', $category->id) }}" 
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
                                            <p class="mb-0">{{ __('keywords.no_categories_found') }}</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($categories->hasPages())
                        <div class="d-flex justify-content-center border-top p-4">
                            {{ $categories->links('pagination::bootstrap-4') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection