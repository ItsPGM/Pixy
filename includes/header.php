<?php
session_start();

var_dump($_SESSION);
?>

<html>
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" type="text/css" href="css/<?= $CSS ?>" />
    </head>
<body>
    <div id="header">
        <h1>Pixy</h1>
        <img src="images/logo.png" alt="Logo Pixy" height="125" width="200" >
        <a href="index.php"><button>Accueil</button></a>
        <?php
        if (empty($_SESSION['name'])) {
            ?>
            <a href="signup.php"><button>Inscription</button></a>
            <a href="signin.php"><button>Connexion</button></a>
            <?php
        } else {
            ?>
            <a href="signout.php"><button>Déconnexion</button></a>
            <a href="myAccount.php"><button>Mon compte</button></a>
            <?php
        }
        ?>
    </div>
    <div id="body">