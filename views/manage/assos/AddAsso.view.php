<!DOCTYPE html>
<html lang="fr">

<head>
    <title>BDE Ynov Paris</title>
    <?php require_once('views/include/CommonHead.view.php'); ?>
</head>

<body>
    <?php require_once('views/include/NavBar.view.php'); ?>

    <section>
        <form method="POST" action="/manage/assos/add">
            <?php if ($Message !== null) echo '<div>'.$Message.'</div>'; ?>
            <div>
                <label for="name_asso"><i class="material-icons">person</i></label>
                <input type="text" name="name_asso" id="name_asso" placeholder="Nom de l'association">
            </div>
            <div>
                <label for="acronym"><i class="material-icons">lock</i></label>
                <input type="text" name="acronym" id="acronym" placeholder="Acronyme">
            </div>
            <div>
                <label for="description_asso"><i class="material-icons">lock</i></label>
                <textarea name="description_asso" id="description_asso" placeholder="Description de l'association"></textarea>
            </div>
            <div>
                <label for="logo"><i class="material-icons">contacts</i></label>
                <input type="text" name="logo" id="logo" placeholder="Logo">
            </div>
            <div>
                <label for="email"><i class="material-icons">email</i></label>
                <input type="mail" name="email" id="email" placeholder="E-mail">
            </div>
            <div>
                <label for="phone"><i class="material-icons">phone</i></label>
                <input type="text" name="phone" id="phone" placeholder="Téléphone">
            </div>
            <div>
                <label for="facebook_link"><i class="material-icons">share</i></label>
                <input type="text" name="facebook_link" id="facebook_link" placeholder="Lien Facebook">
            </div>
            <div>
                <label for="twitter_link"><i class="material-icons">share</i></label>
                <input type="text" name="twitter_link" id="twitter_link" placeholder="Lien Twitter">
            </div>
            <div>
                <label for="profile"><i class="material-icons">person</i></label>
                <select name="profile" id="profile">
                    <option disabled selected value>Contact Principal</option>
                    <?php
                        if (!is_null($Profiles))
                            foreach($Profiles as $Profile)
                                echo "<option value=".$Profile['id_profile'].">".$Profile['first_name']." ".$Profile['last_name']."</option>";
                        else
                            echo "<option disabled value>Vous devez d'abord ajouter au moins un profil</option>"
                    ?>
                </select>
            </div>
            <div>

            <button type="submit">Créer un compte</button>
        </form>
    </section>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
