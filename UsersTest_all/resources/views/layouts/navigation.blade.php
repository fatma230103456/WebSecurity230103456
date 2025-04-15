<x-nav-link :href="route('tasks.index')" :active="request()->routeIs('tasks.index')">
    {{ __('To-Do List') }}
</x-nav-link>