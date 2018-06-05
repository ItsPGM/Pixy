<?php
$CSS = "cssSignin.css";
include "includes/header.php";

if (!empty($_POST) || !empty($_SESSION)) {
	
	var_dump($_POST);
	
	$name = $_POST['login'];
	$password = $_POST['password'];
	
	$bdd = new PDO('mysql:host=localhost;dbname=pixy;charset=utf8', 'root', '');
	
	$req = $bdd->prepare("SELECT * FROM users WHERE name = :name");
	$req->bindParam(':name', $name);
	$req->execute();
	
	if ($req->rowCount() > 0) {
		$result = $req->fetch();
		var_dump(password_hash($password, PASSWORD_BCRYPT));
		
		if (password_verify($password, $result["password"])) {
			print("Bon mot de passe !");
			
			$_SESSION["name"] = $name;
			$_SESSION["password"] = $result["password"];
			$_SESSION["points"] = $result["points"];
			$_SESSION["rank"] = $result["rank"];

			header("Location: index.php");
		} else {
			print("Le mot de passe ne correspond pas !");
		}
	} else {
		print("Ce nom d'utilisateur n'existe pas !");
	}	
}
?>
            <h3 id="connex"><b>Connexion</b></h3>
            <form method="post" action="signin.php" id="input">
                <label>Identifiants :</label>
                <input type="text" name="login"/>
                <label>Mot de passe :</label>
                <input type="password" name="password"/>
                <input type="submit"/>
            </form>
                <a href="index.php"><button id="ac" type="button">Retourner à l'accueil</button></a>
        </div>
<?php
include "includes/footer.php";
?>