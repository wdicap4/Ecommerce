<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=shop;charset=utf8;', 'root', '');
if (isset($_POST['envoi'])) {
    if (!empty($_POST['pseudo']) and !empty($_POST['mdp'])) {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $mdp = sha1($_POST['mdp']);

        $insertUser = $bdd->prepare('INSERT INTO users(pseudo, mdp) VALUES(?,?)');
        $insertUser->execute(array($pseudo, $mdp));

        $recupUser = $bdd->prepare('SELECT * FROM users WHERE pseudo = ? AND mdp = ?');
        $recupUser->execute(array($pseudo, $pseudo));
        if ($recupUser->rowCount() > 0) {
            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['mdp'] = $mdp;
            $_SESSION['id'] = $recupUser->fetch()['id'];
        }

        echo $_SESSION['id'];
    } else {
        echo "Veuillez completer tous les champs...";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>

<body>
    <form action="" method="post">
        <input type="text" name="pseudo" autocomplete="off"><br />
        <input type="password" name="mdp" autocomplete="off"><br />
    </form>

</body>

</html>