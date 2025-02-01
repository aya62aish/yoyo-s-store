@extends('admin.master')

@section('title', __('keywords.add_new_service'))

@section('content')
    <div class="container-xl">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="card-title mb-0">{{ __('keywords.sections') }}</h3>
                <div class="card-actions">
                    <a href="#" class="btn btn-icon btn-outline-success" data-bs-toggle="modal" data-bs-target="#addSectionModal">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Add Section Modal -->
            <div class="modal fade" id="addSectionModal" tabindex="-1" aria-labelledby="addSectionModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title" id="addSectionModalLabel">{{ __('keywords.add_new_section') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('keywords.close') }}"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.sections.store') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <!-- Title Field -->
                                <div class="mb-3">
                                    <label for="title" class="form-label fw-bold">{{ __('keywords.title') }}</label>
                                    <input type="text" name="title" id="title" class="form-control" placeholder="{{ __('keywords.enter_title') }}" required>
                                    <x-validation-error field="title"></x-validation-error>
                                </div>

                                <!-- Custom File Upload Field with Preview -->
                                <div class="mb-3">
                                    <label class="form-label fw-bold">{{ __('keywords.upload_image') }}</label>
                                    <div class="d-flex align-items-center">
                                        <label class="btn btn-outline-success me-3" for="image_upload">
                                            <i class="bi bi-upload me-2"></i> {{ __('keywords.choose_image') }}
                                        </label>
                                        <input type="file" name="image_upload" id="image_upload" class="d-none" accept="image/*" onchange="previewImage(event)" required>
                                    </div>
                                    <div class="mt-3">
                                        <img id="image_preview" src="https://via.placeholder.com/150" alt="{{ __('keywords.image_preview') }}" class="img-thumbnail d-none" style="max-width: 100%; height: auto;">
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success">{{ __('keywords.save_section') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table of Sections -->
            <div class="table-responsive">
                <table class="table table-bordered card-table table-vcenter text-nowrap datatable">
                    <thead class="thead-dark">
                    <tr>
                        <th class="text-center">{{ __('keywords.title') }}</th>
                        <th class="text-center">{{ __('keywords.section_icon') }}</th>
                        <th class="text-center">{{ __('keywords.number_of_categories') }}</th>
                        <th class="text-center">{{ __('keywords.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sections as $section)
                        <tr>
                            <td class="text-center">{{ $section->name }}</td>
                            <td class="text-center">
                                <img src="/{{ $section->icon }}" alt="{{ $section->name }} {{ __('keywords.icon') }}" style="width: 30px; height: 30px;" />
                            </td>
                            <td class="text-center">{{ \App\Models\category::where('section_id', $section->id)->count() }}</td>
                            <td class="text-center">
                                <!-- Show Section Button -->
                                <a href="{{ route('admin.sections.show', $section->id) }}" class="btn btn-info btn-sm mr-2" title="{{ __('keywords.show') }}">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <!-- Edit Section Button -->
                                <a href="#" class="btn btn-warning btn-sm mr-2" data-bs-toggle="modal" data-bs-target="#editSectionModal" title="{{ __('keywords.edit') }}"
                                   data-id="{{ $section->id }}" data-name="{{ $section->name }}" data-icon="{{ $section->icon }}"
                                   onclick="openEditSectionModal(this)">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Edit Section Modal -->
                                <div class="modal fade" id="editSectionModal" tabindex="-1" aria-labelledby="editSectionModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-warning">
                                                <h5 class="modal-title" id="editSectionModalLabel">{{ __('keywords.edit_section') }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('keywords.close') }}"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="editSectionForm" action="{{ route('admin.sections.edit', $section->id) }}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')

                                                    <!-- Name Field -->
                                                    <div class="mb-3">
                                                        <label for="section_name" class="form-label fw-bold">{{ __('keywords.section_name') }}</label>
                                                        <input type="text" name="name" id="section_name" class="form-control" required>
                                                    </div>

                                                    <!-- Icon Field -->
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">{{ __('keywords.icon') }}</label>
                                                        <div class="d-flex align-items-center">
                                                            <label class="btn btn-outline-success me-3" for="icon_upload_edit">
                                                                <i class="bi bi-upload me-2"></i> {{ __('keywords.choose_image') }}
                                                            </label>
                                                            <input type="file" name="icon_upload" id="icon_upload_edit" class="d-none" accept="image/*">
                                                        </div>
                                                        <div class="mt-3">
                                                            <img id="icon_preview" src="https://via.placeholder.com/150" alt="{{ __('keywords.icon_preview') }}" class="img-thumbnail d-none" style="max-width: 100%; height: auto;">
                                                        </div>
                                                    </div>

                                                    <!-- Save Button -->
                                                    <div class="d-flex justify-content-end">
                                                        <button type="submit" class="btn btn-warning">{{ __('keywords.save_changes') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Section Button -->
                                <form action="{{ route('admin.sections.destroy', $section->id) }}" method="POST" style="display:inline;">
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
@endsection

<script>
    function previewImage(event) {
        const preview = document.getElementById('image_preview');
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
    function openEditSectionModal(button) {
        const sectionId = button.getAttribute('data-id');
        const sectionName = button.getAttribute('data-name');
        const sectionIcon = button.getAttribute('data-icon');

        // Set the form action URL dynamically
        const form = document.getElementById('editSectionForm');
        form.action = `/sections/edit/${sectionId}`;

        // Populate the form fields with the data
        document.getElementById('section_name').value = sectionName;
        document.getElementById('icon_preview').src = `/${sectionIcon}`;
        document.getElementById('icon_preview').classList.remove('d-none');

        // Show the modal
        new bootstrap.Modal(document.getElementById('editSectionModal')).show();
    }
</script>
