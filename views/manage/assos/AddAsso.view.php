<!DOCTYPE html>
<html lang="fr">

<head>
    <title>BDE Ynov Paris</title>
    <?php require_once('views/include/CommonHead.view.php'); ?>
</head>

<body>
    <?php require_once('views/include/NavBar.view.php'); ?>

    <section>
        <form method="POST" action="/manage/assos/add" enctype="multipart/form-data">
            <?php if ($Message !== null) echo '<div>'.$Message.'</div>'; ?>
            <div class="field">
                <label class="icon" for="name_asso"><i class="material-icons">person</i></label>
                <input type="text" name="name_asso" id="name_asso" placeholder=" " required>
                <label class="text" for="name_asso">Nom de l'association *</label>
            </div>
            <div class="field">
                <label class="icon" for="acronym"><i class="material-icons">lock</i></label>
                <input type="text" name="acronym" id="acronym" placeholder=" ">
                <label class="text" for="acronym">Acronyme</label>
            </div>
            <div class="field">
                <label class="icon" for="description_asso"><i class="material-icons">lock</i></label>
                <textarea name="description_asso" id="description_asso" placeholder=" " required></textarea>
                <label class="text" for="description_asso">Description de l'association *</label>
            </div>
            <div class="field">
                <label class="icon" for="logo"><i class="material-icons">contacts</i></label>
                <input type="file" name="logo" id="logo" placeholder=" " required>
                <label class="text" for="logo">Logo *</label>
            </div>
            <div class="field">
                <label class="icon" for="email"><i class="material-icons">email</i></label>
                <input type="mail" name="email" id="email" placeholder=" ">
                <label class="text" for="email">E-mail</label>
            </div>
            <div class="field">
                <label class="icon" for="phone"><i class="material-icons">phone</i></label>
                <input type="text" name="phone" id="phone" placeholder=" ">
                <label class="text" for="phone">Téléphone</label>
            </div>
            <div class="field">
                <label class="icon" for="facebook_link"><i class="material-icons">share</i></label>
                <input type="text" name="facebook_link" id="facebook_link" placeholder=" ">
                <label class="text" ffor="facebook_link">Lien Facebook</label>
            </div>
            <div class="field">
                <label class="icon" for="twitter_link"><i class="material-icons">share</i></label>
                <input type="text" name="twitter_link" id="twitter_link" placeholder=" ">
                <label class="text" for="twitter_link">Lien Twitter</label>
            </div>
            <div class="field">
                <label class="icon" for="profile"><i class="material-icons">person</i></label>
                <select name="profile" id="profile" required>
                    <option disabled selected value>Contact Principal *</option>
                    <?php
                        if (!is_null($Profiles))
                            foreach($Profiles as $Profile)
                                echo "<option value=".$Profile['id_profile'].">".$Profile['first_name']." ".$Profile['last_name']."</option>";
                        else
                            echo "<option disabled value>Vous devez d'abord ajouter au moins un profil</option>"
                    ?>
                </select>
                <label class="text" for="profile"><i class="material-icons">person</i></label>
            </div>

            <div class="field">
                <button class="button" type="submit">Ajouter une association</button>
            </div>
        </form>
    </section>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
