

<?php $__env->startSection('title', 'Profile'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <!-- Profile Information -->
        <div class="col-md-6">
            <div class="card mt-4">
                <div class="card-header">
                    <h4 class="mb-0">Profile</h4>
                </div>
                <div class="card-body">
                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <?php if(session('success')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>

                    <form action="<?php echo e(route('users.update', $user)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo e($user->name); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo e($user->email); ?>" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </form>

                    <hr>

                    <h4 class="mt-4">Change Password</h4>
                    <form action="<?php echo e(route('users.update-password', $user)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <?php if(Auth::id() === $user->id): ?>
                        <div class="mb-3">
                            <label for="old_password" class="form-label">Old Password</label>
                            <input type="password" class="form-control" id="old_password" name="old_password" required>
                        </div>
                        <?php endif; ?>

                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                        </div>

                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Password</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Roles and Permissions -->
        <div class="col-md-6">
            <div class="card mt-4">
                <div class="card-header">
                    <h4 class="mb-0">User Information</h4>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h5>Name</h5>
                        <p class="mb-0"><?php echo e($user->name); ?></p>
                    </div>

                    <div class="mb-4">
                        <h5>Email</h5>
                        <p class="mb-0"><?php echo e($user->email); ?></p>
                    </div>

                    <div class="mb-4">
                        <h5>Roles</h5>
                        <?php if($user->role): ?>
                            <span class="badge bg-primary"><?php echo e($user->role->name); ?></span>
                        <?php else: ?>
                            <p class="text-muted mb-0">No roles assigned</p>
                        <?php endif; ?>
                    </div>

                    <div class="mb-4">
                        <h5>Direct Permissions</h5>
                        <?php if($user->role && $user->role->permissions->isNotEmpty()): ?>
                            <?php $__currentLoopData = $user->role->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="badge bg-success me-1"><?php echo e($permission->name); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <p class="text-muted mb-0">No direct permissions</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\web exersices\UsersTest_all\resources\views/users/profile.blade.php ENDPATH**/ ?>