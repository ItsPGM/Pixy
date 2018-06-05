<?php
$CSS = "cssAdmin.css";
include 'includes/header.php';
$bdd = new PDO('mysql:host=localhost;dbname=pixy;charset=utf8', 'root', '');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (!empty($_POST)) {
    $id = $_POST["id"];

    $req = $bdd->prepare("DELETE FROM users WHERE id = :id");
    $req->bindParam(":id", $id);
    $req->execute();
}
?>
    <table>
        <tr>
            <th>Nom</th>
            <th>Points</th>
            <th>Rank</th>
            <th>Actions</th>
        </tr>
        <?php
        $req = $bdd->query("SELECT * FROM users");
        $users = $req->fetchAll();
        foreach ($users as $row) {
        ?>
        <tr>
            <td><?= $row["name"] ?></td>
            <td><?= $row["points"] ?></td>
            <td><?= $row["rank"] ?></td>
            <form action="admin.php" method="POST">
                <input type="hidden" value="<?= $row["id"] ?>" name="id">

            <td>
                    <input type="submit" value="Supprimer">
                </form>
            </td>
            <?php
            }
            ?>
            </tr>
    </table>
<?php
include 'includes/footer.php';
?>