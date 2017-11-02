<!DOCTYPE html>
<html lang="fr">

<head>
    <title>BDE Ynov Paris</title>
    <?php require_once('views/include/CommonHead.view.php'); ?>
</head>

<body>
    <?php require_once('views/include/NavBar.view.php'); ?>

    <section>
        <form method="POST" action="/manage/assos/delete/<?php if (!is_null($IdAsso) && !empty($IdAsso)) echo htmlentities($IdAsso) ?>">
            <?php if ($Message !== null) echo '<div>'.$Message.'</div>'; ?>
            <div>
                Voulez-vous vraiment supprimer cette association ?
            </div>

            <button type="submit">Supprimer l'association <?php if (!is_null($Asso) && !empty($Asso)) echo htmlentities($Asso['name_asso']) ?></button>
            <a href="/manage/assos">Revenir à la liste des associations</a>
        </form>
    </section>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
