<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn mb-1 btn-danger mt-6']) }}>
    {{ $slot }}
</button>
