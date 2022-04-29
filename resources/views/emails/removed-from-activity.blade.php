@component('mail::message')


<h1>Apgailėstaujame tačiau dėl tam tikrų priežasčių iš savanorystės: "{{$activity}}"
    buvote pašalinti
</h1>

<br>

@component('mail::button', ['url' => 'http://localhost:8000/volunteering'])
Apsilankykite Volunteer+ ir pabandykite užsiregistruoti kitur
@endcomponent


Dėkojame,<br>
Volunteer+
@endcomponent
