<?php
$CSS = "cssSignup.css";
include "includes/header.php";

if (!empty($_POST) || !empty($_SESSION)) {
	
	$name = htmlspecialchars($_POST['login']);
	$password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_BCRYPT);
	
	$bdd = new PDO('mysql:host=localhost;dbname=pixy;charset=utf8', 'root', '');
	
	$req = $bdd->prepare("SELECT name FROM users WHERE name = :name");
	$req->bindParam(':name', $name);
	$req->execute();
	
	if ($req->rowCount() > 0) {
		print("Ce nom d'utilisateur existe déjà !");
	} else {
		$req = $bdd->prepare('INSERT INTO users(name, password) VALUES(:name, :password)');
		$req->bindParam(":name", $name);
		$req->bindParam(":password", $password);
		$req->execute();
		
		$_SESSION["name"] = $name;
		$_SESSION["password"] = $password;
		$_SESSION["points"] = 0;
		$_SESSION["rank"] = 0;

		header("Location: index.php");
	}	
}
?>
		<h3 id="inscri"><b>Inscription</b></h3>
		<form method="post" action="signup.php" id="input" >
			<label>Identifiants :</label>
			<input type="text" name="login" />
			<label>Mot de passe :</label>
			<input type="password" name="password" />
			<input type="submit" />
		</form>
			<a href="index.php"><button id="ac" type="button">Retourner à l'accueil</button></a>
        </div>
<?php
include "includes/footer.php";
?>