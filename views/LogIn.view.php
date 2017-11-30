<!DOCTYPE html>
<html lang="fr">

<head>
    <title>BDE Ynov Paris</title>
    <?php require_once('views/include/CommonHead.view.php'); ?>
</head>

<body>
    <?php require_once('views/include/NavBar.view.php'); ?>

    <section id="login" class="light">
        <form method="POST" action="/login">
            <h2 class="darkcolor">Connexion</h2>
            <p>Pas encore de compte ? <a href="/signup" title="Inscription">Inscrivez-vous</a></p>

            <?php if ($Message !== null) echo '<div>'.$Message.'</div>'; ?>

            <div class="field">
                <label class="icon" for="username"><i class="material-icons">person</i></label>
                <input type="text" name="username" id="username" placeholder=" " required>
                <label class="text" for="username">Nom d'utilisateur *</label>
            </div>
            <div class="field">
                <label class="icon" for="password"><i class="material-icons">lock</i></label>
                <input type="password" name="password" id="password" placeholder=" " required>
                <label class="text" for="password">Mot de passe *</label>
            </div>
            <div class="field">
                <button class="button" type="submit">Se connecter</button>
            </div>
        </form>
    </section>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
