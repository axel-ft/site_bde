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
            <div>
                <label for="first_name"><i class="material-icons">person</i></label>
                <input type="text" name="first_name" id="first_name" placeholder="Prénom">
            </div>
            <div>
                <label for="name"><i class="material-icons">lock</i></label>
                <input type="text" name="last_name" id="last_name" placeholder="Nom">
            </div>
            <div>
                <label for="email"><i class="material-icons">email</i></label>
                <input type="mail" name="email" id="email" placeholder="E-mail">
            </div>
            <div>
                <label for="avatar"><i class="material-icons">contacts</i></label>
                <input type="text" name="avatar" id="avatar" placeholder="Photo de profil">
            </div>
            <div>
                <label for="description_profile"><i class="material-icons">lock</i></label>
                <textarea name="description_profile" id="description_profile" placeholder="Description"></textarea>
            </div>
            <div>
                <label for="asso"><i class="material-icons">person</i></label>
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
            </div>
            <div>
                <label for="position"><i class="material-icons">phone</i></label>
                <input type="text" name="position" id="position" placeholder="Poste">
            </div>
            <div>
                <label for="phone"><i class="material-icons">phone</i></label>
                <input type="text" name="phone" id="phone" placeholder="Téléphone">
            </div>
            <div>
                <label for="facebook_link"><i class="material-icons">share</i></label>
                <input type="text" name="facebook_link" id="facebook_link" placeholder="Lien Facebook">
            </div>
                <label for="twitter_link"><i class="material-icons">share</i></label>
                <input type="text" name="twitter_link" id="twitter_link" placeholder="Lien Twitter">
            <div>
            </div>

            <button type="submit">Ajouter</button>
        </form>
    </section>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
