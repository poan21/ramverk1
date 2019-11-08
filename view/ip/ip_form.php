<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

?>
<h1>IP Checker</h1>
<p>Ange en IP adress som vi kan kolla om den är en giltlig ip4 eller ip6 adress.</p>
<form method="post">
    <label for="ip"IP Adress: <label>
    <input type="text" name="ip" placeholder="Ange ip">
    <input type="submit" name="check" value="Check">
</form>

<h4>Json</h4>
<p>Validera IP och visa information med JSON.</p>
<form action="./json" method="get">
    <label for="ip"IP Adress: <label>
    <input type="text" name="ip" placeholder="Ange ip">
    <input type="submit" value="Check">
</form>

<p>Formuläret skickar en GET-request till <code>./json</code> med din IP adress likt <code>json?ip=&lt;IP&gt;</code></p>
<p>Svaret visar relevant information i JSON format.</p>

<strong>Exempel routes</strong>
<p><a href="./json?ip=8.8.8.8">8.8.8.8</a> Googles IP</p>
<p><a href="./json?ip=8.8.8.8.8">8.8.8.8.8</a> Validerar ej</p>
