<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

?>
<h1>Weather Checker</h1>
<p>Ange en IP adress för att hitta väderinformation.</p>
<form method="post">
    <label for="ip"IP Adress: <label>
    <input type="text" name="ip" placeholder="Ange ip" value="<?= htmlentities($ip) ?>"><br>
    <input type="radio" name="days" value="week" required>Uppkommande 7 dagar<br>
    <input type="radio" name="days" value="month" required>Föregående 30 dagar<br>
    <input type="submit" name="check" value="Check">
</form>

<h4>Json</h4>
<p>Validera IP och visa information med JSON.</p>
<form action="./api_weather" method="get">
    <label for="ip"IP Adress: <label>
    <input type="text" name="ip" placeholder="Ange ip" value="<?= htmlentities($ip) ?>"><br>
    <input type="radio" name="days" value="week" required>Uppkommande 7 dagar<br>
    <input type="radio" name="days" value="month" required>Föregående 30 dagar<br>
    <input type="submit" value="Check">
</form>

<p>Formuläret skickar en GET-request till <code>./api_weather</code> med din IP adress likt <code>api_weather?ip=&lt;IP&gt;</code></p>
<p>Nästa argument anger du om du vill ha en väderrapport 7 dagar framåt eller 30 dagar bakåt genom att ange: <br><code>api_weather?ip=&lt;IP&gt;&amp;days=week</code> för 7 dagar framåt <br><code>api_weather?ip=&lt;IP&gt;&amp;days=month</code> för de 30 senaste dagarna.</p>
<p>Svaret visar relevant information i JSON format.</p>

<strong>Exempel routes</strong>
<p><a href="./api_weather?ip=8.8.8.8&days=week">8.8.8.8</a> Googles IP</p>
<p><a href="./api_weather?ip=8.8.8.8.8&days=week">8.8.8.8.8</a> Validerar ej</p>
