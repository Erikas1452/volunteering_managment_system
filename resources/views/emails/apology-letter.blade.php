@component('mail::message')


<h1>Žinutė iš Savanorystės: "{{$activity}}"</h1>

<p>Apgailėstaujame, tačiau savanorystė į kurią registravotės buvo pašalinta ir nebevyks</p>

<h5>Maloniai Jūsų lauksime dalyvauti kitoje svanorystėje,</h5>
<p>{{$organization}}</p>
<p>Elektroninis paštas: {{$email}}</p>
<br>

@component('mail::button', ['url' => 'http://localhost:8000/volunteering'])
Apsilankykite Volunteer+
@endcomponent


Dėkojame,<br>
Volunteer+
@endcomponent
