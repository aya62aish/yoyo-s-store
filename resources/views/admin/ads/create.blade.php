@extends('admin.master')

@section('title', __('keywords.add_new_service'))

@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="h5 page-title">{{ __('keywords.members') }}</h2>

                <!-- Form to Filter Categories by Section -->
                <div class="card shadow">
                    <div class="card-body">
                        <form action="{{ route('admin.ads.filter') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <!-- Dropdown to select section for the new category -->
                            <div class="mt-4">
                                <label for="new_section_id" class="form-label">{{ __('keywords.select_section') }}</label>
                                <select class="form-control" name="section_id" id="new_section_id">
                                    <option value="">{{ __('keywords.choose_section') }}</option>
                                    @foreach($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                                    @endforeach
                                </select>
                                <x-validation-error field="section_id"></x-validation-error>
                            </div>

                            <!-- Dropdown to select a category -->
                            <div class="mt-4">
                                <label for="category_id" class="form-label">{{ __('keywords.select_category') }}</label>
                                <select class="form-control" name="category_id" id="category_id">
                                    <option value="">{{ __('keywords.select_category') }}</option>
                                    <!-- Categories will be populated here via AJAX -->
                                </select>
                                <x-validation-error field="category_id"></x-validation-error>
                            </div>
                            <!-- Dropdown to select a member -->
                            <div class="mt-4">
                                <label for="category_id" class="form-label">{{ __('keywords.select_member') }}</label>
                                <select class="form-control" name="member_id" id="member_id">
                                    <option value="">{{ __('keywords.select_member') }}</option>
                                    <!-- member will be populated here via AJAX -->
                                </select>
                                <x-validation-error field="member_id1"></x-validation-error>
                            </div>
                            <x-submit-button></x-submit-button>
                        </form>
                    </div>
                </div>

                <!-- Form to Add a New ad with Section Selection -->
                <div class="card shadow mt-4">
                    <div class="card-body">
                        <form action="{{ route('admin.ads.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <!-- Dropdown to select section for the new category -->
                            <div class="mt-4">
                                <label for="new_section_id_2" class="form-label">{{ __('keywords.select_section') }}</label>
                                <select class="form-control" name="section_id" id="new_section_id_2">
                                    <option value="">{{ __('keywords.choose_section') }}</option>
                                    @foreach($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                                    @endforeach
                                </select>
                                <x-validation-error field="section_id"></x-validation-error>
                            </div>
                            <!-- Dropdown to select a category -->
                            <div class="mt-4">
                                <label for="category_id" class="form-label">{{ __('keywords.select_category') }}</label>
                                <select class="form-control" name="category_id" id="category_id_2">
                                    <option value="">{{ __('keywords.select_category') }}</option>
                                    <!-- Categories will be populated here via AJAX -->
                                </select>
                                <x-validation-error field="category_id_2"></x-validation-error>
                            </div>
                            <!-- Dropdown to select a member -->
                            <div class="mt-4">
                                <label for="category_id" class="form-label">{{ __('keywords.select_member') }}</label>
                                <select class="form-control" name="member_id" id="member_id_2">
                                    <option value="">{{ __('keywords.select_member') }}</option>
                                    <!-- member will be populated here via AJAX -->
                                </select>
                                <x-validation-error field="member_id"></x-validation-error>
                            </div>


                            <!-- ad Name Input -->
                            <div class="mt-4">
                                <label for="category_name" class="form-label">{{ __('keywords.ad_title') }}</label>
                                <input type="text" name="title" id="ad_title" class="form-control" placeholder="{{ __('keywords.enter_ad_title') }}" required>
                                <x-validation-error field="name"></x-validation-error>
                            </div>
                            <!-- ad description Input -->
                            <div class="mt-4">
                                <label for="category_name" class="form-label">{{ __('keywords.ad_description') }}</label>
                                <input type="text" name="description" id="ad_description" class="form-control" placeholder="{{ __('keywords.enter_ad_description') }}" required>
                                <x-validation-error field="name"></x-validation-error>
                            </div>
                            <!-- ad image Input -->


                            <!-- File upload field -->
                            <div class="form-group" id="upload_field">
                                <label for="image_upload">Upload Image</label>
                                <input type="file" name="image_upload" id="image_upload" class="form-control" required>
                            </div>
                            <!-- ad status Input -->
                            <div class="mt-4">
                                <label for="ads_status" class="form-label">{{ __('keywords.select_status') }}</label>
                                <select class="form-control" name="status" id="member_id_2">
                                    <option value="normal">{{ __('keywords.ad_normal') }}</option>
                                    <option value="top">{{ __('keywords.ad_top') }}</option>
                                </select>
                                <x-validation-error field="member_id"></x-validation-error>
                            </div>

                            <x-submit-button>{{ __('keywords.add_ad') }}</x-submit-button>

                        </form>
                    </div>
                </div>


                <!-- Display All members with Show and Delete Options -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('keywords.ads') }}</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>{{ __('keywords.ads') }}</th>
                                <th class="d-flex justify-content-end">{{ __('keywords.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ads as $ad)
                                <tr>
                                    <td>{{ $ad->title }}</td>
                                    <td class="d-flex justify-content-end">
                                        <!-- Show Category Button -->
                                        <a href="{{ route('admin.ads.show', $ad->id) }}" class="btn btn-info btn-sm me-2" style="display:inline;margin-right:5px; width: 55px; height: 25px; text-align: center;">
                                            {{ __('keywords.show') }}
                                        </a>

                                        <!-- Delete Category Button -->
                                        <form action="{{ route('admin.ads.destroy', $ad->id) }}" method="POST" style="display:inline;">
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
    <script>
        //ajax to get categories 1
        document.addEventListener('DOMContentLoaded', function () {
            const sectionDropdown = document.getElementById('new_section_id');
            const categoryDropdown = document.getElementById('category_id');

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
        });
        //ajax to get members 1
        document.addEventListener('DOMContentLoaded', function () {
            const sectionDropdown = document.getElementById('category_id');
            const categoryDropdown = document.getElementById('member_id');

            sectionDropdown.addEventListener('change', function () {
                const category_id = this.value;

                // Clear existing options
                categoryDropdown.innerHTML = '<option value="">{{ __('keywords.select_category') }}</option>';

                if (category_id) {
                    fetch(`/members/${category_id}`)
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
        });

        //ajax to get categories 2
        document.addEventListener('DOMContentLoaded', function () {
            const sectionDropdown = document.getElementById('new_section_id_2');
            const categoryDropdown = document.getElementById('category_id_2');

            sectionDropdown.addEventListener('change', function () {
                const sectionId = this.value;

                // Clear existing options
                categoryDropdown.innerHTML = '<option value="">{{ __('keywords.select_category') }}</option>';
                if (sectionId) {
                    fetch(`/categories2/${sectionId}`)
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
        });
        //ajax to get members2
        document.addEventListener('DOMContentLoaded', function () {
            const sectionDropdown = document.getElementById('category_id_2');
            const categoryDropdown = document.getElementById('member_id_2');

            sectionDropdown.addEventListener('change', function () {
                const category_id = this.value;

                // Clear existing options
                categoryDropdown.innerHTML = '<option value="">{{ __('keywords.select_category') }}</option>';

                if (category_id) {
                    fetch(`/members/${category_id}`)
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
        });


    </script>
