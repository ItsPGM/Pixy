<?php

session_start();
$errors = array();

$bdd = new PDO('mysql:host=localhost;dbname=pixy;charset=utf8', 'root', '');

/*

Q1 : Vrai
Q2 : Faux
Q3 : Vrai
Q4 : Faux
Q5 : Vrai

*/

var_dump($_POST);

$points = 0;

$answers = array(
    "1" => "true",
    "2" => "false",
    "3" => "true",
    "4" => "false",
    "5" => "true"
);

for ($i = 1; $i < 6; $i++) {
    if ($_POST["q" . $i] == $answers[$i]) {
        $points++;
    } else {
        $errors[$i] = $answers[$i];
    }
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
}

$name = $_SESSION["name"];

$req = $bdd->prepare("UPDATE users SET points= points + :points WHERE name=:name");
$req->bindParam(":points",$points);
$req->bindParam(":name",$name);

$req->execute();

$req = $bdd->prepare("SELECT points FROM users WHERE name=:name");
$req->bindParam(":name",$name);

$req->execute();

unset($_SESSION["points"]);
$_SESSION["points"] = $req->fetch()[0];

header("Location: quizz.php");

?>
