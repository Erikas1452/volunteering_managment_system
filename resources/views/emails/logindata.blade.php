@component('mail::message')

<h1>Jūsų prašymas buvo patvirtintas</h1>
<h2>Nuo dabar galite naudotis sistema<h2>

<br>

<div>
    Prisijungimo vardas: {{$email}}
</div>

<div>
    Prisijungimo slaptažodis: {{$password}}
</div>

@component('mail::button', ['url' => 'http://localhost:8000/organization/home'])
Apsilankykite Volunteer+
@endcomponent


Dėkojame,<br>
Volunteer+
@endcomponent
