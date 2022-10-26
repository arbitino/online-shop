@extends('layouts.auth')

@section('title', 'Регистрация')

@section('content')
    <x-forms.auth-forms title="Регистрация" action="{{ route('signUp') }}" method="POST">
        <x-slot:form>
            @csrf
            <x-forms.text-input
                type="text"
                name="name"
                placeholder="Имя"
                :required="true"
                value="{{ old('name') }}">
            </x-forms.text-input>

            <x-forms.text-input
                type="email"
                name="email"
                placeholder="E-mail"
                :required="true"
                value="{{ old('email') }}"
                :isError="$errors->has('email')">
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

            @error('password')
            <x-forms.error>
                {{ $message }}
            </x-forms.error>
            @enderror

            <x-forms.text-input
                type="password"
                name="password_confirmation"
                placeholder="Повторите пароль"
                :required="true"
                :isError="$errors->has('password_confirmation')">
            </x-forms.text-input>

            @error('password_confirmation')
            <x-forms.error>
                {{ $message }}
            </x-forms.error>
            @enderror

            <x-forms.submit>Зарегистрироваться</x-forms.submit>
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
                    <a href="{{ route('login') }}" class="text-white hover:text-white/70 font-bold">
                        Авторизация
                    </a>
                </div>
            </div>
        </x-slot:buttons>

    </x-forms.auth-forms>
@endsection
