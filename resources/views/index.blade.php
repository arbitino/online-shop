@extends('layouts.auth')

@section('content')
    @auth
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn">Выйти</button>
        </form>
    @endauth
@endsection
