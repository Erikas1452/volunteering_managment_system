@component('mail::message')


<h1>Žinutė iš Savanorio: "{{$volunteer}}"</h1>
<h3>Savanorystė: "{{$activity}}"</h3>

<p>{{$message}}</p>

<br>
<br>

Savanorio informacija:
<p>{{$volunteer}}</p>
<p>Elektroninis paštas: {{$email}}</p>
<br>

Volunteer+
@endcomponent
