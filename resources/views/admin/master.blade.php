<!doctype html>
<html lang="en">
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

@include('admin.partials.head')

<body class="vertical  light  @if (LaravelLocalization::getCurrentLocale() == 'ar') rtl @endif">
    <div class="wrapper">
        @include('admin.partials.navbar')

        @include('admin.partials.sidebar')

        <main role="main" class="main-content">
            @yield('content')
        </main> <!-- main -->
    </div> <!-- .wrapper -->

    @include('admin.partials.scripts')
    <script>
        function confirmDelete(id) {
            if (confirm('Are you sure you want to delete this record ?')) {
                document.getElementById('deleteForm-' + id).submit();
            }
        }
    </script>

</body>

</html>
