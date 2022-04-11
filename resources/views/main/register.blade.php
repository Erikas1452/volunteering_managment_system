@extends('volunteer.volunteer-main')
@section('content')
<main id="main">

    <div class="padding container d-flex justify-content-center">
        <div class="col-md-10 col-md-offset-1">
            <form method="POST" class="signup-form" action="{{route('register.volunteer')}}" enctype="multipart/form-data">
                @csrf
                <h2 class="text-center">Registracija</h2>
                <hr>
                <div class="form-group"> <input type="text" name="full_name" class="form-control" placeholder="Vardas" required="required"> </div>
                @error('full_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="form-group"> <input type="email" name="email" class="form-control" placeholder="El. Paštas" required="required"> </div>
                @error('email')
                    <span class="text-danger">Toks el.paštas jau egzistuoja</span>
                @enderror
                <div class="form-group"> <input type="password" name="password" class="form-control" placeholder="Slaptažodis" required="required"> </div>
                @error('password')
                    <span class="text-danger">Slaptažodis turi būti ne trumpesnis kaip 8 simboliai</span>
                @enderror
                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('Jau esate užsiregistravę?') }}
                    </a>
                </div>
                <div class="form-group text-center"> <button type="submit" class="btn btn-blue btn-block">Registruotis</button> </div>
            </form>
        </div>
    </div>

  </main><!-- End #main -->
  @endsection