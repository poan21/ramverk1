<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

?>
<h1>IP Checker</h1>

<?php
if ($ip) {?>
    <p>IP: <?= htmlentities($ip) ?></p>
    <p>Valid: <?= htmlentities($valid) ?></p>
    <p>Domain: <?= htmlentities($host) ?></p>
    <?php
} else {
    ?>
    <p>Ingen hittad IP</p>
    <?php
}
?>
<a href="">Gå tillbaka?</a>
