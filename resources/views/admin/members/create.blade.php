@extends('admin.master')

@section('title', __('keywords.members'))

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="h5 page-title">{{ __('keywords.filter_members') }}</h2>

                <!-- Filter Members Modal Trigger -->
                <div class="d-flex justify-content-end mb-3">
                    <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#filterMembersModal">
                        <i class="fas fa-filter"></i> {{ __('keywords.filter_members') }}
                    </button>
                </div>

                <!-- Filter Members Modal -->
                <div class="modal fade" id="filterMembersModal" tabindex="-1" aria-labelledby="filterMembersModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title" id="filterMembersModalLabel">{{ __('keywords.filter_members') }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.members.filter') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <!-- Section Dropdown -->
                                    <div class="mb-3">
                                        <label for="filter_section_id" class="form-label">{{ __('keywords.select_section') }}</label>
                                        <select class="form-control" name="section_id" id="filter_section_id" required>
                                            <option value="">{{ __('keywords.select_section') }}</option>
                                            @foreach($sections as $section)
                                                <option value="{{ $section->id }}">{{ $section->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-validation-error field="section_id"></x-validation-error>
                                    </div>

                                    <!-- Category Dropdown -->
                                    <div class="mb-3">
                                        <label for="filter_category_id" class="form-label">{{ __('keywords.select_category') }}</label>
                                        <select class="form-control" name="category_id" id="filter_category_id" required>
                                            <option value="">{{ __('keywords.select_category') }}</option>
                                            <!-- Categories populated via JavaScript -->
                                        </select>
                                        <x-validation-error field="category_id"></x-validation-error>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">{{ __('keywords.filter') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add Member Modal Trigger -->
                <div class="card shadow mt-4">
                    <!-- Add Member Modal -->
                    <div class="modal fade" id="addMemberModal" tabindex="-1" aria-labelledby="addMemberModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-success text-white">
                                    <h5 class="modal-title" id="addMemberModalLabel">{{ __('keywords.add_new_member') }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin.members.store') }}" method="post" enctype="multipart/form-data" class="row g-3">
                                        @csrf

                                        <!-- Section and Category Selection -->
                                        <div class="col-md-6">
                                            <label for="section_id" class="form-label fw-bold">{{ __('keywords.select_section') }}</label>
                                            <select class="form-control" name="section_id" id="section_id" required>
                                                <option value="">{{ __('keywords.select_section') }}</option>
                                                @foreach($sections as $section)
                                                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                                                @endforeach
                                            </select>
                                            <x-validation-error field="section_id"></x-validation-error>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="category_id" class="form-label fw-bold">{{ __('keywords.select_category') }}</label>
                                            <select class="form-control" name="category_id" id="category_id_2" required>
                                                <option value="">{{ __('keywords.select_category') }}</option>
                                                <!-- Categories populated via JavaScript -->
                                            </select>
                                            <x-validation-error field="category_id"></x-validation-error>
                                        </div>

                                        <!-- Member Details -->
                                        <div class="col-md-6">
                                            <label for="member_name" class="form-label fw-bold">{{ __('keywords.member_name') }}</label>
                                            <input type="text" name="name" id="member_name" class="form-control" placeholder="{{ __('keywords.enter_member_name') }}" required>
                                            <x-validation-error field="name"></x-validation-error>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="location" class="form-label fw-bold">{{ __('keywords.member_location') }}</label>
                                            <input type="text" name="location" id="location" class="form-control" placeholder="{{ __('keywords.enter_location') }}" required>
                                            <x-validation-error field="location"></x-validation-error>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="phone" class="form-label fw-bold">{{ __('keywords.member_phone') }}</label>
                                            <input type="text" name="phone" id="phone" class="form-control" placeholder="{{ __('keywords.enter_phone') }}" required>
                                            <x-validation-error field="phone"></x-validation-error>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="whatsapp" class="form-label fw-bold">{{ __('keywords.member_whatsapp') }}</label>
                                            <input type="text" name="whatsapp" id="whatsapp" class="form-control" placeholder="{{ __('keywords.enter_whatsapp') }}" required>
                                            <x-validation-error field="whatsapp"></x-validation-error>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="facebook" class="form-label fw-bold">{{ __('keywords.member_facebook') }}</label>
                                            <input type="text" name="facebook" id="facebook" class="form-control" placeholder="{{ __('keywords.enter_facebook') }}" required>
                                            <x-validation-error field="facebook"></x-validation-error>
                                        </div>

                                        <!-- Logo Upload Field with Preview -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">{{ __('keywords.upload_logo') }}</label>
                                            <div class="d-flex align-items-center">
                                                <label class="btn btn-outline-success me-3" for="logo_upload">
                                                    <i class="bi bi-upload me-2"></i> {{ __('keywords.choose_logo') }}
                                                </label>
                                                <input type="file" name="logo" id="logo_upload" class="d-none" accept="image/*" onchange="previewImage(event, 'logo_preview')" required>
                                            </div>
                                            <div class="mt-3">
                                                <img id="logo_preview" src="https://via.placeholder.com/150" alt="Logo Preview" class="img-thumbnail d-none" style="max-width: 100%; height: auto;">
                                            </div>
                                        </div>

                                        <!-- Cover Upload Field with Preview -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">{{ __('keywords.upload_cover') }}</label>
                                            <div class="d-flex align-items-center">
                                                <label class="btn btn-outline-success me-3" for="cover_upload">
                                                    <i class="bi bi-upload me-2"></i> {{ __('keywords.choose_cover') }}
                                                </label>
                                                <input type="file" name="cover" id="cover_upload" class="d-none" accept="image/*" onchange="previewImage(event, 'cover_preview')" required>
                                            </div>
                                            <div class="mt-3">
                                                <img id="cover_preview" src="https://via.placeholder.com/150" alt="Cover Preview" class="img-thumbnail d-none" style="max-width: 100%; height: auto;">
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-success">{{ __('keywords.add_member') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Display All Members -->
                <div class="card mt-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h3 class="card-title mb-0">{{ __('keywords.members') }}</h3>
                        <div class="card-actions">
                            <a href="#" class="btn btn-icon btn-outline-success" data-bs-toggle="modal" data-bs-target="#addMemberModal">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered card-table table-vcenter text-nowrap datatable" style="font-size: 12px;">
                                <thead class="thead-dark">
                                <tr>
                                    <th class="text-center">{{ __('keywords.member_name') }}</th>
                                    <th class="text-center">{{ __('keywords.member_logo') }}</th>
                                    <th class="text-center">{{ __('keywords.member_category') }}</th>
                                    <th class="text-center">{{ __('keywords.member_section') }}</th>
                                    <th class="text-center">{{ __('keywords.actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($members as $member)
                                    <tr>
                                        <td class="text-center">{{ $member->name }}</td>
                                        <td class="text-center"><img src="{{ "/".$member->icon }}" style="width: 50px; height: 40px"></td>
                                        @php
                                            $x =\App\Models\category::find($member->category_id)
                                        @endphp
                                        <td class="text-center">{{$x->name}}</td>
                                        <td class="text-center">{{ \App\Models\section::find($x->section_id)->name}}</td>
                                        <td class="text-center">
                                            <!-- Show Member Button -->
                                            <a href="{{ route('admin.members.show', $member->id) }}" class="btn btn-info btn-sm me-2" title="{{ __('keywords.show') }}">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <!-- Edit Member Button -->
                                            <a href="#" class="btn btn-warning btn-sm me-2" data-bs-toggle="modal" data-bs-target="#editMemberModal-{{ $member->id }}" title="{{ __('keywords.edit') }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <!-- Edit Member Modal -->
                                            <div class="modal fade" id="editMemberModal-{{ $member->id }}" tabindex="-1" aria-labelledby="editMemberModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-warning text-white">
                                                            <h5 class="modal-title" id="editMemberModalLabel">{{ __('keywords.edit_member') }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('admin.members.update', $member->id) }}" method="post" enctype="multipart/form-data" class="row g-3">
                                                                @csrf
                                                                @method('PUT')

                                                                <!-- Section and Category Selection -->
 <div class="col-md-6">
                                                                    <label for="section_id_edit_{{ $member->id }}" class="form-label fw-bold">{{ __('keywords.select_section') }}</label>
                                                                    <select class="form-control section-dropdown" name="section_id" id="section_id_edit_{{ $member->id }}" data-member-id="{{ $member->id }}" required>
                                                                        <option value="">{{ __('keywords.select_section') }}</option>
                                                                        @foreach($sections as $section)
                                                                            <option value="{{ $section->id }}" {{ $member->category->section_id == $section->id ? 'selected' : '' }}>
                                                                                {{ $section->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    <x-validation-error field="section_id"></x-validation-error>
                                                                </div>

                                                              <div class="col-md-6">
    <label for="category_id_edit_{{ $member->id }}" class="form-label fw-bold">{{ __('keywords.select_category') }}</label>
    <select class="form-control" name="category_id" id="category_id_edit_{{ $member->id }}" required>
        <option value="">{{ __('keywords.select_category') }}</option>
        @foreach(\App\Models\Category::where('section_id', $member->category->section_id)->get() as $category)
            <option value="{{ $category->id }}" {{ $member->category_id == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    <x-validation-error field="category_id"></x-validation-error>
</div>


                                                                <!-- Member Details -->
                                                                <div class="col-md-6">
                                                                    <label for="member_name_edit_{{ $member->id }}" class="form-label fw-bold">{{ __('keywords.member_name') }}</label>
                                                                    <input type="text" name="name" id="member_name_edit_{{ $member->id }}" class="form-control" value="{{ $member->name }}" placeholder="{{ __('keywords.enter_member_name') }}" required>
                                                                    <x-validation-error field="name"></x-validation-error>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label for="location_edit_{{ $member->id }}" class="form-label fw-bold">{{ __('keywords.member_location') }}</label>
                                                                    <input type="text" name="location" id="location_edit_{{ $member->id }}" class="form-control" value="{{ $member->location }}" placeholder="{{ __('keywords.enter_location') }}" required>
                                                                    <x-validation-error field="location"></x-validation-error>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label for="phone_edit_{{ $member->id }}" class="form-label fw-bold">{{ __('keywords.member_phone') }}</label>
                                                                    <input type="text" name="phone" id="phone_edit_{{ $member->id }}" class="form-control" value="{{ $member->phone }}" placeholder="{{ __('keywords.enter_phone') }}" required>
                                                                    <x-validation-error field="phone"></x-validation-error>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label for="whatsapp_edit_{{ $member->id }}" class="form-label fw-bold">{{ __('keywords.member_whatsapp') }}</label>
                                                                    <input type="text" name="whatsapp" id="whatsapp_edit_{{ $member->id }}" class="form-control" value="{{ $member->whatsapp }}" placeholder="{{ __('keywords.enter_whatsapp') }}" required>
                                                                    <x-validation-error field="whatsapp"></x-validation-error>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <label for="facebook_edit_{{ $member->id }}" class="form-label fw-bold">{{ __('keywords.member_facebook') }}</label>
                                                                    <input type="text" name="facebook" id="facebook_edit_{{ $member->id }}" class="form-control" value="{{ $member->facebook }}" placeholder="{{ __('keywords.enter_facebook') }}" required>
                                                                    <x-validation-error field="facebook"></x-validation-error>
                                                                </div>

                                                                <!-- Logo Upload Field with Preview -->
                                                                <div class="col-md-6">
                                                                    <label class="form-label fw-bold">{{ __('keywords.upload_logo') }}</label>
                                                                    <div class="d-flex align-items-center">
                                                                        <label class="btn btn-outline-warning me-3" for="logo_upload_edit_{{ $member->id }}">
                                                                            <i class="bi bi-upload me-2"></i> {{ __('keywords.choose_logo') }}
                                                                        </label>
                                                                        <input type="file" name="logo" id="logo_upload_edit_{{ $member->id }}" class="d-none" accept="image/*" onchange="previewImage(event, 'logo_preview_edit_{{ $member->id }}')">
                                                                    </div>
                                                                    <div class="mt-3">
                                                                        <img id="logo_preview_edit_{{ $member->id }}" src="{{ $member->icon ? asset($member->icon) : 'https://via.placeholder.com/150' }}"
                                                                             alt="Logo Preview" class="img-thumbnail" style="max-width: 100%; height: auto;">
                                                                    </div>
                                                                </div>

                                                                <!-- Cover Upload Field with Preview -->
                                                                <div class="col-md-6">
                                                                    <label class="form-label fw-bold">{{ __('keywords.upload_cover') }}</label>
                                                                    <div class="d-flex align-items-center">
                                                                        <label class="btn btn-outline-warning me-3" for="cover_upload_edit_{{ $member->id }}">
                                                                            <i class="bi bi-upload me-2"></i> {{ __('keywords.choose_cover') }}
                                                                        </label>
                                                                        <input type="file" name="cover" id="cover_upload_edit_{{ $member->id }}" class="d-none" accept="image/*" onchange="previewImage(event, 'cover_preview_edit_{{ $member->id }}')">
                                                                    </div>
                                                                    <div class="mt-3">
                                                                        <img id="cover_preview_edit_{{ $member->id }}" src="{{ $member->cover ? asset($member->cover) : 'https://via.placeholder.com/150' }}"
                                                                             alt="Cover Preview" class="img-thumbnail" style="max-width: 100%; height: auto;">
                                                                    </div>
                                                                </div>

                                                                <!-- Submit Button -->
                                                                <div class="col-12 d-flex justify-content-end">
                                                                    <button type="submit" class="btn btn-warning">{{ __('keywords.save_changes') }}</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Delete Member Button -->
                                            <form action="{{ route('admin.members.destroy', $member->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('keywords.confirm_delete') }}')" title="{{ __('keywords.delete') }}">
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
                <!-- End of Members List -->

            </div>
        </div>
    </div>
@endsection

<script>
    function previewImage(event, previewId) {
        const preview = document.getElementById(previewId);
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

    document.addEventListener('DOMContentLoaded', function () {
        // Function to setup category dropdowns
        function setupCategoryDropdown(sectionDropdown, categoryDropdown) {
            sectionDropdown.addEventListener('change', function () {
                const sectionId = this.value;

                // Clear existing options
                categoryDropdown.innerHTML = '<option value="">{{ __('keywords.select_category') }}</option>';

                if (sectionId) {
                    fetch(`/categories/${sectionId}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            data.forEach(category => {
                                const option = document.createElement('option');
                                option.value = category.id;
                                option.textContent = category.name;
                                categoryDropdown.appendChild(option);
                            });
                        })
                        .catch(error => console.error('Error fetching categories:', error));
                }
            });
        }

        // Setup for main dropdowns
        const mainSectionDropdown = document.getElementById('section_id');
        const mainCategoryDropdown = document.getElementById('category_id_2');
        if (mainSectionDropdown && mainCategoryDropdown) {
            setupCategoryDropdown(mainSectionDropdown, mainCategoryDropdown);
        }

        // Setup for filter dropdowns
        const filterSectionDropdown = document.getElementById('filter_section_id');
        const filterCategoryDropdown = document.getElementById('filter_category_id');
        if (filterSectionDropdown && filterCategoryDropdown) {
            setupCategoryDropdown(filterSectionDropdown, filterCategoryDropdown);
        }

        // Setup for edit member modals
        document.querySelectorAll('[id^="section_id_edit_"]').forEach(sectionDropdown => {
            const memberId = sectionDropdown.id.replace('section_id_edit_', '');
            const categoryDropdown = document.getElementById(`category_id_edit_${memberId}`);

            if (categoryDropdown) {
                setupCategoryDropdown(sectionDropdown, categoryDropdown);
            }
        });
    });
</script>
