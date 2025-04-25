<?php $__env->startSection('title', 'Welcome'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Welcome to Laravel Exercises</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Math Exercises -->
                        <div class="col-md-4 mb-4">
                            <h5 class="mb-3">Math Exercises</h5>
                            <div class="list-group">
                                <a href="<?php echo e(url('/multable')); ?>" class="list-group-item list-group-item-action">Multiplication Table</a>
                                <a href="<?php echo e(url('/even')); ?>" class="list-group-item list-group-item-action">Even Numbers</a>
                                <a href="<?php echo e(url('/prime')); ?>" class="list-group-item list-group-item-action">Prime Numbers</a>
                                <a href="<?php echo e(url('/Calculator')); ?>" class="list-group-item list-group-item-action">Calculator</a>
                            </div>
                        </div>

                        <!-- Data Display -->
                        <div class="col-md-4 mb-4">
                            <h5 class="mb-3">Data Display</h5>
                            <div class="list-group">
                                <a href="<?php echo e(url('/bill')); ?>" class="list-group-item list-group-item-action">Bill Display</a>
                                <a href="<?php echo e(url('/Transcript')); ?>" class="list-group-item list-group-item-action">Transcript</a>
                                <a href="<?php echo e(url('/Products')); ?>" class="list-group-item list-group-item-action">Products</a>
                                <a href="<?php echo e(route('products_list')); ?>" class="list-group-item list-group-item-action">Products List</a>
                            </div>
                        </div>

                        <!-- User Management -->
                        <div class="col-md-4 mb-4">
                            <h5 class="mb-3">User Management</h5>
                            <div class="list-group">
                                <?php if(auth()->guard()->check()): ?>
                                    <a href="<?php echo e(route('profile')); ?>" class="list-group-item list-group-item-action">My Profile</a>
                                    <?php if(auth()->user()->canEditUsers()): ?>
                                        <a href="<?php echo e(route('users.index')); ?>" class="list-group-item list-group-item-action">Manage Users</a>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <a href="<?php echo e(route('login')); ?>" class="list-group-item list-group-item-action">Login</a>
                                    <a href="<?php echo e(route('register')); ?>" class="list-group-item list-group-item-action">Register</a>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Academic Features -->
                        <div class="col-md-4 mb-4">
                            <h5 class="mb-3">Academic Features</h5>
                            <div class="list-group">
                                <a href="<?php echo e(route('questions_list')); ?>" class="list-group-item list-group-item-action">Questions</a>
                                <a href="<?php echo e(route('questions_exam')); ?>" class="list-group-item list-group-item-action">Take Exam</a>
                                <a href="<?php echo e(route('grades_list')); ?>" class="list-group-item list-group-item-action">Grades</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\web exersices\UsersTest_all\resources\views/welcome.blade.php ENDPATH**/ ?>