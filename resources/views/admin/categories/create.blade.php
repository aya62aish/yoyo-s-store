@extends('admin.master')

@section('title', __('keywords.categories'))

@section('content')
    <div class="container-xl">
        <!-- Filter Categories Modal Trigger -->
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#filterCategoriesModal">
                <i class="fas fa-filter"></i> {{ __('keywords.filter_categories') }}
            </button>
        </div>

        <!-- Filter Categories Modal -->
        <div class="modal fade" id="filterCategoriesModal" tabindex="-1" aria-labelledby="filterCategoriesModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="filterCategoriesModalLabel">{{ __('keywords.filter_categories') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.categories.filter') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="section_id" class="form-label">{{ __('keywords.sections') }}</label>
                                <select class="form-control" name="section_id" id="section_id" required>
                                    <option value="">{{ __('keywords.select_section') }}</option>
                                    @foreach($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                                    @endforeach
                                </select>
                                <x-validation-error field="section_id"></x-validation-error>
                            </div>
                            <div class="d-flex justify-content-end">
                                <x-submit-button></x-submit-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Category Modal Trigger -->
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="card-title mb-0">{{ __('keywords.categories') }}</h3>
                <div class="card-actions">
                    <a href="#" class="btn btn-icon btn-outline-success" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                        <i class="fas fa-plus"></i>
                    </a>
                </div>
            </div>

            <!-- Add Category Modal -->
            <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title" id="addCategoryModalLabel">{{ __('keywords.add_new_category') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.categories.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="new_section_id" class="form-label">{{ __('keywords.select_section') }}</label>
                                    <select class="form-control" name="section_id" id="new_section_id" required>
                                        <option value="">{{ __('keywords.select_section') }}</option>
                                        @foreach($sections as $section)
                                            <option value="{{ $section->id }}">{{ $section->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-validation-error field="section_id"></x-validation-error>
                                </div>

                                <div class="mb-3">
                                    <label for="category_name" class="form-label">{{ __('keywords.category_name') }}</label>
                                    <input type="text" name="name" id="category_name" class="form-control" required>
                                    <x-validation-error field="name"></x-validation-error>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">{{ __('keywords.upload_icon') }}</label>
                                    <div class="d-flex align-items-center">
                                        <label class="btn btn-outline-success me-3" for="icon_upload">
                                            <i class="bi bi-upload me-2"></i> {{ __('keywords.choose_icon') }}
                                        </label>
                                        <input type="file" name="icon" id="icon_upload" class="d-none" accept="image/*" onchange="previewNewIcon(event)" required>
                                    </div>
                                    <div class="mt-3">
                                        <img id="icon_preview_new" src="https://via.placeholder.com/150" alt="Icon Preview" class="img-thumbnail d-none" style="width: 50px; height: 50px;" required>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <x-submit-button>{{ __('keywords.add_category') }}</x-submit-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table of Categories -->
            <div class="table-responsive">
                <table class="table table-bordered card-table table-vcenter text-nowrap datatable">
                    <thead class="thead-dark">
                    <tr>
                        <th class="text-center">{{ __('keywords.name') }}</th>
                        <th class="text-center">{{ __('keywords.icon') }}</th>
                        <th class="text-center">{{ __('keywords.section') }}</th>
                        <th class="text-center">{{ __('keywords.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td class="text-center">{{ $category->name }}</td>
                            <td class="text-center"><img src="{{ '/' . $category->icon }}" height="40px" width="40px"></td>
                            <td class="text-center">{{ \App\Models\Section::where('id', $category->section_id)->first()->name }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.categories.show', $category->id) }}" class="btn btn-info btn-sm mr-2">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn btn-warning btn-sm mr-2" data-bs-toggle="modal" data-bs-target="#editCategoryModal"
                                   data-id="{{ $category->id }}" data-name="{{ $category->name }}" data-section-id="{{ $category->section_id }}"
                                   data-icon="{{ '/' . $category->icon }}" onclick="openEditCategoryModal(this)">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('keywords.confirm_delete') }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="editCategoryModalLabel">{{ __('keywords.edit_category') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editCategoryForm" action="#" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="category_name_edit" class="form-label">{{ __('keywords.category_name') }}</label>
                            <input type="text" name="name" id="category_name_edit" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="section_id_edit" class="form-label">{{ __('keywords.select_section') }}</label>
                            <select class="form-control" name="section_id" id="section_id_edit">
                                @foreach($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('keywords.upload_icon') }}</label>
                            <div class="d-flex align-items-center">
                                <label class="btn btn-outline-success me-3" for="icon_edit">
                                    <i class="bi bi-upload me-2"></i> {{ __('keywords.choose_icon') }}
                                </label>
                                <input type="file" name="icon" id="icon_edit" class="d-none" accept="image/*" onchange="previewEditIcon(event)">
                            </div>
                            <div class="mt-3">
                                <img id="icon_preview_edit" src="https://via.placeholder.com/150" alt="Icon Preview" class="img-thumbnail d-none" style="width: 50px; height: 50px;">
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-warning">{{ __('keywords.save_changes') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openEditCategoryModal(button) {
            const categoryId = button.getAttribute('data-id');
            const categoryName = button.getAttribute('data-name');
            const sectionId = button.getAttribute('data-section-id');
            const iconUrl = button.getAttribute('data-icon');

            const form = document.getElementById('editCategoryForm');
            form.action = `/categories/update/${categoryId}`;

            document.getElementById('category_name_edit').value = categoryName;
            document.getElementById('section_id_edit').value = sectionId;

            const iconPreview = document.getElementById('icon_preview_edit');
            iconPreview.src = iconUrl;
            iconPreview.classList.remove('d-none');
        }

        function previewEditIcon(event) {
            const preview = document.getElementById('icon_preview_edit');
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = () => {
                    preview.src = reader.result;
                    preview.classList.remove('d-none');
                };
                reader.readAsDataURL(file);
            }
        }

        function previewNewIcon(event) {
            const preview = document.getElementById('icon_preview_new');
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = () => {
                    preview.src = reader.result;
                    preview.classList.remove('d-none');
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
