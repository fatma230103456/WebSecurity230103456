<?php return array (
  'providers' => 
  array (
    0 => 'Laravel\\Pail\\PailServiceProvider',
    1 => 'Laravel\\Sail\\SailServiceProvider',
    2 => 'Laravel\\Tinker\\TinkerServiceProvider',
    3 => 'Carbon\\Laravel\\ServiceProvider',
    4 => 'NunoMaduro\\Collision\\Adapters\\Laravel\\CollisionServiceProvider',
    5 => 'Termwind\\Laravel\\TermwindServiceProvider',
    6 => 'Spatie\\Permission\\PermissionServiceProvider',
    7 => 'Spatie\\Permission\\PermissionServiceProvider',
    8 => 'App\\Providers\\AppServiceProvider',
    9 => 'App\\Providers\\AuthServiceProvider',
    10 => 'App\\Providers\\AppServiceProvider',
  ),
  'eager' => 
  array (
    0 => 'Laravel\\Pail\\PailServiceProvider',
    1 => 'Carbon\\Laravel\\ServiceProvider',
    2 => 'NunoMaduro\\Collision\\Adapters\\Laravel\\CollisionServiceProvider',
    3 => 'Termwind\\Laravel\\TermwindServiceProvider',
    4 => 'Spatie\\Permission\\PermissionServiceProvider',
    5 => 'Spatie\\Permission\\PermissionServiceProvider',
    6 => 'App\\Providers\\AppServiceProvider',
    7 => 'App\\Providers\\AuthServiceProvider',
    8 => 'App\\Providers\\AppServiceProvider',
  ),
  'deferred' => 
  array (
    'Laravel\\Sail\\Console\\InstallCommand' => 'Laravel\\Sail\\SailServiceProvider',
    'Laravel\\Sail\\Console\\PublishCommand' => 'Laravel\\Sail\\SailServiceProvider',
    'command.tinker' => 'Laravel\\Tinker\\TinkerServiceProvider',
  ),
  'when' => 
  array (
    'Laravel\\Sail\\SailServiceProvider' => 
    array (
    ),
    'Laravel\\Tinker\\TinkerServiceProvider' => 
    array (
    ),
  ),
);