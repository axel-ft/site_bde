<!DOCTYPE html>
<html lang="fr">

<head>
    <title>BDE Ynov Paris</title>
    <?php require_once('views/include/CommonHead.view.php'); ?>
</head>

<body>
    <?php require_once('views/include/NavBar.view.php'); ?>

    <section>
        <form method="POST" action="/myprofile">
            <?php if ($Message !== null) echo '<div>'.$Message.'</div>'; ?>
            <div>
                <label for="username"><i class="material-icons">person</i></label>
                <input type="text" name="username" id="username" placeholder="Nom d'utilisateur" value="<?php if(!empty($AccountAndProfile)) echo htmlentities($AccountAndProfile[0]['username']) ?>">
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
                <input type="text" name="first_name" id="first_name" placeholder="Prénom" value="<?php if(!empty($AccountAndProfile)) echo htmlentities($AccountAndProfile[1]['first_name']) ?>">
            </div>
            <div>
                <label for="last_name"><i class="material-icons">contacts</i></label>
                <input type="text" name="last_name" id="last_name" placeholder="Nom" value="<?php if(!empty($AccountAndProfile)) echo htmlentities($AccountAndProfile[1]['last_name']) ?>">
            </div>
            <div>
                <label for="email"><i class="material-icons">email</i></label>
                <input type="text" name="email" id="email" placeholder="E-mail" value="<?php if(!empty($AccountAndProfile)) echo htmlentities($AccountAndProfile[1]['email']) ?>">
            </div>
            <div>
                <label for="avatar"><i class="material-icons">face</i></label>
                <input type="text" name="avatar" id="avatar" placeholder="Avatar" value="<?php if(!empty($AccountAndProfile)) echo htmlentities($AccountAndProfile[1]['avatar']) ?>">
            </div>
            <div>
                <label for="id_asso"><i class="material-icons">share</i></label>
                <input type="text" name="id_asso" id="id_asso" placeholder="Association" value="<?php if(!empty($AccountAndProfile)) echo htmlentities($AccountAndProfile[1]['id_asso']) ?>">
            </div>
            <div>
                <label for="position"><i class="material-icons">share</i></label>
                <input type="text" name="position" id="position" placeholder="Fonction" value="<?php if(!empty($AccountAndProfile)) echo htmlentities($AccountAndProfile[1]['position']) ?>">
            </div>
            <div>
                <label for="facebook_link"><i class="material-icons">share</i></label>
                <input type="text" name="facebook_link" id="facebook_link" placeholder="Lien Facebook" value="<?php if(!empty($AccountAndProfile)) echo htmlentities($AccountAndProfile[1]['facebook_link']) ?>">
            </div>
            <div>
                <label for="twitter_link"><i class="material-icons">share</i></label>
                <input type="text" name="twitter_link" id="twitter_link" placeholder="Lien Twitter" value="<?php if(!empty($AccountAndProfile)) echo htmlentities($AccountAndProfile[1]['twitter_link']) ?>">
            </div>
            <div>
                <label for="phone"><i class="material-icons">phone</i></label>
                <input type="text" name="phone" id="phone" placeholder="Téléphone" value="<?php if(!empty($AccountAndProfile)) echo htmlentities($AccountAndProfile[1]['phone']) ?>">
            </div>
            <button type="submit">Mettre à jour mon profil</button>
        </form>
    </section>

    <section>
        <form method="POST" action="/deactivate">
            <label for="password_conf"><i class="material-icons">lock</i></label>
            <input type="password" value="" name="password_conf" id="password_conf" placeholder="Mot de passe">
            <button type="submit">Désactiver mon compte</button>
        </form>
    </section>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
