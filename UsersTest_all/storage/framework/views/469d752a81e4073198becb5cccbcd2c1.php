<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-light">
    <div class="container-fluid">
        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(url('/')); ?>">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(url('/even')); ?>">Even Numbers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(url('/prime')); ?>">Prime Numbers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(url('/multable')); ?>">Multiplication Table</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(url('/bill')); ?>">Bill Page</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(url('/Transcript')); ?>">Transcript Page</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(url('/Products')); ?>">Products Page</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(url('/Calculator')); ?>">Calculator Page</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('products_list')); ?>">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('users.index')); ?>">Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('grades_list')); ?>">Grades</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('questions_list')); ?>">MCQ Exam</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('tasks.index')); ?>">To-do List</a>
            </li>
        </ul>

        <ul class="navbar-nav">
            <?php if(auth()->guard()->check()): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('profile')); ?>"><?php echo e(auth()->user()->name); ?></a>
                </li>
                <li class="nav-item">
                    <form action="<?php echo e(route('do_logout')); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn nav-link">Logout</button>
                    </form>
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
</nav>
</body>
</html><?php /**PATH D:\xampp\htdocs\web exersices\UsersTest_all\resources\views/layouts/menu.blade.php ENDPATH**/ ?>