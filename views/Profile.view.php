<!DOCTYPE html>
<html lang="fr">

<head>
    <title>BDE Ynov Paris</title>
    <?php require_once('views/include/CommonHead.view.php'); ?>
</head>

<body>
    <?php require_once('views/include/NavBar.view.php'); ?>

    <section>
        <form method="POST" action="/profile">
            <?php if ($Message !== null) echo '<div>'.$Message.'</div>'; ?>
            <label for="username"><i class="material-icons">person</i></label>
                <input type="text" name="username" id="username" placeholder="Nom d'utilisateur" value="<?php if(!empty($AccountAndProfile)) echo $AccountAndProfile[0]['username'] ?>">

            <label for="password"><i class="material-icons">lock</i></label>
            <input type="password" name="password" id="password" placeholder="Mot de passe">

            <label for="password_confirm"><i class="material-icons">lock</i></label>
            <input type="password" name="password_confirm" id="password_confirm" placeholder="Mot de passe (confirmation)">

            <label for="first_name"><i class="material-icons">contacts</i></label>
            <input type="text" name="first_name" id="first_name" placeholder="Prénom" value="<?php if(!empty($AccountAndProfile)) echo $AccountAndProfile[1]['first_name'] ?>">

            <label for="last_name"><i class="material-icons">contacts</i></label>
            <input type="text" name="last_name" id="last_name" placeholder="Nom" value="<?php if(!empty($AccountAndProfile)) echo $AccountAndProfile[1]['last_name'] ?>">

            <label for="email"><i class="material-icons">email</i></label>
            <input type="text" name="email" id="email" placeholder="E-mail" value="<?php if(!empty($AccountAndProfile)) echo $AccountAndProfile[1]['email'] ?>">

            <label for="avatar"><i class="material-icons">face</i></label>
            <input type="text" name="avatar" id="avatar" placeholder="Avatar" value="<?php if(!empty($AccountAndProfile)) echo $AccountAndProfile[1]['avatar'] ?>">

            <label for="facebook_link"><i class="material-icons">share</i></label>
            <input type="text" name="facebook_link" id="facebook_link" placeholder="Lien Facebook" value="<?php if(!empty($AccountAndProfile)) echo $AccountAndProfile[1]['facebook_link'] ?>">

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
