<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Access Denied</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="bg-light d-flex align-items-center vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-5">
                        <i class="bi bi-shield-lock-fill text-danger" style="font-size: 5rem;"></i>
                        <h1 class="display-4 fw-bold text-dark">403</h1>
                        <h3 class="mb-3">Access Denied</h3>
                        
                        <div class="alert alert-secondary py-2">
                            Logged in as: <strong><?= esc(ucfirst($userRole)) ?></strong>
                        </div>

                        <p class="text-muted mb-4">
                            Apologies, but your account level does not have the necessary permissions to access this specific module.
                        </p>

                        <?php 
                            // Smart Redirect Logic
                            $homeUrl = match($userRole) {
                                'admin', 'teacher' => base_url('dashboard'),
                                'student'          => base_url('student/dashboard'),
                                default            => base_url('login'),
                            };
                        ?>

                        <a href="<?= $homeUrl ?>" class="btn btn-primary px-4 shadow-sm">
                            <i class="bi bi-house-door-fill me-2"></i> Return to My Dashboard
                        </a>
                    </div>
                </div>
                <p class="mt-4 text-muted small">&copy; 2026 Student Management System Security Layer</p>
            </div>
        </div>
    </div>
</body>
</html>