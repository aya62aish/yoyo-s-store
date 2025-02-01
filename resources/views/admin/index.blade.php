@extends('admin.master')

@section('title', __('Dashboard'))

@section('content')
    <div class="container-fluid mb-4">
        <div class="row">
            <!-- Total Users Card -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title text-muted">Total Users</h5>
                        <h3 class="display-4 mb-0">{{ end($data['userscount']) }}</h3>
                        <span class="{{ $data['differences']['users'][5] >= 0 ? 'text-success' : 'text-danger' }}">
                            {{ $data['differences']['users'][5] >= 0 ? '+' : '' }}{{ $data['differences']['users'][5] .'%'}}
                        </span>
                        <i class="fe {{ $data['differences']['users'][5] >= 0 ? 'fe-arrow-up text-success' : 'fe-arrow-down text-danger' }}"></i>
                    </div>
                    <div class="card-footer p-2">
                        <canvas id="usersGraph" style="height: 200px;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Total Members Card -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title text-muted">Total Members</h5>
                        <h3 class="display-4 mb-0">{{ end($data['memberscount']) }}</h3>
                        <span class="{{ $data['differences']['members'][5] >= 0 ? 'text-success' : 'text-danger' }}">
                            {{ $data['differences']['members'][5] >= 0 ? '+' : '' }}{{ $data['differences']['members'][5] .'%'}}
                        </span>
                        <i class="fe {{ $data['differences']['members'][5] >= 0 ? 'fe-arrow-up text-success' : 'fe-arrow-down text-danger' }}"></i>
                    </div>
                    <div class="card-footer p-2">
                        <canvas id="membersGraph" style="height: 200px;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Categories Card -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title text-muted">Categories</h5>
                        <h3 class="display-4 mb-0">{{ end($data['categoriescount']) }}</h3>
                        <span class="{{ $data['differences']['categories'][5] >= 0 ? 'text-success' : 'text-danger' }}">
                            {{ $data['differences']['categories'][5] >= 0 ? '+' : '' }}{{ $data['differences']['categories'][5].'%' }}
                        </span>
                        <i class="fe {{ $data['differences']['categories'][5] >= 0 ? 'fe-arrow-up text-success' : 'fe-arrow-down text-danger' }}"></i>
                    </div>
                    <div class="card-footer p-2">
                        <canvas id="categoriesGraph" style="height: 200px;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Total Ads Card -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title text-muted">Total Ads</h5>
                        <h3 class="display-4 mb-0">{{ end($data['adscount']) }}</h3>
                        <span class="{{ $data['differences']['ads'][5] >= 0 ? 'text-success' : 'text-danger' }}">
                            {{ $data['differences']['ads'][5] >= 0 ? '+' : '' }}{{ $data['differences']['ads'][5] .'%'}}
                        </span>
                        <i class="fe {{ $data['differences']['ads'][5] >= 0 ? 'fe-arrow-up text-success' : 'fe-arrow-down text-danger' }}"></i>
                    </div>
                    <div class="card-footer p-2">
                        <canvas id="adsGraph" style="height: 200px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const labels = @json($labels);
            const data = @json($data);

            // Users Graph
            new Chart(document.getElementById('usersGraph').getContext('2d'), {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Users Growth',
                        data: data.users,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        tension: 0.3,
                        fill: true,
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false }
            });

            // Members Graph
            new Chart(document.getElementById('membersGraph').getContext('2d'), {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Members Growth',
                        data: data.members,
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        tension: 0.3,
                        fill: true,
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false }
            });

            // Categories Graph
            new Chart(document.getElementById('categoriesGraph').getContext('2d'), {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Categories',
                        data: data.categories,
                        backgroundColor: 'rgba(153, 102, 255, 0.5)',
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false }
            });

            // Ads Graph
            new Chart(document.getElementById('adsGraph').getContext('2d'), {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Ads',
                        data: data.ads,
                        backgroundColor: 'rgba(255, 206, 86, 0.5)',
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false }
            });
        });
    </script>
@endsection
