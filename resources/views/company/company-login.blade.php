@extends('volunteer.volunteer-main')
@section('content')
<main id="main">

    <div class="padding container d-flex justify-content-center">
        <div class="col-md-10 col-md-offset-1">
            <form method="POST" class="signup-form" action="{{route('company.authenticate')}}" enctype="multipart/form-data">
                @csrf
                <h2 class="text-center">Prisijungimas</h2>
                <hr>
                <div class="form-group"> <input type="email" name="email" class="form-control" placeholder="El. Paštas" required="required"> </div>
                    <span class="text-danger">{{session()->get('email')}}</span>
                <div class="form-group"> <input type="password" name="password" class="form-control" placeholder="Slaptažodis" required="required"> </div>
                    <span class="text-danger">{{session()->get('password')}}</span>
                <div class="flex items-center justify-end mt-4">
               
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('Pamiršau slaptažodį') }}
                        </a>
                    @endif
                <div class="form-group text-center"> <button type="submit" class="btn btn-blue btn-block">Prisijungti</button> </div>
            </form>
        </div>
    </div>

  </main><!-- End #main -->
  @endsection