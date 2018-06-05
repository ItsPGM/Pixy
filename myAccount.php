<?php
$CSS = "cssMyAccount.css";
include 'includes/header.php';
$bdd = new PDO('mysql:host=localhost;dbname=pixy;charset=utf8', 'root', '');
if (!empty($_POST)) {
    $new_password = password_hash($_POST["pwd_change"], PASSWORD_BCRYPT);
    $name = $_SESSION["name"];
    $req = $bdd->prepare("UPDATE users SET password= :password WHERE name=:name");
    $req->bindParam(":password", $new_password);
    $req->bindParam(":name",$name);
    $req->execute();
}
?>
    <div id="info">
        <table>
            <tr>
                <td> Identifiant : </td>
                <td><?= $_SESSION["name"] ?></td>
            </tr>
            <tr>
                <form method="POST" action="myAccount.php">
                    <td> Mot de passe : </td>
                    <td>
                        <input type="text" placeholder="********" name="pwd_change">
                        <input type="submit" value="Changer mot de passe">
                    </td>
                </form>
            </tr>
            <tr>
                <td> Points : </td>
                <td> <?= $_SESSION["points"] ?> </td>
            </tr>
            <?php
            if ($_SESSION['rank'] == 1) {
                ?>
                <tr>
                    <td>Administration</td>
                    <td><a href="admin.php"><input type="button" value="Administration"></a></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>

<?php
include 'includes/footer.php';
?>