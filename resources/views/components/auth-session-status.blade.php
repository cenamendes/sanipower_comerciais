@props(['status'])

@if ($status)
    <div style="color:#57a0d2;" {{ $attributes->merge(['class' => 'font-medium text-sm text-green-600 dark:text-green-400']) }}>
        Enviamos email para recuperar a sua password.
    </div>
@endif
