

<?php $__env->startSection('title', 'User Profile'); ?>

<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="card m-4">
        <div class="card-header">Profile</div>
        <div class="card-body">
            <table class="table">
                <tr><th>Name</th><td><?php echo e($user->name); ?></td></tr>
                <tr><th>Email</th><td><?php echo e($user->email); ?></td></tr>
                <tr><th>Roles</th>
                    <td>
                        <?php if($user->roles): ?>
                            <?php $__currentLoopData = $user->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span><?php echo e($user->role->name ?? 'No Role Assigned'); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <span>No Role Assigned</span>
                        <?php endif; ?>
                    </td>
                </tr>

            </table>

            <form method="POST" action="<?php echo e(route('profile.update-password')); ?>">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label>Old Password</label>
                    <input type="password" class="form-control" name="old_password" required>
                </div>
                <div class="mb-3">
                    <label>New Password</label>
                    <input type="password" class="form-control" name="new_password" required>
                </div>
                <div class="mb-3">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" name="new_password_confirmation" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Password</button>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Test\UsersTest\resources\views/users/profile.blade.php ENDPATH**/ ?>