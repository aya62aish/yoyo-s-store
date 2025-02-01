@extends('admin.master')

@section('title', __('keywords.ads'))

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="h5 page-title">{{ __('keywords.filter_ads') }}</h2>

                <!-- Filter Ads Modal Trigger -->
                <div class="d-flex justify-content-end mb-3">
                    <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#filterAdsModal">
                        <i class="fas fa-filter"></i> {{ __('keywords.filter_ads') }}
                    </button>
                </div>

                <!-- Filter Ads Modal -->
                <div class="modal fade" id="filterAdsModal" tabindex="-1" aria-labelledby="filterAdsModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title" id="filterAdsModalLabel">{{ __('keywords.filter_ads') }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.ads.filter') }}" method="post" enctype="multipart/form-data">
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

                                    <!-- Member Dropdown -->
                                    <div class="mb-3">
                                        <label for="filter_member_id" class="form-label">{{ __('keywords.select_member') }}</label>
                                        <select class="form-control" name="member_id" id="filter_member_id" required>
                                            <option value="">{{ __('keywords.select_member') }}</option>
                                            <!-- Members populated via JavaScript -->
                                        </select>
                                        <x-validation-error field="member_id"></x-validation-error>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">{{ __('keywords.filter') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Display All Ads -->
                <div class="card mt-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h3 class="card-title mb-0">{{ __('keywords.ads') }}</h3>
                        <div class="card-actions">
                            <!-- Add Ad Modal Trigger Button -->
                            <button class="btn btn-icon btn-outline-success" data-bs-toggle="modal" data-bs-target="#addAdModal">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered card-table table-vcenter text-nowrap datatable"  style="font-size: 12px;">
                                <thead class="thead-dark">
                                <tr>
                                    <th class="text-center">{{ __('keywords.ad_title') }}</th>
                                    <th class="text-center">{{ __('keywords.image') }}</th>
                                    <th class="text-center">{{ __('keywords.member') }}</th>
                                    <th class="text-center">{{ __('keywords.discount') }}</th>
                                    <th class="text-center">{{ __('keywords.status') }}</th>
                                    <th class="text-center">{{ __('keywords.actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ads as $ad)
                                    <tr>
                                        <!-- Ad Title -->
                                        <td class="text-center">{{ $ad->title }}</td>

                                        <!-- Ad Icon -->
                                        <td class="text-center">
                                            <img src="{{"/". $ad->image }}" alt="Ad Icon" style="width: 40px; height: 40px;" class="rounded">
                                        </td>

                                        <!-- Member Name -->
                                        <td class="text-center">{{ $ad->member->name ?? __('keywords.unknown_member') }}</td>

                                        <!-- Discount -->
                                        <td class="text-center">{{ $ad->discount ?? 0 }}%</td>
                                        <!-- type -->
                                        <td class="text-center">{{ $ad->status  }}</td>

                                        <!-- Actions -->
                                        <td class="text-center">
                                            <!-- Show Ad Button -->
                                            <a href="{{ route('admin.ads.show', $ad->id) }}" class="btn btn-info btn-sm me-2" title="{{ __('keywords.show') }}">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <!-- Edit Ad Button -->
                                            <a href="#" class="btn btn-warning btn-sm me-2" data-bs-toggle="modal" data-bs-target="#editAdModal-{{ $ad->id }}" title="{{ __('keywords.edit') }}">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <!-- Edit Ad Modal -->
                                            <div class="modal fade" id="editAdModal-{{ $ad->id }}" tabindex="-1" aria-labelledby="editAdModalLabel-{{ $ad->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-warning text-white">
                                                            <h5 class="modal-title" id="editAdModalLabel-{{ $ad->id }}">{{ __('keywords.edit_ad') }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('admin.ads.edit', $ad->id) }}" method="post" enctype="multipart/form-data" class="row g-3">
                                                                @csrf
                                                                @method('PUT')

                                                                <!-- Section and Category Selection -->
                                                                <div class="col-md-6">
                                                                    <label for="section_id_edit_{{ $ad->id }}" class="form-label fw-bold">{{ __('keywords.select_section') }}</label>
                                                                    <select class="form-control" name="section_id" id="section_id_edit_{{ $ad->id }}" data-ad-id="{{ $ad->id }}" required>
                                                                        <option value="">{{ __('keywords.select_section') }}</option>
                                                                        @foreach($sections as $section)
                                                                            <option value="{{ $section->id }}" {{ $ad->member->category->section_id == $section->id ? 'selected' : '' }}>
                                                                                {{ $section->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    <x-validation-error field="section_id"></x-validation-error>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label for="category_id_edit_{{ $ad->id }}" class="form-label fw-bold">{{ __('keywords.select_category') }}</label>
                                                                    <select class="form-control" name="category_id" id="category_id_edit_{{ $ad->id }}" required>
                                                                        <option value="">{{ __('keywords.select_category') }}</option>
                                                                        @foreach(\App\Models\Category::where('section_id', $ad->member->category->section_id)->get() as $category)
                                                                            <option value="{{ $category->id }}" {{ $ad->member->category_id == $category->id ? 'selected' : '' }}>
                                                                                {{ $category->name }}
                                                                            </option>
                                                                        @endforeach
                                                                        <!-- Categories will be populated via JavaScript -->
                                                                    </select>
                                                                    <x-validation-error field="category_id"></x-validation-error>
                                                                </div>

                                                                <!-- Member Selection and Status -->
                                                                <div class="col-md-6">
                                                                    <label for="member_id_edit_{{ $ad->id }}" class="form-label fw-bold">{{ __('keywords.select_member') }}</label>
                                                                    <select class="form-control" name="member_id" id="member_id_edit_{{ $ad->id }}" required>
                                                                        <option value="">{{ __('keywords.select_member') }}</option>
                                                                        @foreach(\App\Models\member::where('category_id', $ad->member->category_id)->get() as $member)
                                                                            <option value="{{ $member->id }}" {{ $ad->member_id == $member->id ? 'selected' : '' }}>
                                                                                {{ $member->name }}
                                                                            </option>
                                                                        @endforeach
                                                                        <!-- Members will be populated via JavaScript -->
                                                                    </select>
                                                                    <x-validation-error field="member_id"></x-validation-error>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label for="status_edit_{{ $ad->id }}" class="form-label fw-bold">{{ __('keywords.select_status') }}</label>
                                                                    <select class="form-control" name="status" id="status_edit_{{ $ad->id }}" required>
                                                                        <option value="normal" {{ $ad->status == 'normal' ? 'selected' : '' }}>{{ __('keywords.ad_normal') }}</option>
                                                                        <option value="top" {{ $ad->status == 'top' ? 'selected' : '' }}>{{ __('keywords.ad_top') }}</option>
                                                                    </select>
                                                                    <x-validation-error field="status"></x-validation-error>
                                                                </div>

                                                                <!-- Ad Title and Discount -->
                                                                <div class="col-md-6">
                                                                    <label for="ad_title_edit_{{ $ad->id }}" class="form-label fw-bold">{{ __('keywords.ad_title') }}</label>
                                                                    <input type="text" name="title" id="ad_title_edit_{{ $ad->id }}" class="form-control" value="{{ $ad->title }}" placeholder="{{ __('keywords.enter_ad_title') }}" required>
                                                                    <x-validation-error field="title"></x-validation-error>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label for="discount_edit_{{ $ad->id }}" class="form-label fw-bold">{{ __('keywords.discount') }}</label>
                                                                    <input type="number" name="discount" id="discount_edit_{{ $ad->id }}" class="form-control" value="{{ $ad->discount }}" placeholder="{{ __('keywords.enter_discount') }}" min="0" max="100" required>
                                                                    <x-validation-error field="discount"></x-validation-error>
                                                                </div>

                                                                <!-- Ad Description -->
                                                                <div class="col-md-12">
                                                                    <label for="ad_description_edit_{{ $ad->id }}" class="form-label fw-bold">{{ __('keywords.ad_description') }}</label>
                                                                    <textarea name="description" id="ad_description_edit_{{ $ad->id }}" class="form-control" placeholder="{{ __('keywords.enter_ad_description') }}" rows="3" required>{{ $ad->description }}</textarea>
                                                                    <x-validation-error field="description"></x-validation-error>
                                                                </div>

                                                                <!-- Image Upload Field with Preview for Edit Modal -->
                                                                <div class="col-md-6">
                                                                    <label class="form-label fw-bold">{{ __('keywords.upload_image') }}</label>
                                                                    <div class="d-flex align-items-center">
                                                                        <label class="btn btn-outline-warning me-3" for="image_upload_edit_{{ $ad->id }}">
                                                                            <i class="bi bi-upload me-2"></i> {{ __('keywords.choose_image') }}
                                                                        </label>
                                                                        <input type="file" name="image_upload" id="image_upload_edit_{{ $ad->id }}" class="d-none" accept="image/*" onchange="previewImage(event, 'image_preview_edit_{{ $ad->id }}')" >
                                                                    </div>
                                                                    <div class="mt-3">
                                                                        <img id="image_preview_edit_{{ $ad->id }}" src="{{ $ad->image ? asset($ad->image) : 'https://via.placeholder.com/150' }}"
                                                                             alt="Image Preview" class="img-thumbnail" style="max-width: 100%; height: auto;">
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
                                            <!-- Delete Ad Button -->
                                            <form action="{{ route('admin.ads.destroy', $ad->id) }}" method="POST" style="display:inline;">
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
                <!-- End of Ads List -->

            </div>
        </div>
    </div>

    <!-- Add Ad Modal -->
    <div class="modal fade" id="addAdModal" tabindex="-1" aria-labelledby="addAdModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="addAdModalLabel">{{ __('keywords.add_new_ad') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.ads.store') }}" method="post" enctype="multipart/form-data" class="row g-3">
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

                        <!-- Member Selection and Status -->
                        <div class="col-md-6">
                            <label for="member_id" class="form-label fw-bold">{{ __('keywords.select_member') }}</label>
                            <select class="form-control" name="member_id" id="member_id_2" required>
                                <option value="">{{ __('keywords.select_member') }}</option>
                                <!-- Members populated via JavaScript -->
                            </select>
                            <x-validation-error field="member_id"></x-validation-error>
                        </div>

                        <div class="col-md-6">
                            <label for="status" class="form-label fw-bold">{{ __('keywords.select_status') }}</label>
                            <select class="form-control" name="status" id="status" required>
                                <option value="normal">{{ __('keywords.ad_normal') }}</option>
                                <option value="top">{{ __('keywords.ad_top') }}</option>
                            </select>
                            <x-validation-error field="status"></x-validation-error>
                        </div>

                        <!-- Ad Title and Discount -->
                        <div class="col-md-6">
                            <label for="ad_title" class="form-label fw-bold">{{ __('keywords.ad_title') }}</label>
                            <input type="text" name="title" id="ad_title" class="form-control" placeholder="{{ __('keywords.enter_ad_title') }}" required>
                            <x-validation-error field="title"></x-validation-error>
                        </div>

                        <div class="col-md-6">
                            <label for="discount" class="form-label fw-bold">{{ __('keywords.discount') }}</label>
                            <input type="number" name="discount" id="discount" class="form-control" placeholder="{{ __('keywords.enter_discount') }}" min="0" max="100" required>
                            <x-validation-error field="discount"></x-validation-error>
                        </div>

                        <!-- Ad Description -->
                        <div class="col-md-12">
                            <label for="ad_description" class="form-label fw-bold">{{ __('keywords.ad_description') }}</label>
                            <textarea name="description" id="ad_description" class="form-control" placeholder="{{ __('keywords.enter_ad_description') }}" rows="3" required></textarea>
                            <x-validation-error field="description"></x-validation-error>
                        </div>

                        <!-- Image Upload Field with Preview for Add Modal -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold">{{ __('keywords.upload_image') }}</label>
                            <div class="d-flex align-items-center">
                                <label class="btn btn-outline-success me-3" for="image_upload">
                                    <i class="bi bi-upload me-2"></i> {{ __('keywords.choose_image') }}
                                </label>
                                <input type="file" name="image_upload" id="image_upload" class="d-none" accept="image/*" onchange="previewImage(event, 'image_preview')" required>
                            </div>
                            <div class="mt-3">
                                <img id="image_preview" src="https://via.placeholder.com/150" alt="Image Preview" class="img-thumbnail d-none" style="max-width: 100%; height: auto;" required>
                            </div>
                        </div>


                        <!-- Submit Button -->
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-success">{{ __('keywords.add_ad') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Preview image function for dynamic previews
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
        // Helper function to populate category dropdown based on section
        function setupCategoryDropdown(sectionDropdown, categoryDropdown) {
            sectionDropdown.addEventListener('change', function () {
                const sectionId = this.value;

                // Clear existing options
                categoryDropdown.innerHTML = `<option value="">{{ __('keywords.select_category') }}</option>`;

                if (sectionId) {
                    fetch(`/categories/${sectionId}`)
                        .then(response => response.json())
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

        // Helper function to populate member dropdown based on category
        function setupMemberDropdown(categoryDropdown, memberDropdown) {
            categoryDropdown.addEventListener('change', function () {
                const categoryId = this.value;

                // Clear existing options
                memberDropdown.innerHTML = `<option value="">{{ __('keywords.select_member') }}</option>`;

                if (categoryId) {
                    fetch(`/members/${categoryId}`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(member => {
                                const option = document.createElement('option');
                                option.value = member.id;
                                option.textContent = member.name;
                                memberDropdown.appendChild(option);
                            });
                        })
                        .catch(error => console.error('Error fetching members:', error));
                }
            });
        }

        // Setup for Filter Modal
        const filterSectionDropdown = document.getElementById('filter_section_id');
        const filterCategoryDropdown = document.getElementById('filter_category_id');
        const filterMemberDropdown = document.getElementById('filter_member_id');
        if (filterSectionDropdown && filterCategoryDropdown) {
            setupCategoryDropdown(filterSectionDropdown, filterCategoryDropdown);
        }
        if (filterCategoryDropdown && filterMemberDropdown) {
            setupMemberDropdown(filterCategoryDropdown, filterMemberDropdown);
        }

        // Setup for Add Modal
        const addSectionDropdown = document.getElementById('section_id');
        const addCategoryDropdown = document.getElementById('category_id_2');
        const addMemberDropdown = document.getElementById('member_id_2');
        if (addSectionDropdown && addCategoryDropdown) {
            setupCategoryDropdown(addSectionDropdown, addCategoryDropdown);
        }
        if (addCategoryDropdown && addMemberDropdown) {
            setupMemberDropdown(addCategoryDropdown, addMemberDropdown);
        }

        // Setup for Edit Modals
        document.querySelectorAll('[id^="section_id_edit_"]').forEach(sectionDropdown => {
            const memberId = sectionDropdown.id.replace('section_id_edit_', '');
            const categoryDropdown = document.getElementById(`category_id_edit_${memberId}`);
            const memberDropdown = document.getElementById(`member_id_edit_${memberId}`);

            if (categoryDropdown) {
                setupCategoryDropdown(sectionDropdown, categoryDropdown);
            }
            if (categoryDropdown && memberDropdown) {
                setupMemberDropdown(categoryDropdown, memberDropdown);
            }
        });
    });
</script>
@endsection