@component('mail::message')
    @slot('header')
    @endslot

    @if (!empty($greeting))
        # {{ $greeting }}
    @else
        @if ($level === 'error')
            # @lang('Whoops!')
        @else
            # @lang('Hello!')
        @endif
    @endif

    @foreach ($introLines as $line)
        {{ $line }}
    @endforeach

    @isset($actionText)
        @php
            $color = match ($level) {
                'success', 'error' => $level,
                default => 'primary',
            };
        @endphp
        @component('mail::button', ['url' => $actionUrl, 'color' => $color])
            {{ $actionText }}
        @endcomponent
    @endisset

    @foreach ($outroLines as $line)
        {{ $line }}
    @endforeach

    @if (!empty($salutation))
        {{ $salutation }}
    @else
        @lang('Regards'),
        {{ config('app.name') }}
    @endif
@endcomponent
