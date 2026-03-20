<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CI4 Exam - Student Portal</title>
    
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        body { background-color: #f8f9fa; }
        .navbar-brand { font-weight: 700; letter-spacing: 1px; }
        .nav-link { font-weight: 500; }
        .card { border-radius: 12px; }
        .shadow-sm { box-shadow: 0 .125rem .25rem rgba(0,0,0,.075)!important; }
        .active-role { font-size: 0.75rem; vertical-align: middle; }
    </style>
</head>
<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand text-primary" href="<?= base_url('/') ?>">
                <i class="bi bi-mortarboard-fill"></i> LavishStudentPortal
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <?php 
                        // Safely fetch session data
                        $userSession = session()->get('user');
                        // Use null coalescing to ensure $role is never 'undefined'
                        $role = $userSession['role'] ?? null;
                    ?>

                    <?php if($role): ?>

                        <!-- Dashboard: Dynamic Link based on role -->
                        <li class="nav-item">
                            <a class="nav-link <?= (url_is('dashboard*') || url_is('student/dashboard*') ? 'active' : '') ?>" 
                               href="<?= ($role === 'student') ? base_url('student/dashboard') : base_url('dashboard') ?>">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </a>
                        </li>

                        <!-- Admin Features -->
                        <?php if ($role === 'admin'): ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-info" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-shield-lock"></i> Admin
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark shadow border-0">
                                    <li><a class="dropdown-item" href="<?= base_url('admin/users') ?>">User Management</a></li>
                                    <li><a class="dropdown-item" href="<?= base_url('admin/roles') ?>">Role Settings</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>

                        <!-- Staff Records (Admin & Teacher) -->
                        <?php if (in_array($role, ['teacher', 'admin'])): ?>
                            <li class="nav-item">
                                <a class="nav-link <?= (url_is('records*') ? 'active' : '') ?>" href="<?= base_url('records') ?>">
                                    <i class="bi bi-list-task"></i> Records
                                </a>
                            </li>
                        <?php endif; ?>
                        
                        <!-- Student Profile -->
                        <?php if ($role === 'student'): ?>
                            <li class="nav-item">
                                <a class="nav-link <?= (url_is('profile*') ? 'active' : '') ?>" href="<?= base_url('profile') ?>">
                                    <i class="bi bi-person-circle"></i> My Profile
                                </a>
                            </li>
                        <?php endif; ?>

                        <!-- User Identity & Logout -->
                        <li class="nav-item ms-lg-3">
                            <div class="d-flex align-items-center">
                                <!-- FIX: Ensure we only echo if $role is not null, otherwise fallback to 'User' -->
                                <span class="badge bg-primary me-2 d-none d-lg-inline active-role shadow-sm">
    <?php 
        $displayRole = 'User'; // Default fallback
        if (isset($role) && is_string($role)) {
            $displayRole = $role;
        }
        echo strtoupper(esc($displayRole));
    ?>
</span>
                                <a class="nav-link btn btn-outline-danger btn-sm px-3 text-white border-0 shadow-sm" 
                                   href="<?= base_url('logout') ?>" 
                                   onclick="return confirm('Are you sure you want to logout?')">
                                    Logout
                                </a>
                            </div>
                        </li>

                    <?php else: ?>
                        <!-- Public Links -->
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('login') ?>">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('register') ?>">Register</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <!-- Flash Messages -->
        <div class="row justify-content-center">
            <div class="col-md-10">
                <?php if(session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i> <?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>
                
                <?php if(session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= session()->getFlashdata('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Main Content Area -->
        <main>
            <?= $this->renderSection('content') ?>
        </main>
    </div>

    <footer class="text-center mt-5 py-4 border-top bg-white">
        <p class="text-muted mb-0">&copy; <?= date('Y') ?> - <strong>LAVISH</strong> - Student Portal</p>
        <small class="text-uppercase text-primary fw-bold" style="font-size: 0.7rem;">Lavish Student Portal v1.0</small>
    </footer>

    <!-- Bootstrap 5 JS Bundle (Includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>