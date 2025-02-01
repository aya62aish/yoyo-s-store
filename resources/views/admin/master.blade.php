<!doctype html>
<html lang="en">
<head>
    <!-- Font Imports -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Styles for Cairo Font -->
    <style>
        /* Apply Cairo font to Arabic text with specific styles */
        body.rtl {
            font-family: 'Cairo', sans-serif;
        }

        /* Arabic bold text for large titles */
        .arabic-bold {
            font-family: 'Cairo', sans-serif;
            font-weight: 700; /* Bold */
        }

        /* Arabic regular text for small or normal text */
        .arabic-regular {
            font-family: 'Cairo', sans-serif;
            font-weight: 400; /* Regular */
        }
    </style>

    @include('admin.partials.head')
</head>

<body class="vertical light @if (LaravelLocalization::getCurrentLocale() == 'ar') rtl @endif">
    <div class="wrapper">
        @include('admin.partials.navbar')
        @include('admin.partials.sidebar')

        <main role="main" class="main-content">
            @yield('content')
        </main> <!-- main -->
    </div> <!-- .wrapper -->

    @include('admin.partials.scripts')
@yield('scripts')
    <script>
        function confirmDelete(id) {
            if (confirm('Are you sure you want to delete this record ?')) {
                document.getElementById('deleteForm-' + id).submit();
            }
        }
    </script>
</body>
</html>
