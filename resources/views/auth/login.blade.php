@extends('layouts.auth')

@section('title', 'Авторизация')

@section('content')
    <x-forms.auth-forms title="Вход в аккаунт" action="{{ route('login.handle') }}" method="POST">
        <x-slot:form>
            @csrf

            <x-forms.text-input
                type="email"
                name="email"
                placeholder="E-mail"
                :required="true"
                :isError="$errors->has('email')"
                value="{{ old('email') }}">
            </x-forms.text-input>

            @error('email')
            <x-forms.error>
                {{ $message }}
            </x-forms.error>
            @enderror

            <x-forms.text-input
                type="password"
                name="password"
                placeholder="Пароль"
                :required="true"
                :isError="$errors->has('password')">
            </x-forms.text-input>

            <x-forms.submit>Войти</x-forms.submit>
        </x-slot:form>

        <x-slot:socialAuth>
            <ul class="space-y-3 my-2">
                <li>
                    <x-forms.social-github></x-forms.social-github>
                </li>
            </ul>
        </x-slot:socialAuth>

        <x-slot:buttons>
            <div class="space-y-3 mt-5">
                <div class="text-xxs md:text-xs">
                    <a href="{{ route('forgot') }}" class="text-white hover:text-white/70 font-bold">
                        Забыли пароль?
                    </a>
                </div>
                <div class="text-xxs md:text-xs">
                    <a href="{{ route('register') }}" class="text-white hover:text-white/70 font-bold">
                        Регистрация
                    </a>
                </div>
            </div>
        </x-slot:buttons>

    </x-forms.auth-forms>
@endsection
