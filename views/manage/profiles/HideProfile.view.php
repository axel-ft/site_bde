<!DOCTYPE html>
<html lang="fr">

<head>
    <title>BDE Ynov Paris</title>
    <?php require_once('views/include/CommonHead.view.php'); ?>
</head>

<body>
    <?php require_once('views/include/NavBar.view.php'); ?>

    <section>
        <form method="POST" action="/manage/profiles/delete/<?php if (!is_null($ProfileID) && !empty($ProfileID)) echo htmlentities($ProfileID) ?>">
            <?php if ($Message !== null) echo '<div>'.$Message.'</div>'; ?>
            <div>
                Ce profil est lié à un compte utilisateur.<br>
                Il ne peut pas être supprimé mais seulement masqué.<br>
                Si le compte lié est actif, il sera désactivé<br>
                Voulez-vous vraiment masquer ce profil ?
            </div>

            <button type="submit">Masquer le profil de <?php if (!is_null($Profile) && !empty($Profile)) echo htmlentities($Profile['first_name'])." ".htmlentities($Profile['last_name']) ?></button>
            <a href="/manage/assos">Revenir à la liste des profils</a>
        </form>
    </section>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
