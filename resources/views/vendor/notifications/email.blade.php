@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Whoops!')
@else
# @lang('Bienvenue chez Lorion Education!')
@endif
@endif


{{-- Intro Lines 
@foreach ($introLines as $line)
{{ $line }}

@endforeach --}}
  @php
     echo "Vous recevez cet e-mail parce que nous avons reçu de votre part une demande de réinitialisation de votre mot de passe.";
 @endphp 

{{-- Action Button --}}
@isset($actionText)

<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
 {{--$actionText --}}
  @php
    echo 'Réinitialiser le mot de passe';
@endphp 
@endcomponent
@endisset
@php
    echo "Ce lien de réinitialisation de mot de passe expire dans 60 minutes. \n "
@endphp
{{-- Outro Lines 
@foreach ($outroLines as $line)
{{ $line }}

@endforeach --}}


{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('Recevez nos salutations chaleureuses!'),<br>{{ config('app.name') }}
@endif

{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
@lang(
     "Si vous rencontrez des problèmes s'il vous plait cliquer sur le bouton \"Réinitialiser le mot de passe\", ou copiez et collez le lien ci-dessous \n". 
    'dans votre navigateur [:actionURL](:actionURL)',
    [
        'actionText' => $actionText,
        'actionURL' => $actionUrl,
    ]
)
@endslot
@endisset
@endcomponent
