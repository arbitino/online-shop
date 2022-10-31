@extends('layouts.auth')

@section('title', 'Восстановление пароля')

@section('content')
    <x-forms.auth-forms title="Восстановление пароля" action="{{ route('forgot.handle') }}" method="POST">
        <x-slot:form>
            @csrf

            <x-forms.text-input
                type="email"
                name="email"
                placeholder="E-mail"
                :required="true"
                :isError="$errors->has('email')">
            </x-forms.text-input>

            @error('email')
            <x-forms.error>
                {{ $message }}
            </x-forms.error>
            @enderror

            <x-forms.submit>Отправить</x-forms.submit>
        </x-slot:form>

        <x-slot:socialAuth></x-slot:socialAuth>

        <x-slot:buttons>
            <div class="space-y-3 mt-5">
                <div class="text-xxs md:text-xs">
                    <a href="{{ route('login') }}" class="text-white hover:text-white/70 font-bold">
                        Войти
                    </a>
                </div>
            </div>
        </x-slot:buttons>

    </x-forms.auth-forms>
@endsection
