@extends('admin.master')

@section('title', __('keywords.categories'))

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="h5 page-title">{{ __('keywords.filter_categories') }}</h2>

                <!-- Form to Filter Categories by Section -->
                <div class="card shadow">
                    <div class="card-body">
                        <form action="{{ route('admin.categories.filter') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <!-- Dropdown to select a section -->
                            <div class="mt-4">
                                <label for="section_id" class="form-label">{{ __('keywords.sections') }}</label>
                                <select class="form-control" name="section_id" id="section_id">
                                    <option value="">{{ __('keywords.select_section') }}</option>
                                    @foreach($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                                    @endforeach
                                </select>
                                <x-validation-error field="section_id"></x-validation-error>
                            </div>

                            <x-submit-button></x-submit-button>
                        </form>
                    </div>
                </div>

                <h2 class="h5 page-title" style="margin-top: 30px">{{ __('keywords.add_new_category') }}</h2>
                <!-- Form to Add a New Category with Section Selected -->
                <div class="card shadow mt-4">
                    <div class="card-body">
                        <form action="{{ route('admin.categories.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <!-- Dropdown to select section for the new category -->
                            <div class="mt-4">
                                <label for="new_section_id" class="form-label">{{ __('keywords.select_section') }}</label>
                                <select class="form-control" name="section_id" id="new_section_id">
                                    <option value="">{{ __('keywords.select_section') }}</option>
                                    @foreach($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                                    @endforeach
                                </select>
                                <x-validation-error field="section_id"></x-validation-error>
                            </div>

                            <!-- Category Name Input -->
                            <div class="mt-4">
                                <label for="category_name" class="form-label">{{ __('keywords.category_name') }}</label>
                                <input type="text" name="name" id="category_name" class="form-control" placeholder="{{ __('keywords.enter_category_name') }}" required>
                                <x-validation-error field="name"></x-validation-error>
                            </div>

                            <x-submit-button>{{ __('keywords.add_category') }}</x-submit-button>
                        </form>
                    </div>
                </div>

                <!-- Display All Categories with Show and Delete Options -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('keywords.all_categories') }}</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>{{ __('keywords.categories') }}</th>
                                <th class="d-flex justify-content-end">{{ __('keywords.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td class="d-flex justify-content-end">
                                        <!-- Show Category Button -->
                                        <a href="{{ route('admin.categories.show', $category->id) }}" class="btn btn-info btn-sm me-2" style="display:inline;margin-right:5px; width: 55px; height: 25px; text-align: center;">
                                            {{ __('keywords.show') }}
                                        </a>

                                        <!-- Delete Category Button -->
                                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('keywords.confirm_delete') }}')" style="display:inline; width: 55px; height: 25px; text-align: center;">
                                                {{ __('keywords.delete') }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- End of all categories list -->
            </div>
        </div>
    </div>
@endsection
