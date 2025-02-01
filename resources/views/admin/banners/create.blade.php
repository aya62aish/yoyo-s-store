@extends('admin.master')

@section('title', __('keywords.banners'))

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="h5 page-title">{{ __('keywords.manage_banners') }}</h2>

                <!-- Display All Banners -->
                <div class="card mt-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h3 class="card-title mb-0">{{ __('keywords.banners') }}</h3>
                        <div class="card-actions">
                            <!-- Add Banner Modal Trigger Button -->
                            <button class="btn btn-icon btn-outline-success" data-bs-toggle="modal" data-bs-target="#addBannerModal">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered card-table table-vcenter text-nowrap datatable">
                                <thead class="thead-dark">
                                <tr>
                                    <th class="text-center">{{ __('keywords.banner_image') }}</th>
                                    <th class="text-center">{{ __('keywords.link_or_member') }}</th>
                                    <th class="text-center">{{ __('keywords.actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($banners as $banner)
                                    <tr>
                                        <td class="text-center">
                                            <img src="{{ asset('/' . $banner->image) }}" alt="Banner Image" style="width: 50px; height: 40px;">
                                        </td>
                                        <td class="text-center">
                                            @if($banner->link)
                                                <a href="{{ $banner->link }}" target="_blank">{{ $banner->link }}</a>
                                            @elseif($banner->member_id)
                                                {{ \App\Models\member::find($banner->member_id)->name }}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <!-- Actions for Edit and Delete -->
                                            <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" style="display:inline;">
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

                <!-- Add Banner Modal -->
                <div class="modal fade" id="addBannerModal" tabindex="-1" aria-labelledby="addBannerModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title" id="addBannerModalLabel">{{ __('keywords.add_new_banner') }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.banners.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <!-- Banner Image Upload -->
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">{{ __('keywords.upload_banner_image') }}</label>
                                        <div class="d-flex align-items-center">
                                            <label class="btn btn-outline-success me-3" for="banner_image">
                                                <i class="bi bi-upload me-2"></i> {{ __('keywords.choose_image') }}
                                            </label>
                                            <input type="file" name="image" id="banner_image" class="d-none" accept="image/*" onchange="previewImage(event, 'banner_image_preview')" required>
                                        </div>
                                        <div class="mt-3">
                                            <img id="banner_image_preview" src="https://via.placeholder.com/150" alt="Banner Preview" class="img-thumbnail d-none" style="max-width: 100%; height: auto;">
                                        </div>
                                    </div>

                                    <!-- Link or Member Selection Toggle -->
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">{{ __('keywords.link_or_member') }}</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="option" id="linkOption" onclick="toggleOption('link')" checked>
                                            <label class="form-check-label" for="linkOption">{{ __('keywords.enter_link') }}</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="option" id="memberOption" onclick="toggleOption('member')">
                                            <label class="form-check-label" for="memberOption">{{ __('keywords.select_existing_member') }}</label>
                                        </div>
                                    </div>

                                    <!-- Single Input Field for Link or Member Name -->
                                    <div id="dynamicInput" class="mb-3">
                                        <input type="url" name="link" id="link" class="form-control" placeholder="{{ __('keywords.enter_link') }}" required>
                                        <input type="text" id="memberSearchInput" class="form-control d-none" placeholder="Search for member" onkeyup="searchMembers()">
                                        <input type="hidden" name="member_id" id="member_id">
                                        <ul id="memberSuggestions" class="list-group mt-2"></ul> <!-- Suggestions will appear here -->
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-success">{{ __('keywords.save_banner') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    // Preview uploaded banner image
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

    // Toggle between link input and member search input
    function toggleOption(option) {
        const linkInput = document.getElementById('link');
        const memberSearchInput = document.getElementById('memberSearchInput');
        const memberSuggestions = document.getElementById('memberSuggestions');

        if (option === 'link') {
            linkInput.classList.remove('d-none');
            linkInput.required = true;
            memberSearchInput.classList.add('d-none');
            memberSearchInput.required = false;
            memberSuggestions.innerHTML = ''; // Clear member suggestions if switching to link
            document.getElementById('member_id').value = '';
        } else if (option === 'member') {
            memberSearchInput.classList.remove('d-none');
            memberSearchInput.required = true;
            linkInput.classList.add('d-none');
            linkInput.required = false;
            linkInput.value = '';
        }
    }

    // Perform AJAX search for members
    function searchMembers() {
        const query = document.getElementById('memberSearchInput').value;
        const suggestionsList = document.getElementById('memberSuggestions');

        if (query.length > 0) {
            fetch(`/ad/members/search?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    suggestionsList.innerHTML = ''; // Clear previous results
                    data.forEach(member => {
                        const listItem = document.createElement('li');
                        listItem.classList.add('list-group-item', 'list-group-item-action');
                        listItem.textContent = member.name;
                        listItem.onclick = () => selectMember(member.id, member.name);
                        suggestionsList.appendChild(listItem);
                    });
                })
                .catch(error => console.error('Error fetching members:', error));
        } else {
            suggestionsList.innerHTML = ''; // Clear if input is empty
        }
    }

    // Select Member
    function selectMember(memberId, memberName) {
        document.getElementById('member_id').value = memberId;
        document.getElementById('memberSearchInput').value = memberName;
        document.getElementById('memberSuggestions').innerHTML = ''; // Clear suggestions after selection
    }
</script>
