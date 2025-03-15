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

 </ul>

<ul class="navbar-nav">
    @auth
    <li class="nav-item"><a class="nav-link">{{auth()->user()->name}}</a></li>
    <li class="nav-item"><a class="nav-link" href="{{route('do_logout')}}">Logout</a></li>
    @else
    <li class="nav-item"><a class="nav-link" href="{{route('login')}}">Login</a></li>
    @endauth
    <li class="nav-item"><a class="nav-link" href="{{route('register')}}">Register</a></li>
 </ul>

 </div>
</nav>
</body>
</html>