<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="<?php echo e(url('/')); ?>">Online Store</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(auth()->user()->hasRole('Customer')): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('customer_profile')); ?>">Profile (Credit: <?php echo e(auth()->user()->credit); ?>)</a>
                            </li>
                        <?php endif; ?>
                        <?php if(auth()->user()->hasPermissionTo('manage_products')): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('products.create')); ?>">Add Product</a>
                            </li>
                        <?php endif; ?>
                        <?php if(auth()->user()->hasPermissionTo('manage_customers')): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('employees.customers')); ?>">Manage Customers</a>
                            </li>
                        <?php endif; ?>
                        <?php if(auth()->user()->hasPermissionTo('create_employees')): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('admin.create_employee')); ?>">Create Employee</a>
                            </li>
                        <?php endif; ?>
                        <?php if(auth()->user()->hasPermissionTo('show_users')): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('users')); ?>">Users</a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('products.index')); ?>">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('do_logout')); ?>">Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('login')); ?>">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('register')); ?>">Register</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
        <?php endif; ?>
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH C:\Users\fatma\Desktop\websec-main\WebSecService\resources\views/layouts/master.blade.php ENDPATH**/ ?>