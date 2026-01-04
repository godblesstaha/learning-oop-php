<?php
require "connexion.php";
$req1 = "SELECT * FROM forums";
$stmt1 = $con->prepare($req1);
$stmt1->execute();
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">

<table class="table align-middle">
    <thead class="table-light">
        <tr>
            <th>Répertoire</th>
            <th class="text-center">Discussions</th>
            <th class="text-center">Messages</th>
            <th>Dernier message</th>
        </tr>
    </thead>
    <tbody>

<?php
while ($forum = $stmt1->fetch(PDO::FETCH_ASSOC)) {
    $req2 = "SELECT 
                COUNT(DISTINCT t.idTopic) AS nbrTopics,
                COUNT(m.idMessage)        AS nbrMessages
             FROM topics t
             LEFT JOIN messages m ON t.idTopic = m.idTopic
             WHERE t.idForum = ?";

    $stmt2 = $con->prepare($req2);
    $stmt2->execute([$forum["idForum"]]);
    $stats = $stmt2->fetch(PDO::FETCH_ASSOC);
    $req3 = "SELECT 
                t.titreTopic,
                t.sujet,
                u.pseudo,
                u.avatar,
                m.dateMessage
             FROM topics t
             JOIN messages m ON t.idTopic = m.idTopic
             JOIN users u    ON u.idUser = m.idUser
             WHERE t.idForum = ?
             ORDER BY m.dateMessage DESC
             LIMIT 1";

    $stmt3 = $con->prepare($req3);
    $stmt3->execute([$forum["idForum"]]);
    $last = $stmt3->fetch(PDO::FETCH_ASSOC);
?>

<tr>
    <td>
        <div class="d-flex">
            <img src="https://cdn-icons-png.flaticon.com/512/906/906334.png"
                 width="40" class="me-3">

            <div>
                <a href="topic.php?id=<?=$forum["idForum"]?>"><span class="fw-bold text-primary fs-5">
                    <?= $forum["designation"] ?>
                </span></a><br>

                <small class="text-muted">
                    <?= $forum["description"] ?>
                </small>
            </div>
        </div>
    </td>

    <td class="text-center fw-bold">
        <?= $stats["nbrTopics"] ?>
    </td>
    <td class="text-center fw-bold">
        <?= $stats["nbrMessages"] ?>
    </td>

    <td>
        <?php if ($last) { ?>
            <div class="d-flex align-items-center">

                <img src="<?= $last["avatar"] ?: 'https://cdn-icons-png.flaticon.com/512/149/149071.png' ?>"
                     width="40" class="me-3 rounded-circle">

                <div>
                    <span class="text-danger">
                        <?= $last["titreTopic"] ?>
                    </span><br>

                    <small>
                        par <b><?= $last["pseudo"] ?></b><br>
                        <?= $last["dateMessage"] ?>
                    </small>
                </div>

            </div>
        <?php } else { ?>
            <small class="text-muted">Aucun message</small>
        <?php } ?>
    </td>

</tr>

<?php }?>

    </tbody>
</table>

</div>
<?php
$ip = $_SERVER['REMOTE_ADDR'];
$time = time();

$req1 = "SELECT * FROM connectes WHERE ip=?";
$stmt1 = $con->prepare($req1);
$stmt1->execute([$ip]);

if ($stmt1->rowCount() == 0) {
    $req2 = "INSERT INTO connectes(ip, timeStampe) VALUES(?, ?)";
    $stmt2 = $con->prepare($req2);
    $stmt2->execute([$ip, $time]);

} else {
    $req3 = "UPDATE connectes SET timeStampe=? WHERE ip=?";
    $stmt3 = $con->prepare($req3);
    $stmt3->execute([$time, $ip]);
}
$perime = time() - 300;
$req4 = "DELETE FROM connectes WHERE timeStampe < ?";
$stmt4 = $con->prepare($req4);
$stmt4->execute([$perime]);

$stmt = $con->prepare("SELECT COUNT(*) AS nbr FROM connectes");
$stmt->execute();
$nbrConnectes = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt5 = "SELECT COUNT(*) AS nbrMembre FROM connectes WHERE membre=1";
$stmt5 = $con->prepare($stmt5);
$stmt5->execute();
$nbrMembres = $stmt5->fetch(PDO::FETCH_ASSOC);

$nbrInvites = $nbrConnectes['nbr'] - $nbrMembres['nbrMembre'];
$req5="SELECT * FROM record";
$stmt6=$con->prepare($req5);
$stmt6->execute();
$record=$stmt6->fetch(PDO::FETCH_ASSOC);
if($nbrConnectes['nbr']>$record['record']){
    $req6="UPDATE record SET record=?, date=?";
    $stmt7=$con->prepare($req6);
    $stmt7->execute([$nbrConnectes['nbr'], date("Y-m-d")]);
}
$req7="SELECT COUNT(*) nbrMessages FROM messages";
$stmt8=$con->prepare($req7);
$stmt8->execute();
$totalMessages=$stmt8->fetch(PDO::FETCH_ASSOC);
$req8="SELECT COUNT(*) nbrTopics FROM topics";
$stmt9=$con->prepare($req8);
$stmt9->execute();
$totalTopics=$stmt9->fetch(PDO::FETCH_ASSOC);
$req9="SELECT COUNT(*) nbrUsers FROM users";
$stmt10=$con->prepare($req9);
$stmt10->execute();
$totalUsers=$stmt10->fetch(PDO::FETCH_ASSOC);

?>

<div class="container mt-4">
    <div class="alert alert-info text-center">
        Il y a actuellement 
        <strong><?= $nbrConnectes['nbr'] ?></strong> utilisateurs en ligne : 
        <?= $nbrMembres['nbrMembre'] ?> membres et <?= $nbrInvites ?> invités.<br>
        Record d'utilisateurs en ligne : <strong><?= $record['record'] ?></strong> le <?= $record['date'] ?>.
    </div>
</div>
<div class="container mt-4">
    <div class="alert alert-info text-center">
        Discussions : <strong><?= $totalTopics['nbrTopics'] ?></strong> Messages : <strong><?= $totalMessages['nbrMessages'] ?></strong> Membres : <strong><?= $totalUsers['nbrUsers'] ?></strong>
    </div>
</div>