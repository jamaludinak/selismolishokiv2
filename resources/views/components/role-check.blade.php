@props(['roles' => []])

@if(auth()->check() && auth()->user()->hasAnyRole($roles))
    <div {{ $attributes }}>
        {{ $slot }}
    </div>
@endif 