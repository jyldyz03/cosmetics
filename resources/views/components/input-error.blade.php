@props(['messages' => []])

@if (count($messages) > 0)
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 space-y-1']) }}>
        @foreach ($messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
