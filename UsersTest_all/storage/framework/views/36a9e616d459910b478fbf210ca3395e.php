

<?php $__env->startSection('title', 'Grades List'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Grades List</h1>
    <a href="<?php echo e(route('grades_edit')); ?>" class="btn btn-success mb-3">Add Grade</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Student ID</th>
                <th>Course ID</th>
                <th>Grade</th>
                <th>Term</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $grades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($grade->id); ?></td>
                    <td><?php echo e($grade->student_id); ?></td>
                    <td><?php echo e($grade->course_id); ?></td>
                    <td><?php echo e($grade->grade); ?></td>
                    <td><?php echo e($grade->term); ?></td>
                    <td>
                        <a href="<?php echo e(route('grades_edit', $grade->id)); ?>" class="btn btn-primary">Edit</a>
                        <a href="<?php echo e(route('grades_delete', $grade->id)); ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\web exersices\UsersTest_all\resources\views/grades/list.blade.php ENDPATH**/ ?>