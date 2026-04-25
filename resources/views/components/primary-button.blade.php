<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn-primary py-2.5 px-6 text-sm']) }}>
    {{ $slot }}
</button>
