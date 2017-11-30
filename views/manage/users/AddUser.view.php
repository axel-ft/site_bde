<!DOCTYPE html>
<html lang="fr">

<head>
    <title>BDE Ynov Paris</title>
    <?php require_once('views/include/CommonHead.view.php'); ?>
</head>

<body>
    <?php require_once('views/include/NavBar.view.php'); ?>

    <section>
        <form method="POST" action="/manage/users/add">
            <?php if ($Message !== null) echo '<div>'.$Message.'</div>'; ?>
            <fieldset>
                <legend>Identification</legend>
                <div class="field">
                    <label class="icon" for="username"><i class="material-icons">person</i></label>
                    <input type="text" name="username" id="username" placeholder=" " required>
                    <label class="text" for="username">Nom d'utilisateur *</label>
                </div>
                <div class="field">
                    <label class="icon" for="password"><i class="material-icons">lock</i></label>
                    <input type="password" name="password" id="password" placeholder=" " required>
                    <label class="text" for="password">Mot de passe *</label>
                </div>
                <div class="field">
                    <label class="icon" for="password_confirm"><i class="material-icons">email</i></label>
                    <input type="password" name="password_confirm" id="password_confirm" placeholder=" " required>
                    <label class="text" for="password_confirm">Mot de passe (confirmation)</label>
                </div>
                <div class="field">
                    <i class="material-icons">contacts</i> Rôle :
                    <input type="radio" name="role" id="standard" placeholder="Utilisateur Standard" value="0" checked>
                    <label for="standard">Utilisateur Standard</label>
                    <input type="radio" name="role" id="author" placeholder="Auteur" value="2">
                    <label for="author">Auteur</label>
                    <input type="radio" name="role" id="manager" placeholder="Administrateur" value="1">
                    <label for="manager">Administrateur</label>
                </div>
                <div class="field">
                    <label class="icon" for="active"><i class="material-icons">lock</i> Activé</label>
                    <input type="checkbox" name="active" id="active" value="yes" checked>
                    <label class="text" for="active"><i class="material-icons">lock</i> Activé</label>
                </div>
            </fieldset>
            <fieldset>
                <legend>Profil</legend>
                <div class="field">
                    <label for="profile"><i class="material-icons">person</i></label>
                    <select name="profile" id="profile">
                        <option disabled selected value>Lier un profil existant</option>
                        <?php
                            if (!is_null($FreeProfiles))
                                foreach($FreeProfiles as $FreeProfile)
                                    echo "<option value=".$FreeProfile['id_profile'].">".$FreeProfile['first_name']." ".$FreeProfile['last_name']."</option>";
                            else
                                echo "<option disabled value>Vous devez d'abord ajouter au moins un profil non lié à un compte</option>"
                        ?>
                    </select>
                </div>
                <p>OU</p>
                    Nouveau profil<br>
                <div class="field">
                    <label class="icon" for="first_name"><i class="material-icons">person</i></label>
                    <input type="text" name="first_name" id="first_name" placeholder="Prénom">
                </div>
                <div class="field">
                    <label class="icon" for="name"><i class="material-icons">lock</i></label>
                    <input type="text" name="last_name" id="last_name" placeholder="Nom">
                </div>
                <div class="field">
                    <label class="icon" for="email"><i class="material-icons">email</i></label>
                    <input type="mail" name="email" id="email" placeholder="E-mail">
                </div>
                <div class="field">
                    <label class="icon" for="avatar"><i class="material-icons">contacts</i></label>
                    <input type="text" name="avatar" id="avatar" placeholder="Photo de profil">
                </div>
                <div class="field">
                    <label class="icon" for="description_profile"><i class="material-icons">lock</i></label>
                    <textarea name="description_profile" id="description_profile" placeholder="Description"></textarea>
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
                </div>
                <div class="field">
                    <label class="icon" for="position"><i class="material-icons">phone</i></label>
                    <input type="text" name="position" id="position" placeholder="Poste">
                </div>
                <div class="field">
                    <label class="icon" for="phone"><i class="material-icons">phone</i></label>
                    <input type="text" name="phone" id="phone" placeholder="Téléphone">
                </div>
                <div class="field">
                    <label class="icon" for="facebook_link"><i class="material-icons">share</i></label>
                    <input type="text" name="facebook_link" id="facebook_link" placeholder=" ">
                    <label class="text" for="facebook_link">Lien Facebook</label>
                </div>
                <div class="field">
                    <label class="icon" for="twitter_link"><i class="material-icons">share</i></label>
                    <input type="text" name="twitter_link" id="twitter_link" placeholder=" ">
                    <label class="text" for="twitter_link">Lien Twitter</label>
                </div>
            </fieldset>

            <div class="field">
                <button class="button" type="submit">Ajouter un utilisateur</button>
            </div>
        </form>
    </section>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
