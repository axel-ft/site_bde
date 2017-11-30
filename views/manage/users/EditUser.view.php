<!DOCTYPE html>
<html lang="fr">

<head>
    <title>BDE Ynov Paris</title>
    <?php require_once('views/include/CommonHead.view.php'); ?>
</head>

<body>
    <?php require_once('views/include/NavBar.view.php'); ?>

    <section>
        <form method="POST" action="/manage/users/edit/<?php if(!is_null($UserID) && !empty($UserID)) echo htmlentities($UserID) ?>">
            <?php if ($Message !== null) echo '<div>'.$Message.'</div>'; ?>

            <div>
                <label for="username"><i class="material-icons">person</i></label>
                <input type="text" name="username" id="username" placeholder="Nom d'utilisateur" value="<?php if(!empty($User)) echo htmlentities($User['username']) ?>">
            </div>
            <div>
                <label for="password"><i class="material-icons">lock</i></label>
                <input type="password" name="password" id="password" placeholder="Mot de passe">
            </div>
            <div>
                <label for="password_confirm"><i class="material-icons">email</i></label>
                <input type="password" name="password_confirm" id="password_confirm" placeholder="Mot de passe (confirmation)">
            </div>
            <div>
                <i class="material-icons">contacts</i> Rôle : 
                <input type="radio" name="role" id="standard" placeholder="Utilisateur Standard" value="0" <?php if (!is_null($User) && !empty($User) && intval($User['admin']) === 0) echo "checked" ?> >
                <label for="standard">Utilisateur Standard</label>
                <input type="radio" name="role" id="author" placeholder="Auteur" value="2" <?php if (!is_null($User) && !empty($User) && intval($User['admin']) === 2) echo "checked" ?> >
                <label for="author">Auteur</label>
                <input type="radio" name="role" id="manager" placeholder="Administrateur" value="1" <?php if (!is_null($User) && !empty($User) && intval($User['admin']) === 1) echo "checked" ?> >
                <label for="manager">Administrateur</label>
            </div>
            <div>
                <label for="active"><i class="material-icons">lock</i> Activé</label>
                <input type="checkbox" name="active" id="active" value="yes" <?php if (!is_null($User) && !empty($User) && intval($User['active']) === 1) echo "checked" ?> >
            </div>

            <button type="submit">Mettre à jour l'utilisateur</button>
        </form>
    </section>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
