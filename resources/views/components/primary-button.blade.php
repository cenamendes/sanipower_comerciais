<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn mt-6 mb-1 btn-primary']) }}>
    {{ $slot }}
</button>
