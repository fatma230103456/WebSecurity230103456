

<?php $__env->startSection('title', 'Questions List'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Questions List</h1>
    <a href="<?php echo e(route('questions_edit')); ?>" class="btn btn-success mb-3">Add Question</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Question</th>
                <th>Options</th>
                <th>Correct Answer</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($question->id); ?></td>
                    <td><?php echo e($question->question); ?></td>
                    <td>
                        A: <?php echo e($question->option_a); ?><br>
                        B: <?php echo e($question->option_b); ?><br>
                        C: <?php echo e($question->option_c); ?><br>
                        D: <?php echo e($question->option_d); ?>

                    </td>
                    <td><?php echo e($question->correct_answer); ?></td>
                    <td>
                        <a href="<?php echo e(route('questions_edit', $question->id)); ?>" class="btn btn-primary">Edit</a>
                        <a href="<?php echo e(route('questions_delete', $question->id)); ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Test\UsersTest\resources\views/questions/list.blade.php ENDPATH**/ ?>