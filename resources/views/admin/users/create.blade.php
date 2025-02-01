@extends('admin.master')

@section('title', __('keywords.members'))

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="h5 page-title">{{ __('keywords.manage_users') }}</h2>

                <!-- Search Bar -->
                <div class="mb-3">
                    <input type="text" id="searchInput" class="form-control" placeholder="{{ __('keywords.search_placeholder') }}" onkeyup="searchUsers()">
                    <ul id="memberSuggestions" class="list-group mt-2"></ul> <!-- Suggestions will appear here -->
                </div>

                <div class="card mt-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h3 class="card-title mb-0">{{ __('keywords.members') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered card-table table-vcenter text-nowrap">
                                <thead class="thead-dark">
                                <tr>
                                    <th class="text-center">{{ __('keywords.name') }}</th>
                                    <th class="text-center">{{ __('keywords.email') }}</th>
                                    <th class="text-center">{{ __('keywords.phone') }}</th>
                                    <th class="text-center">{{ __('keywords.status') }}</th>
                                    <th class="text-center">{{ __('keywords.actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td class="text-center">{{ $user->name }}</td>
                                        <td class="text-center">{{ $user->email }}</td>
                                        <td class="text-center">{{ $user->phone }}</td>
                                        <td class="text-center">{{ $user->is_verified ? 'active' : 'inactive' }}</td>
                                        <td class="text-center">
                                            <!-- Edit Button -->
                                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editUserModal-{{ $user->id }}">
                                                {{ __('keywords.edit') }}
                                            </button>

                                            <!-- Delete Form -->
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('{{ __('keywords.confirm_delete') }}')">
                                                    {{ __('keywords.delete') }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Edit User Modal -->
                                    <div class="modal fade" id="editUserModal-{{ $user->id }}" tabindex="-1" aria-labelledby="editUserModalLabel-{{ $user->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header bg-warning text-white">
                                                    <h5 class="modal-title" id="editUserModalLabel-{{ $user->id }}">{{ __('keywords.edit_member') }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('keywords.close') }}"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="mb-3">
                                                            <label for="name-{{ $user->id }}" class="form-label">{{ __('keywords.name') }}</label>
                                                            <input type="text" name="name" id="name-{{ $user->id }}" class="form-control" value="{{ $user->name }}" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="email-{{ $user->id }}" class="form-label">{{ __('keywords.email') }}</label>
                                                            <input type="email" name="email" id="email-{{ $user->id }}" class="form-control" value="{{ $user->email }}" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="phone-{{ $user->id }}" class="form-label">{{ __('keywords.phone') }}</label>
                                                            <input type="text" name="phone" id="phone-{{ $user->id }}" class="form-control" value="{{ $user->phone }}">
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="status-{{ $user->id }}" class="form-label">{{ __('keywords.status') }}</label>
                                                            <select name="status" id="status-{{ $user->id }}" class="form-control">
                                                                <option value="1" {{ $user->status ? 'selected' : '' }}>{{ 'active' }}</option>
                                                                <option value="0" {{ !$user->status ? 'selected' : '' }}>{{ 'inactive' }}</option>
                                                            </select>
                                                        </div>

                                                        <div class="d-flex justify-content-end">
                                                            <button type="submit" class="btn btn-warning">{{ __('keywords.save_changes') }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Edit User Modal -->
                                @endforeach
                                </tbody>
                            </table>

                            <!-- Bootstrap Pagination -->
                            @if ($users->hasPages())
                                <nav>
                                    <ul class="pagination justify-content-center">
                                        {{-- Previous Page Link --}}
                                        @if ($users->onFirstPage())
                                            <li class="page-item disabled">
                                                <span class="page-link">&laquo;</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $users->previousPageUrl() }}" rel="prev">&laquo;</a>
                                            </li>
                                        @endif

                                        {{-- Pagination Elements --}}
                                        @foreach ($users->links()->elements as $element)
                                            {{-- "Three Dots" Separator --}}
                                            @if (is_string($element))
                                                <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                                            @endif

                                            {{-- Array Of Links --}}
                                            @if (is_array($element))
                                                @foreach ($element as $page => $url)
                                                    @if ($page == $users->currentPage())
                                                        <li class="page-item active">
                                                            <span class="page-link">{{ $page }}</span>
                                                        </li>
                                                    @else
                                                        <li class="page-item">
                                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach

                                        {{-- Next Page Link --}}
                                        @if ($users->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $users->nextPageUrl() }}" rel="next">&raquo;</a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
                                                <span class="page-link">&raquo;</span>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function searchUsers() {
        const query = document.getElementById('searchInput').value;
        const tableBody = document.querySelector('tbody');

        if (query.length > 0) {
            fetch(`/admin/users/search?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    tableBody.innerHTML = data.html; // Replace table body content
                })
                .catch(error => console.error('Error fetching users:', error));
        } else {
            // Reload the full user list if the query is empty
            fetch(`/admin/users`)
                .then(response => response.json())
                .then(data => {
                    tableBody.innerHTML = data.html; // Reset table content
                })
                .catch(error => console.error('Error fetching users:', error));
        }
    }


    function selectUser(userId) {
        alert(`User ID: ${userId} selected!`); // Example action on user selection
        // You can implement additional functionality here
    }
</script>
