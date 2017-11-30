<!DOCTYPE html>
<html lang="fr">

<head>
    <title>BDE Ynov Paris</title>
    <?php require_once('views/include/CommonHead.view.php'); ?>
</head>

<body>
    <?php require_once('views/include/NavBar.view.php'); ?>

    <section id="signup" class="light">
        <form method="POST" action="/signup" enctype="multipart/form-data">
            <h2>Inscription</h2>
            <p>Déjà un compte ? <a href="/login" title="Connexion">Connectez-vous</a></p>

            <?php if ($Message !== null) echo '<div>'.$Message.'</div>'; ?>
            <div class="field">
                <label class="icon" for="username"><i class="material-icons">person</i></label>
                <input type="text" name="username" id="username" placeholder=" " required>
                <label class="text" for="username">Nom d'utilisateur *</i></label>
            </div>
            <div class="field">
                <label class="icon" for="password"><i class="material-icons">lock</i></label>
                <input type="password" name="password" id="password" placeholder=" " required>
                <label class="text" for="password">Mot de passe *</label>
            </div>
            <div class="field">
                <label class="icon" for="password_confirm"><i class="material-icons">lock</i></label>
                <input type="password" name="password_confirm" id="password_confirm" placeholder=" " required>
                <label class="text" for="password_confirm">Mot de passe (confirmation) *</label>
            </div>
            <div class="field">
                <label class="icon" for="first_name"><i class="material-icons">contacts</i></label>
                <input type="text" name="first_name" id="first_name" placeholder=" " required>
                <label class="text" for="first_name">Prénom *</label>
            </div>
            <div class="field">
                <label class="icon" for="last_name"><i class="material-icons">contacts</i></label>
                <input type="text" name="last_name" id="last_name" placeholder=" " required>
                <label class="text" for="last_name">Nom *</label>
            </div>
            <div class="field">
                <label class="icon" for="email"><i class="material-icons">email</i></label>
                <input type="email" name="email" id="email" placeholder=" " required>
                <label class="text" for="email">E-mail *</label>
            </div>
            <div class="field">
                <label class="icon" for="avatar"><i class="material-icons">face</i></label>
                <input type="file" name="avatar" id="avatar" placeholder=" ">
                <label class="text" for="avatar">Avatar</label>
            </div>
            <div class="field">
                <label class="icon" for="facebook_link"><i class="material-icons">share</i></label>
                <input type="url" name="facebook_link" id="facebook_link" placeholder=" ">
                <label class="text" for="facebook_link">Lien Facebook</label>
            </div>
            <div class="field">
                <button class="button" type="submit">Créer un compte</button>
            </div>
        </form>
    </section>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>

