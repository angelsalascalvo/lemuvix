@extends('layouts/master')

@section('title', 'Recuperar Contraseña')

@section('content')

 <!-- TITULO -->
 <div class="col100">
    <center>
    <div class="titleHeader">
        <h1>
            Has olvidado tu contraseña?
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

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="infoForm">
                <span>Introduce el email asociado a tu cuenta para recibir las instrucciones de recuperacion.<span>
            </div>
            <div class="groupField @error('email') invalid @enderror">
                <input id="email" type="email" class="inpForm" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder=" ">
                <label class="labForm" for="email">Email</label>
                @error('email')
                    <div class="invalidTxt">{{ $message }}</div>
                @enderror
                <br>
            </div>

            <input class="bSubmit button" class="button" type="submit" value="Recuperar">
        </form>
    </div>

    <script>
        /**
        * INICIO DE EJECUCION
        */
        $(document).ready(function() {
            //Mostrar mensaje informativo en ventana emergente si existe
            @if (session('status'))
                modalWindow("{{ session('status') }}", 0, null);
            @endif
        });
    </script>
@endsection
