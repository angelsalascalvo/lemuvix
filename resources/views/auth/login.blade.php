@extends('layouts/master')

@section('title', 'Acceder')

@section('content')

 <!-- TITULO -->
 <div class="col100">
    <center>
    <div class="titleHeader">
        <h1>
            Acceder
        </h1>
        <div class="subTitleHeader">
        </div>
    </div>
    </center>
</div>


<!-- CONTENIDO -->
<center>
    <div id="formLoginSystem">
        <div class="marginFormLoginSystem col100">
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="groupField @error('email') invalid @enderror">
                <input id="email" type="email" class="inpForm" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder=" ">
                <label class="labForm" for="email">Email</label>
                @error('email')
                    <div class="invalidTxt">{{ $message }}</div>
                @enderror
                <br>
            </div>

            <div class="groupField @error('password') invalid @enderror">
                    <input id="password" type="password" class="inpForm inpFormPwd" name="password" required autocomplete="current-password" placeholder=" ">
                    <label class="labForm" for="password">Contraseña</label>
                @error('password')
                    <div class="invalidTxt invalidTxtPwd">{{ $message }}</div>
                @enderror
                <br>
            </div>


            <div class="rowCheckBox">
                <input class="form-check-input checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="labCheckBox" for="admin">Recuerdame</label>
                <br>
            </div>

            <input class="bSubmit button" class="button" type="submit" value="Acceder">


            @if (Route::has('password.request'))
                <div class="restorePwd">
                    <a href="{{ route('password.request') }}">
                        <span>¿Has olvidado tu contraseña?<span>
                    </a>
                </div>
            @endif
        </form>
    </div>
@endsection
