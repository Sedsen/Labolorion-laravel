@extends('lorion/template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" style="margin:100px 0;">
            <div class="card">
                <div class="card-header text-light" style="background-color:rgba(255, 255, 255, 0.5);" >{{ __('Vérifier votre address email') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Un lien de vérification vous a été envoyé par mail. ') }}
                        </div>
                    @endif

                    {{ __('Avant de poursuivre, vérifier le lien de vérification que nous vous avons envoyé par mail.') }}
                    {{ __("Si vous n'avez pas reçu d'email,") }}, <a href="{{ route('verification.resend') }}">{{ __('Clicker ici') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
