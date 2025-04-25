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

 <ul class="navbar-nav">

 <li class="nav-item">
 <a class="nav-link" href="./">Home</a>
 </li>

 <li class="nav-item">
 <a class="nav-link" href="./even">Even Numbers</a>
 </li>
 <li class="nav-item">
 <a class="nav-link" href="./prime">Prime Numbers</a>
 </li>
 <li class="nav-item">
 <a class="nav-link" href="./multable">Multiplication Table</a>
 </li>

 <li class="nav-item">
 <a class="nav-link" href="./bill"> bill page</a>
 </li>

 <li class="nav-item">
 <a class="nav-link" href="./Transcript"> Transcript page</a>
 </li>

 <li class="nav-item">
 <a class="nav-link" href="./Products"> Products page</a>
 </li>

 <li class="nav-item">
 <a class="nav-link" href="./Calculator"> Calculator page</a>
 </li>

 <li class="nav-item">
 <a class="nav-link" href="./products"> Products </a>
 </li>

 <li class="nav-item">
 <a class="nav-link" href="./users"> user </a>
</li>
            <li class="nav-item">
                <a class="nav-link" href="/grades">Grades</a>
            </li>
        
            <li class="nav-item">
                <a class="nav-link" href="/questions">MCQ Exam</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/questions">To-do list</a>
            </li>

 </ul>

<ul class="navbar-nav">
    <?php if(auth()->guard()->check()): ?>
    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('profile')); ?>"><?php echo e(auth()->user()->name); ?></a></li>
    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('do_logout')); ?>">Logout</a></li>
    <?php else: ?>
    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('login')); ?>">Login</a></li>
    <?php endif; ?>
    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('register')); ?>">Register</a></li>
 </ul>

 </div>
</nav>
</body>
</html><?php /**PATH C:\xampp\htdocs\Test\UsersTest\resources\views/layouts/menu.blade.php ENDPATH**/ ?>