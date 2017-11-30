<!DOCTYPE html>
<html lang="fr">

<head>
    <title>BDE Ynov Paris</title>
    <?php require_once('views/include/CommonHead.view.php'); ?>
</head>

<body>
    <?php require_once('views/include/NavBar.view.php'); ?>

    <section>
        <form method="POST" action="/manage/events/delete/<?php if (!is_null($IdEvent) && !empty($IdEvent)) echo htmlentities($IdEvent) ?>">
            <?php if ($Message !== null) echo '<div>'.$Message.'</div>'; ?>
            <div>
                Voulez-vous vraiment supprimer cet événement ?
            </div>

            <button type="submit">Supprimer l'événement <?php if (!is_null($Event) && !empty($Event)) echo htmlentities($Event['name_event']) ?></button>
            <a href="/manage/events">Revenir à la liste des événements</a>
        </form>
    </section>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
