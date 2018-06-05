<?php
$CSS = "style2.css";
include 'includes/header.php';

if (empty($_SESSION)) {
    header("Location: signup.php");
}

if (!empty($_SESSION['errors'])) {
    foreach ($_SESSION['errors'] as $e => $v) {
        echo '<br>Tu as faux à la question numéro ' . $e . ', la réponse était ' . (($v == "true") ? "vrai" : "faux") .  '<br>';
    }

    unset($_SESSION['errors']);
}

// unset($_SESSION['points']);
?>

<form method="POST" action="checkQuizz.php">

<?php

$questions = array(
    "'PC' signifie: 'Personal Computer' ?",
    "1Ko est égal à 2024 octects ?",
    "Un clavier 'AZERTY' est un clavier alphanumérique ?",
    "Un bit est égal à 16 couleurs ?",
    "Une adresse IP est un numéro d'identification attribué à un appareil connecté à un réseau informatique ?"
);

foreach ($questions as $key => $value) {
?>
    <table id="qTable" style="width:100%">
        <tr>
            <td id="qNumber"><b>Question n°<?= $key + 1 ?></b></td>
        </tr>
        <tr>
            <td id="qEnnonce"><?= $value ?></td>
        </tr>
        <tr>
            <td id="qBoxCoche">
                <input type="radio" id="right" name="q<?= $key + 1 ?>" value="true" required>
                <label for="right">Vrai</label>
                <input type="radio" id="false" name="q<?= $key + 1 ?>" value="false" required>
                <label for="false">Faux</label>
            </td>
        </tr>
    </table>
<?php
}
?>

<input type="submit" value="Valider">
</form>

<?php
include 'includes/footer.php';
?>