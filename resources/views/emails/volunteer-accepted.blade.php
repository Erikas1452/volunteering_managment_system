@component('mail::message')


<h1>Sveikiname jūs buvote priimti į savanorystę: "{{$activity}}"</h1>

<br>

@component('mail::button', ['url' => 'http://localhost:8000/volunteering'])
Apsilankykite Volunteer+
@endcomponent


Dėkojame,<br>
Volunteer+
@endcomponent
