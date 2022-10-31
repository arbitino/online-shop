@extends('layouts.auth')

@section('title', 'Сброс пароля')

@section('content')
    <x-forms.auth-forms title="Сброс пароля" action="{{ route('reset.handle') }}" method="POST">
        <x-slot:form>
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

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

            <x-forms.submit>Сохранить</x-forms.submit>
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
