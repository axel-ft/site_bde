<!DOCTYPE html>
<html lang="fr">

<head>
    <title>BDE Ynov Paris</title>
    <?php require_once('views/include/CommonHead.view.php'); ?>
</head>

<body>
    <?php require_once('views/include/NavBar.view.php'); ?>

    <section>
        <form method="POST" action="/login">
            <?php if ($Message !== null) echo '<div>'.$Message.'</div>'; ?>
            <label for="username"><i class="material-icons">person</i></label>
            <input type="text" name="username" id="username" placeholder="Nom d'utilisateur">
            <label for="password"><i class="material-icons">lock</i></label>
            <input type="password" name="password" id="password" placeholder="Mot de passe">
            <button type="submit">Se connecter</button>
        </form>
    </section>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
