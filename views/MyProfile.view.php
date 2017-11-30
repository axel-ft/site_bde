<!DOCTYPE html>
<html lang="fr">

<head>
    <title>BDE Ynov Paris</title>
    <?php require_once('views/include/CommonHead.view.php'); ?>
</head>

<body>
    <?php require_once('views/include/NavBar.view.php'); ?>

    <section>
        <form method="POST" action="/myprofile" enctype="multipart/form-data">
            <?php if ($Message !== null) echo '<div>'.$Message.'</div>'; ?>
            <div class="field">
                <label class="icon" for="username"><i class="material-icons">person</i></label>
                <input type="text" name="username" id="username" placeholder=" " value="<?php if(!empty($AccountAndProfile)) echo htmlentities($AccountAndProfile[0]['username']) ?>" required>
                <label class="text" for="username">Nom d'utilisateur *</label>
            </div>
            <div class="field">
                <label class="icon" for="password"><i class="material-icons">lock</i></label>
                <input type="password" name="password" id="password" placeholder=" ">
                <label class="text" for="password">Mot de passe</label>
            </div>
            <div class="field">
                <label class="icon" for="password_confirm"><i class="material-icons">lock</i></label>
                <input type="password" name="password_confirm" id="password_confirm" placeholder=" ">
                <label class="text" for="password_confirm">Mot de passe (confirmation)</label>
            </div>
            <div class="field">
                <label class="icon" for="first_name"><i class="material-icons">contacts</i></label>
                <input type="text" name="first_name" id="first_name" placeholder=" " value="<?php if(!empty($AccountAndProfile)) echo htmlentities($AccountAndProfile[1]['first_name']) ?>" required>
                <label class="text" for="first_name">Prénom *</label>
            </div>
            <div class="field">
                <label class="icon" for="last_name"><i class="material-icons">contacts</i></label>
                <input type="text" name="last_name" id="last_name" placeholder=" " value="<?php if(!empty($AccountAndProfile)) echo htmlentities($AccountAndProfile[1]['last_name']) ?>" required>
                <label class="text" for="last_name">Nom *</label>
            </div>
            <div class="field">
                <label class="icon" for="email"><i class="material-icons">email</i></label>
                <input type="text" name="email" id="email" placeholder=" " value="<?php if(!empty($AccountAndProfile)) echo htmlentities($AccountAndProfile[1]['email']) ?>" required>
                <label class="text" for="email">E-mail *</label>
            </div>
                <img src="<?php if(!empty($AccountAndProfile)) echo htmlentities($AccountAndProfile[1]['avatar']) ?>" alt="Photo de profil" >
            <div class="field">
                <label class="icon" for="avatar"><i class="material-icons">face</i></label>
                <input type="file" name="avatar" id="avatar" placeholder=" ">
                <label class="text" for="avatar">Avatar</label>
            </div>
            <div class="field">
                <label class="icon" for="id_asso"><i class="material-icons">share</i></label>
                <input type="text" name="id_asso" id="id_asso" placeholder=" " value="<?php if(!empty($AccountAndProfile)) echo htmlentities($AccountAndProfile[1]['id_asso']) ?>">
                <label class="text" for="id_asso">Association</label>
            </div>
            <div class="field">
                <label class="icon" for="position"><i class="material-icons">share</i></label>
                <input type="text" name="position" id="position" placeholder=" " value="<?php if(!empty($AccountAndProfile)) echo htmlentities($AccountAndProfile[1]['position']) ?>">
                <label class="text" for="position">Fonction</label>
            </div>
            <div class="field">
                <label class="icon" for="facebook_link"><i class="material-icons">share</i></label>
                <input type="text" name="facebook_link" id="facebook_link" placeholder=" " value="<?php if(!empty($AccountAndProfile)) echo htmlentities($AccountAndProfile[1]['facebook_link']) ?>">
                <label class="text" for="facebook_link">Lien Facebook</label>
            </div>
            <div class="field">
                <label class="icon" for="twitter_link"><i class="material-icons">share</i></label>
                <input type="text" name="twitter_link" id="twitter_link" placeholder=" " value="<?php if(!empty($AccountAndProfile)) echo htmlentities($AccountAndProfile[1]['twitter_link']) ?>">
                <label class="text" for="twitter_link">Lien Twitter</label>
            </div>
            <div class="field">
                <label class="icon" for="phone"><i class="material-icons">phone</i></label>
                <input type="text" name="phone" id="phone" placeholder=" " value="<?php if(!empty($AccountAndProfile)) echo htmlentities($AccountAndProfile[1]['phone']) ?>">
                <label class="text" for="phone">Téléphone</label>
            </div>
            <div class="field">
                <button class="button" type="submit">Mettre à jour mon profil</button>
            </div>
        </form>
    </section>

    <section>
        <form method="POST" action="/deactivate">
            <div class="field">
                <label class="icon" for="password_conf"><i class="material-icons">lock</i></label>
                <input type="password" value="" name="password_conf" id="password_conf" placeholder=" " required>
                <label class="text" for="password_conf">Mot de passe *</label>
            </div>
            <div class="field">
                <button class="button" type="submit">Désactiver mon compte</button>
            </div>
        </form>
    </section>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
