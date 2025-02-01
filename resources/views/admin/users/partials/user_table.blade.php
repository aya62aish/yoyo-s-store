@forelse ($users as $user)
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
@empty
    <tr>
        <td colspan="5" class="text-center">{{ __('keywords.no_records_found') }}</td>
    </tr>
@endforelse
