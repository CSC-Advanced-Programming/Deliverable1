<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Innovation Management System' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            transition: all 0.3s;
        }
        .sidebar .nav-link:hover {
            color: white;
            background: rgba(255,255,255,0.1);
        }
        .sidebar .nav-link.active {
            background: rgba(255,255,255,0.2);
            color: white;
        }
        .main-content {
            background: #f8f9fa;
            min-height: 100vh;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
        }
        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .breadcrumb {
            background: transparent;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 px-0">
                <div class="sidebar p-3">
                    <h5 class="text-center mb-4">
                        <i class="fas fa-lightbulb me-2"></i>
                        Innovation Hub
                    </h5>
                    <nav class="nav flex-column">
                        <a class="nav-link <?= ($active ?? '') == 'dashboard' ? 'active' : '' ?>" href="/">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                        </a>
                        <a class="nav-link <?= ($active ?? '') == 'programs' ? 'active' : '' ?>" href="/programs">
                            <i class="fas fa-project-diagram me-2"></i>Programs
                        </a>
                        <a class="nav-link <?= ($active ?? '') == 'facilities' ? 'active' : '' ?>" href="/facilities">
                            <i class="fas fa-building me-2"></i>Facilities
                        </a>
                        <a class="nav-link <?= ($active ?? '') == 'projects' ? 'active' : '' ?>" href="/projects">
                            <i class="fas fa-flask me-2"></i>Projects
                        </a>
                        <a class="nav-link <?= ($active ?? '') == 'participants' ? 'active' : '' ?>" href="/participants">
                            <i class="fas fa-users me-2"></i>Participants
                        </a>
                        <a class="nav-link <?= ($active ?? '') == 'services' ? 'active' : '' ?>" href="/services">
                            <i class="fas fa-cogs me-2"></i>Services
                        </a>
                        <a class="nav-link <?= ($active ?? '') == 'equipment' ? 'active' : '' ?>" href="/equipment">
                            <i class="fas fa-tools me-2"></i>Equipment
                        </a>
                        <a class="nav-link <?= ($active ?? '') == 'outcomes' ? 'active' : '' ?>" href="/outcomes">
                            <i class="fas fa-chart-line me-2"></i>Outcomes
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 px-0">
                <div class="main-content p-4">
                    <!-- Header -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h2 class="mb-1"><?= $title ?? 'Dashboard' ?></h2>
                            <?php if(isset($breadcrumb)): ?>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <?php foreach($breadcrumb as $item): ?>
                                    <li class="breadcrumb-item">
                                        <?php if(isset($item['url'])): ?>
                                        <a href="<?= $item['url'] ?>"><?= $item['label'] ?></a>
                                        <?php else: ?>
                                        <span class="text-muted"><?= $item['label'] ?></span>
                                        <?php endif; ?>
                                    </li>
                                    <?php endforeach; ?>
                                </ol>
                            </nav>
                            <?php endif; ?>
                        </div>
                        <div class="text-end">
                            <small class="text-muted">
                                <i class="fas fa-clock me-1"></i>
                                <?= date('M d, Y H:i') ?>
                            </small>
                        </div>
                    </div>

                    <!-- Flash Messages -->
                    <?php if(session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        <?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php endif; ?>

                    <?php if(session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <?= session()->getFlashdata('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php endif; ?>

                    <!-- Page Content -->
                    <?= $this->renderSection('content') ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
</body>
</html>