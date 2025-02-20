<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="<?php echo base_url('dashboard'); ?>">Lead Management</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('lead'); ?>">Leads</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('import'); ?>">Import</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('export'); ?>">Export</a>
                </li>
                <?php
                    if (isset($_SESSION['user_role']) ): 
                        if($_SESSION['user_role'] == 'admin'):
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('user'); ?>">Users</a>
                </li>
                <?php endif;endif; ?>
                <?php if (isset($_SESSION['user_id'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('auth/logout'); ?>">Logout</a>
                </li>
                <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('auth/login'); ?>">Login</a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    <div class="container mt-4"></div>