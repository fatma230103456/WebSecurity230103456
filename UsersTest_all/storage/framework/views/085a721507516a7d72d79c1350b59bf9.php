

<?php $__env->startSection('title', 'Users List'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Users List</h1>

    <form action="<?php echo e(route('users_list')); ?>" method="get" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" value="<?php echo e($filters['name'] ?? ''); ?>" placeholder="Filter by name">
            </div>
            <div class="col-md-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" name="email" value="<?php echo e($filters['email'] ?? ''); ?>" placeholder="Filter by email">
            </div>
            <div class="col-md-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-select" name="role">
                    <option value="">All Roles</option>
                    <option value="admin" <?php echo e(isset($filters['role']) && $filters['role'] == 'admin' ? 'selected' : ''); ?>>Admin</option>
                    <option value="user" <?php echo e(isset($filters['role']) && $filters['role'] == 'user' ? 'selected' : ''); ?>>User</option>
                    <option value="student" <?php echo e(isset($filters['role']) && $filters['role'] == 'student' ? 'selected' : ''); ?>>Student</option>
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="<?php echo e(route('users_list')); ?>" class="btn btn-secondary ms-2">Reset</a>
            </div>
        </div>
    </form>

    <a href="<?php echo e(route('users_edit')); ?>" class="btn btn-success mb-3">Add User</a>
    <table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
        <tbody>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($user->id); ?></td>
                    <td><?php echo e($user->name); ?></td>
                    <td><?php echo e($user->email); ?></td>
                    <td><?php echo e($user->role); ?></td>
                    <td>
                        <a href="<?php echo e(route('users.edit', $user->id)); ?>" class="btn btn-primary">Edit</a>
                        <form action="<?php echo e(route('users.destroy', $user->id)); ?>" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Test\UsersTest\resources\views/users/list.blade.php ENDPATH**/ ?>