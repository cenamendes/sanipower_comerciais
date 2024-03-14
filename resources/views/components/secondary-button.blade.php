<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn mb-1 btn-secondary']) }}>
    {{ $slot }}
</button>
