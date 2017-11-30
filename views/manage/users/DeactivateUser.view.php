<!DOCTYPE html>
<html lang="fr">

<head>
    <title>BDE Ynov Paris</title>
    <?php require_once('views/include/CommonHead.view.php'); ?>
</head>

<body>
    <?php require_once('views/include/NavBar.view.php'); ?>

    <section>
        <form method="POST" action="/manage/users/deactivate/<?php if (!is_null($UserID) && !empty($UserID)) echo htmlentities($UserID) ?>">
            <?php if ($Message !== null) echo '<div>'.$Message.'</div>'; ?>
            <div>
                Voulez-vous vraiment désactiver ce compte ?
            </div>

            <button type="submit">Désactiver le compte de <?php if (!is_null($User) && !empty($User)) echo htmlentities($User['username']) ?></button>
            <a href="/manage/users">Revenir à la liste des comptes</a>
        </form>
    </section>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
