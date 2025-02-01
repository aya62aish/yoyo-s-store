@extends('admin.master')

@section('title', __('keywords.add_new_service'))

@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="h5 page-title">{{ __('keywords.filter_members') }}</h2>

                <!-- Form to Filter Members by Category and Section-->
                <div class="card shadow">
                    <div class="card-body">
                        <form action="{{ route('admin.members.filter') }}" method="post" enctype="multipart/form-data">
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

                            <!-- Dropdown to select a category -->
                            <div class="mt-4">
                                <label for="category_id" class="form-label">{{ __('keywords.select_category') }}</label>
                                <select class="form-control" name="category_id" id="category_id">
                                    <option value="">{{ __('keywords.select_category') }}</option>
                                    <!-- Categories will be populated here via AJAX -->
                                </select>
                                <x-validation-error field="category_id"></x-validation-error>
                            </div>

                            <x-submit-button></x-submit-button>
                        </form>
                    </div>
                </div>

                <!-- Form to Add a New member with Section and category Selection -->
                <div class="card shadow mt-4">
                    <div class="card-body">
                        <form action="{{ route('admin.members.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <!-- Dropdown to select section for the new category -->
                            <div class="mt-4">
                                <label for="new_section_id_2" class="form-label">{{ __('keywords.select_section') }}</label>
                                <select class="form-control" name="section_id" id="new_section_id_2">
                                    <option value="">{{ __('keywords.select_section') }}</option>
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

                            <!-- member Name Input -->
                            <div class="mt-4">
                                <label for="category_name" class="form-label">{{ __('keywords.member_name') }}</label>
                                <input type="text" name="name" id="member_name" class="form-control" placeholder="{{ __('keywords.enter_member_name') }}" required>
                                <x-validation-error field="name"></x-validation-error>
                            </div>
                            <!-- member location Input -->
                            <div class="mt-4">
                                <label for="category_name" class="form-label">{{ __('keywords.member_location') }}</label>
                                <input type="text" name="location" id="location" class="form-control" placeholder="{{ __('keywords.enter_location') }}" required>
                                <x-validation-error field="name"></x-validation-error>
                            </div>
                            <!-- member phone Input -->
                            <div class="mt-4">
                                <label for="category_name" class="form-label">{{ __('keywords.member_phone') }}</label>
                                <input type="text" name="phone" id="phone" class="form-control" placeholder="{{ __('keywords.enter_phone') }}" required>
                                <x-validation-error field="name"></x-validation-error>
                            </div>


                            <!-- member whatsapp Input -->
                            <div class="mt-4">
                                <label for="category_name" class="form-label">{{ __('keywords.member_whatsapp') }}</label>
                                <input type="text" name="whatsapp" id="whatsapp" class="form-control" placeholder="{{ __('keywords.enter_whatsapp') }}" required>
                                <x-validation-error field="name"></x-validation-error>
                            </div>
                            <!-- member facebook Input -->
                            <div class="mt-4">
                                <label for="category_name" class="form-label">{{ __('keywords.member_facebook') }}</label>
                                <input type="text" name="facebook" id="facebook" class="form-control" placeholder="{{ __('keywords.enter_facebook') }}" required>
                                <x-validation-error field="name"></x-validation-error>
                            </div>


                            <x-submit-button>{{ __('keywords.add_member') }}</x-submit-button>

                        </form>
                    </div>
                </div>

                <!-- Display All members with Show and Delete Options -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('keywords.members') }}</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>{{ __('keywords.members') }}</th>
                                <th class="d-flex justify-content-end">{{ __('keywords.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($members as $member)
                                <tr>
                                    <td>{{ $member->name }}</td>
                                    <td class="d-flex justify-content-end">
                                        <!-- Show member Button -->
                                        <a href="{{ route('admin.members.show', $member->id) }}" class="btn btn-info btn-sm me-2" style="display:inline;margin-right:5px; width: 55px; height: 25px; text-align: center;">
                                            {{ __('keywords.show') }}
                                        </a>

                                        <!-- Delete member Button -->
                                        <form action="{{ route('admin.members.destroy', $member->id) }}" method="POST" style="display:inline;">
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

        document.addEventListener('DOMContentLoaded', function () {
            const sectionDropdown = document.getElementById('new_section_id');
            const categoryDropdown = document.getElementById('category_id');
            // console.log(sectionDropdown);

            sectionDropdown.addEventListener('change', function () {
                const sectionId = this.value;

                // Clear existing options
                categoryDropdown.innerHTML = '<option value="">{{ __('keywords.select_category') }}</option>';

                if (sectionId) {
                    fetch(`/categories/${sectionId}`)
                        .then(response => {
                            if (!response.ok) {
                                console.log(response);
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

        document.addEventListener('DOMContentLoaded', function () {
            const sectionDropdown = document.getElementById('new_section_id_2');
            const categoryDropdown = document.getElementById('category_id_2');

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
    </script>
