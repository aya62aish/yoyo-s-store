@extends('admin.master')

@section('title', __('keywords.show'))

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">


                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="title">{{ __('keywords.category_name') }}</label>
                                <p class="form-control">{{ $category->name }}</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>{{ __('keywords.members_name') }}</th>
                                    <th class="d-flex justify-content-end" >{{ __('keywords.actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($members as $member)
                                    <tr>
                                        <td>{{ $member->name }}</td>
                                        <td class="d-flex justify-content-end">
                                            <!-- Show member Button -->
                                            <a href="{{route('admin.members.show',$member->id)}}" class="btn btn-info btn-sm me-2">
                                                {{ __('keywords.show') }}
                                            </a>

                                            <!-- Delete member Button -->
                                            <form action="{{route('admin.categories.destroy',$member->id)}}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        style="margin-left: 10px;"
                                                        onclick="return confirm('{{ __('keywords.confirm_delete') }}')">
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
                </div>
            </div>
        </div>
    </div>
@endsection
