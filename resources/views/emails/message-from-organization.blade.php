@component('mail::message')


<h1>Žinutė iš Savanorystės: "{{$activity}}"</h1>

<p>{{$message}}</p>

<h5>Iškylus klausimams rašykite:</h5>
<p>{{$organization}}</p>
<p>Elektroniniu paštu: {{$email}}</p>
<br>

@component('mail::button', ['url' => 'http://localhost:8000/volunteering'])
Apsilankykite Volunteer+
@endcomponent


Dėkojame,<br>
Volunteer+
@endcomponent
