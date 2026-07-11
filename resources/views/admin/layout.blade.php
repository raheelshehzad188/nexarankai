<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - CMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
    <script src="https://cdn.tiny.cloud/1/q5jg3il4p94h9cs2f2agtr3taurgu1obqf2i5hxlkp35n55t/tinymce/6/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar vh-100 position-fixed">
                <div class="position-sticky pt-3">
                    <h4 class="text-white px-3 mb-4">CMS Admin</h4>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('admin.settings.edit') }}">
                                <i class="bi bi-gear"></i> Site Settings
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('admin.menus.index') }}">
                                <i class="bi bi-list"></i> Menus
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('admin.pages.index') }}">
                                <i class="bi bi-file-text"></i> Pages
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('admin.page-sections.index') }}">
                                <i class="bi bi-layout-split"></i> Page Sections
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('admin.section-types.index') }}">
                                <i class="bi bi-images"></i> Section Types
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('admin.blog-posts.index') }}">
                                <i class="bi bi-journal-text"></i> Blog Posts
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('admin.blog-categories.index') }}">
                                <i class="bi bi-bookmarks"></i> Blog Categories
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('admin.services.index') }}">
                                <i class="bi bi-briefcase"></i> Services
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('admin.service-categories.index') }}">
                                <i class="bi bi-tags"></i> Service Categories
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('admin.testimonials.index') }}">
                                <i class="bi bi-star"></i> Testimonials
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('admin.client-logos.index') }}">
                                <i class="bi bi-building"></i> Client Logos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white position-relative" href="{{ route('admin.leads.index') }}">
                                <i class="bi bi-envelope"></i> Leads
                                @php
                                    $newLeadsCount = \App\Models\Lead::whereDate('created_at', today())->count();
                                @endphp
                                @if($newLeadsCount > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ $newLeadsCount }}
                                        <span class="visually-hidden">new leads today</span>
                                    </span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item mt-3">
                            <a class="nav-link text-white" href="{{ route('admin.profile.edit') }}">
                                <i class="bi bi-person-circle"></i> Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="nav-link text-white border-0 bg-transparent w-100 text-start">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" style="margin-left: 16.666667%">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">@yield('title', 'Dashboard')</h1>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/q5jg3il4p94h9cs2f2agtr3taurgu1obqf2i5hxlkp35n55t/tinymce/6/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
    <script>
        window.tinymceLoaded = new Promise(function(resolve) {
            if (typeof tinymce !== 'undefined') resolve();
            else document.addEventListener('DOMContentLoaded', function() {
                var check = setInterval(function() {
                    if (typeof tinymce !== 'undefined') { clearInterval(check); resolve(); }
                }, 50);
            });
        });
    </script>
    @stack('scripts')
</body>
</html>

