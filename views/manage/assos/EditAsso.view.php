<!DOCTYPE html>
<html lang="fr">

<head>
    <title>BDE Ynov Paris</title>
    <?php require_once('views/include/CommonHead.view.php'); ?>
</head>

<body>
    <?php require_once('views/include/NavBar.view.php'); ?>

    <section>
        <form method="POST" action="/manage/assos/edit/<?php if(!is_null($IdAsso) && !empty($IdAsso)) echo htmlentities($IdAsso) ?>">
            <?php if ($Message !== null) echo '<div>'.$Message.'</div>'; ?>
            <div>
                <label for="name_asso"><i class="material-icons">person</i></label>
                <input type="text" name="name_asso" id="name_asso" placeholder="Nom de l'association" value="<?php if(!empty($Asso)) echo htmlentities($Asso['name_asso']) ?>">
            </div>
            <div>
                <label for="acronym"><i class="material-icons">lock</i></label>
                <input type="text" name="acronym" id="acronym" placeholder="Acronyme" value="<?php if(!empty($Asso)) echo htmlentities($Asso['acronym']) ?>">
            </div>
            <div>
                <label for="description_asso"><i class="material-icons">lock</i></label>
                <textarea name="description_asso" id="description_asso" placeholder="Description de l'association"><?php if(!empty($Asso)) echo htmlentities($Asso['description_asso']) ?></textarea>
            </div>
            <div>
                <label for="logo"><i class="material-icons">contacts</i></label>
                <input type="text" name="logo" id="logo" placeholder="Logo" value="<?php if(!empty($Asso)) echo htmlentities($Asso['logo']) ?>">
            </div>
            <div>
                <label for="email"><i class="material-icons">email</i></label>
                <input type="mail" name="email" id="email" placeholder="E-mail" value="<?php if(!empty($Asso)) echo htmlentities($Asso['email']) ?>">
            </div>
            <div>
                <label for="phone"><i class="material-icons">phone</i></label>
                <input type="text" name="phone" id="phone" placeholder="Téléphone" value="<?php if(!empty($Asso)) echo htmlentities($Asso['phone']) ?>">
            </div>
            <div>
                <label for="facebook_link"><i class="material-icons">share</i></label>
                <input type="text" name="facebook_link" id="facebook_link" placeholder="Lien Facebook" value="<?php if(!empty($Asso)) echo htmlentities($Asso['facebook_link']) ?>">
            </div>
            <div>
                <label for="twitter_link"><i class="material-icons">share</i></label>
                <input type="text" name="twitter_link" id="twitter_link" placeholder="Lien Twitter" value="<?php if(!empty($Asso)) echo htmlentities($Asso['twitter_link']) ?>">
            </div>
            <div>
                <label for="profile"><i class="material-icons">person</i></label>
                <select name="profile" id="profile">
                    <option disabled value>Contact Principal</option>
                    <?php
                        if (!is_null($Profiles))
                            foreach($Profiles as $Profile)
                            {
                                echo "<option value=".$Profile['id_profile'];
                                echo ($Asso['id_profile'] === $Profile['id_profile']) ? " selected >" : ">";
                                echo $Profile['first_name']." ".$Profile['last_name']."</option>";
                            }

                        else
                            echo "<option disabled value>Vous devez d'abord ajouter au moins un profil</option>"
                    ?>
                </select>
            </div>

            <button type="submit">Créer un compte</button>
        </form>
    </section>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
