<!DOCTYPE html>
<html lang="fr">

<head>
    <title>BDE Ynov Paris</title>
    <?php require_once('views/include/CommonHead.view.php'); ?>
</head>

<body>
    <?php require_once('views/include/NavBar.view.php'); ?>

    <section>
        <form method="POST" action="/signup">
            <?php if ($Message !== null) echo '<div>'.$Message.'</div>'; ?>
            <div>
                <label for="username"><i class="material-icons">person</i></label>
                <input type="text" name="username" id="username" placeholder="Nom d'utilisateur">
            </div>
            <div>
                <label for="password"><i class="material-icons">lock</i></label>
                <input type="password" name="password" id="password" placeholder="Mot de passe">
            </div>
            <div>
                <label for="password_confirm"><i class="material-icons">lock</i></label>
                <input type="password" name="password_confirm" id="password_confirm" placeholder="Mot de passe (confirmation)">
            </div>
            <div>
                <label for="first_name"><i class="material-icons">contacts</i></label>
                <input type="text" name="first_name" id="first_name" placeholder="Prénom">
            </div>
            <div>
                <label for="last_name"><i class="material-icons">contacts</i></label>
                <input type="text" name="last_name" id="last_name" placeholder="Nom">
            </div>
            <div>
                <label for="email"><i class="material-icons">email</i></label>
                <input type="text" name="email" id="email" placeholder="E-mail">
            </div>
            <div>
                <label for="avatar"><i class="material-icons">face</i></label>
                <input type="text" name="avatar" id="avatar" placeholder="Avatar">
            </div>
            <div>
                <label for="facebook_link"><i class="material-icons">share</i></label>
                <input type="text" name="facebook_link" id="facebook_link" placeholder="Lien Facebook">
            </div>
            <div>
            <button type="submit">Créer un compte</button>
        </form>
    </section>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
