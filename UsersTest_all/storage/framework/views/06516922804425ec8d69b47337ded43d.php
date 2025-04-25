

<?php $__env->startSection('title', 'Register'); ?>

<?php $__env->startSection('content'); ?>

<div class="container">
<form action="<?php echo e(route('do_register')); ?>" method="post">
  <?php echo e(csrf_field()); ?>

  <div class="form-group mb-2">
    <label for="code" class="form-label">Name:</label>
    <input type="text" class="form-control" placeholder="name" name="name" required>
  </div>
  <div class="form-group mb-2">
    <label for="model" class="form-label">Email:</label>
    <input type="email" class="form-control" placeholder="email" name="email" required>
  </div>
  <div class="form-group mb-2">
    <label for="model" class="form-label">Password:</label>
    <input type="password" class="form-control" placeholder="password" name="password" required>
  </div>
  <div class="form-group mb-2">
    <label for="model" class="form-label">Password Confirmation:</label>
    <input type="password" class="form-control" placeholder="Confirmation" name="password_confirmation" required>
  </div>
  <div class="form-group mb-2">
    <button type="submit" class="btn btn-primary">Register</button>
  </div>
    <?php if(request()->error): ?>
    <div class="alert alert-danger">
        <strong> Error!</strong> <?php echo e(request()->error); ?>

    </div>
    <?php endif; ?>
 </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Test\UsersTest\resources\views/users/register.blade.php ENDPATH**/ ?>