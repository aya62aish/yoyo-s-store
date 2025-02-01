@extends('admin.master')

@section('title', __('keywords.add_new_service'))

@section('content')
{{--    <div class="container-fluid">--}}
{{--        <div class="row justify-content-center">--}}
{{--            <div class="col-12">--}}
{{--                <h2 class="h5 page-title">{{ __('keywords.add_new_section') }}</h2>--}}

{{--                <div class="card shadow">--}}
{{--                    <div class="card-body">--}}
{{--                        <form action="{{route('admin.sections.store')}}" method="post" enctype="multipart/form-data">--}}
{{--                            @csrf--}}

{{--                            <div class="row">--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <x-form-label field="title"></x-form-label>--}}
{{--                                    <input type="text" name="title" class="form-control"--}}
{{--                                           placeholder="{{ __('keywords.title') }}">--}}
{{--                                    <x-validation-error field="title"></x-validation-error>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!-- File upload field -->--}}
{{--                            <div class="form-group" id="upload_field">--}}
{{--                                <label for="image_upload">Upload Image</label>--}}
{{--                                <input type="file" name="image_upload" id="image_upload" class="form-control" required>--}}
{{--                            </div>--}}
{{--                            <x-submit-button></x-submit-button>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}


                <div class="container-xl">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h3 class="card-title mb-0"> <!-- Use mb-0 to remove bottom margin -->
                                {{ __('keywords.sections') }}
                            </h3>
                            <div class="card-actions">
                                <a href="#" class="btn btn-icon btn-outline-success" data-bs-toggle="modal" data-bs-target="#addSectionModal">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="icon icon-tabler icon-tabler-plus"
                                         width="24" height="24" viewBox="0 0 24 24"
                                         stroke-width="2" stroke="currentColor" fill="none"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M12 5l0 14" />
                                        <path d="M5 12l14 0" />
                                    </svg>
                                </a>

                            </div>
                        </div>

                        <!-- Modal for Form -->
                        <div class="modal fade" id="addSectionModal" tabindex="-1" aria-labelledby="addSectionModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-success text-white">
                                        <h5 class="modal-title" id="addSectionModalLabel">Add New Section</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin.sections.store') }}" method="post" enctype="multipart/form-data">
                                            @csrf

                                            <!-- Title Field -->
                                            <div class="mb-3">
                                                <label for="title" class="form-label fw-bold">Title</label>
                                                <input type="text" name="title" id="title" class="form-control" placeholder="Enter title">
                                                <x-validation-error field="title"></x-validation-error>
                                            </div>

                                            <!-- Custom File Upload Field with Preview -->
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Upload Image</label>
                                                <div class="d-flex align-items-center">
                                                    <label class="btn btn-outline-success me-3" for="image_upload">
                                                        <i class="bi bi-upload me-2"></i> Choose Image
                                                    </label>
                                                    <input type="file" name="image_upload" id="image_upload" class="d-none" accept="image/*" onchange="previewImage(event)" required>
                                                </div>
                                                <div class="mt-3">
                                                    <img id="image_preview" src="https://via.placeholder.com/150" alt="Image Preview" class="img-thumbnail d-none" style="max-width: 100%; height: auto;">
                                                </div>
                                            </div>

                                            <!-- Submit Button -->
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-success">Save Section</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>




                        <div class="table-responsive">
                            <table class="table table-bordered card-table table-vcenter text-nowrap datatable">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="text-center">{{ __('keywords.title') }}</th>
                                    <th scope="col" class="text-center">{{ __('keywords.section_icon') }}</th>
                                    <th scope="col" class="text-center">{{ __('keywords.number_of_categories') }}</th>
                                    <th scope="col" class="text-center">{{__('keywords.actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sections as $section)
                                    <tr>
                                        <td class="text-center">{{ $section->name }}</td>
                                        <td class="text-center">
                                            <img src="{{ "/".$section->icon }}" alt="{{ $section->name }} icon" style="width: 30px; height: 30px;" />
                                        </td>
                                        <td class="text-center">{{ \App\Models\category::where('section_id',$section->id)->count() }}</td>
                                        <td class="text-center">
                                            <!-- Show Section Button -->
                                            <a href="{{ route('admin.sections.show', $section->id) }}" class="btn btn-info btn-sm mr-2" title="{{ __('keywords.show') }}">
                                                <i class="fas fa-eye"></i> <!-- Eye icon for show -->
                                            </a>

                                            <!-- Edit Section Button -->
{{--                                            {{ route('admin.sections.edit', $section->id) }}--}}
                                            <a href="#" class="btn btn-warning btn-sm mr-2" data-bs-toggle="modal" data-bs-target="#editSectionModal" title="Edit"
                                              data-id="{{$section->id}}}" data-name="{{ $section->name }}" data-icon="{{ $section->icon }} "
                                               onclick="openEditSectionModal(this)">

                                                <i class="fas fa-edit"></i> <!-- Edit icon -->

                                            </a>
                                            <!-- Edit Section Modal -->
                                            <div class="modal fade" id="editSectionModal" tabindex="-1" aria-labelledby="editSectionModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-warning">
                                                            <h5 class="modal-title" id="editSectionModalLabel">Edit Section</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="editSectionForm" action="{{ route('admin.sections.edit', $section->id) }}" method="post">
                                                                @csrf

                                                                <!-- Name Field -->
                                                                <div class="mb-3">
                                                                    <label for="section_name" class="form-label fw-bold">Section Name</label>
                                                                    <input type="text" name="name" id="section_name" class="form-control" required>
                                                                </div>

                                                                <!-- Icon Field -->
                                                                <div class="mb-3 ">

                                                                    <!-- Custom File Upload Field with Preview -->
                                                                    <div class="mb-3 d-flex align-items-center">
                                                                        <label for="section_icon" class="form-label fw-bold m-3">Icon</label>
                                                                        <div class="d-flex align-items-center">
                                                                            <label class="btn btn-outline-success me-3" for="image_upload">
                                                                                <i class="bi bi-upload me-2"></i> Choose Image
                                                                            </label>
                                                                            <input type="file" name="image_upload" id="image_upload" class="d-none" accept="image/*"  required>
                                                                        </div>
                                                                        <div class="mt-3">
                                                                            <img id="image_preview" src="https://via.placeholder.com/150" alt="Image Preview" class="img-thumbnail d-none" style="max-width: 100%; height: auto;">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Save Button -->
                                                                <div class="d-flex justify-content-end">
                                                                    <button type="submit" class="btn btn-warning">Save Changes</button>
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
                                                    <i class="fas fa-trash"></i> <!-- Trash icon for delete -->
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                        </table>
                    </div>
                </div>
                <!-- End of all sections list -->
            </div>
{{--        </div>--}}
{{--    </div>--}}
@endsection
<script>
    function previewImage(event) {
        const preview = document.getElementById('image_preview');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = () => {
                preview.src = reader.result;
                preview.classList.remove('d-none');  // Show the image preview
            };
            reader.readAsDataURL(file);
        }
    }
    function openEditSectionModal(button) {
        // Get section data from data attributes
        const sectionId = button.getAttribute('data-id');
        const sectionName = button.getAttribute('data-name');
        const sectionIcon = button.getAttribute('data-icon');

        // Set the form action URL (assuming a RESTful route pattern)
        const formAction = `/sections/edit/${sectionId}`;
        console.log(formAction);
        document.getElementById('editSectionForm').action = formAction;

        // Populate modal fields with section data
        document.getElementById('section_name').value = sectionName;
        document.getElementById('section_icon').value = sectionIcon;

        // Show the modal
        new bootstrap.Modal(document.getElementById('editSectionModal')).show();
    }
</script>

