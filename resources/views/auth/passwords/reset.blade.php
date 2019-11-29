@extends('layouts/master')


@section('title', 'Recuperar Contraseña')

@section('content')

 <!-- TITULO -->
 <div class="col100">
    <center>
    <div class="titleHeader">
        <h1>
            Recuperar Contraseña
        </h1>
        <div class="subTitleHeader">
        </div>
    </div>
    </center>
</div>


<!-- CONTENIDO -->
<center>
    <div id="formLoginSystem">
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="groupField @error('email') invalid @enderror">
                <input id="email" type="email" class="inpForm" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder=" ">
                <label class="labForm" for="email">Email</label>
                @error('email')
                    <div class="invalidTxt">{{ $message }}</div>
                @enderror
                <br>
            </div>

            <div class="groupField @error('password') invalid @enderror">
                <input id="password" type="password" class="inpForm" name="password" value="{{ old('password') }}" required placeholder=" ">
                <label class="labForm" for="password">Contraseña</label>
                @error('password')
                    <div class="invalidTxt">{{ $message }}</div>
                @enderror
                <br>
            </div>

            <div class="groupField">
                <input id="password-confirm" type="password" class="inpForm" name="password_confirmation" value="{{ old('password-confirm') }}" required placeholder=" ">
                <label class="labForm" for="password">Confirmar contraseña</label>
                <br>
            </div>

            <input class="bSubmit button" class="button" type="submit" value="Guardar">
        </form>
    </div>

@endsection