@component('mail::message')

<h1>Atsiprašome, tačiau Jūsų prašymas buvo atmestas</h1>
<h2>Jūsų pateiktų duomenų neužteko<h2>

<br>

<div>
    Jeigu manote kad įsivėlė klaida susisiekite su mūsų administracija arba bandykite iš naujo
</div>

@component('mail::button', ['url' => 'http://localhost:8000/organization/home'])
Apsilankyti Volunteer+
@endcomponent


Dėkojame,<br>
Volunteer+
@endcomponent
