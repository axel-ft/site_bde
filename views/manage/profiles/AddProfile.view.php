<!DOCTYPE html>
<html lang="fr">

<head>
    <title>BDE Ynov Paris</title>
    <?php require_once('views/include/CommonHead.view.php'); ?>
</head>

<body>
    <?php require_once('views/include/NavBar.view.php'); ?>

    <section>
        <form method="POST" action="/manage/profiles/add">
            <?php if ($Message !== null) echo '<div>'.$Message.'</div>'; ?>
            <div class="field">
                <label class="icon" for="first_name"><i class="material-icons">person</i></label>
                <input type="text" name="first_name" id="first_name" placeholder=" " required>
                <label class="text" for="first_name">Prénom *</label>
            </div>
            <div class="field">
                <label class="icon" for="name"><i class="material-icons">lock</i></label>
                <input type="text" name="last_name" id="last_name" placeholder=" " required>
                <label class="text" for="name">Nom *</label>
            </div>
            <div class="field">
                <label class="icon" for="email"><i class="material-icons">email</i></label>
                <input type="mail" name="email" id="email" placeholder=" " required>
                <label class="text" for="email">E-mail *</label>
            </div>
            <div class="field">
                <label class="icon" for="avatar"><i class="material-icons">contacts</i></label>
                <input type="text" name="avatar" id="avatar" placeholder=" ">
                <label class="text" for="avatar">Photo de profil</label>
            </div>
            <div class="field">
                <label class="icon" for="description_profile"><i class="material-icons">lock</i></label>
                <textarea name="description_profile" id="description_profile" placeholder=" "></textarea>
                <label class="text" for="description_profile">Description</label>
            </div>
            <div class="field">
                <label class="icon" for="asso"><i class="material-icons">person</i></label>
                <select name="asso" id="asso">
                    <option disabled selected value>Association</option>
                    <?php
                        if (!is_null($Associations))
                            foreach($Associations as $Association)
                                echo "<option value=".$Association['id_asso'].">".$Association['name_asso']."</option>";
                        else
                            echo "<option disabled value>Vous devez d'abord ajouter au moins une association</option>"
                    ?>
                </select>
                <label class="text" for="asso">Association</label>
            </div>
            <div class="field">
                <label class="icon" for="position"><i class="material-icons">phone</i></label>
                <input type="text" name="position" id="position" placeholder=" ">
                <label class="text" for="position">Poste</label>
            </div>
            <div class="field">
                <label class="icon" for="phone"><i class="material-icons">phone</i></label>
                <input type="text" name="phone" id="phone" placeholder=" ">
                <label class="text" for="phone">Téléphone</label>
            </div>
            <div class="field">
                <label class="icon" for="facebook_link"><i class="material-icons">share</i></label>
                <input type="url" name="facebook_link" id="facebook_link" placeholder=" ">
                <label class="text" for="facebook_link">Lien Facebook</label>
            </div>
            <div class="field">
                <label class="icon" for="twitter_link"><i class="material-icons">share</i></label>
                <input type="url" name="twitter_link" id="twitter_link" placeholder=" ">
                <label class="text" for="twitter_link">Lien Twitter</label>
            </div>

            <div class="field">
                <button class="button" type="submit">Ajouter</button>
            </div>
        </form>
    </section>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
