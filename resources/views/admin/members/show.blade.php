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
                                <label for="title">{{ __('keywords.title') }}</label>
                                <p class="form-control">{{ $section }}</p>
                                <label for="title">{{ __('keywords.category_name') }}</label>
                                <p class="form-control">{{ $category }}</p>
                                <label for="title">{{ __('keywords.member_name') }}</label>
                                <p class="form-control">{{ $member }}</p>

                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>{{ __('keywords.ads_name') }}</th>
                                    <th class="d-flex justify-content-end" >{{ __('keywords.actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ads as $ad)
                                    <tr>
                                        <td>{{ $ad->title }}</td>
                                        <td class="d-flex justify-content-end">
                                            <!-- Show Section Button -->
                                            <a href="{{route('admin.ads.show', $ad->id)}}" class="btn btn-info btn-sm me-2">
                                                {{ __('keywords.show') }}
                                            </a>

                                            <!-- Delete Section Button -->
                                            <form action="{{route('admin.categories.destroy',$ad->id)}}" method="POST" style="display:inline;">
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
