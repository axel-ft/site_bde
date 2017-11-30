<!DOCTYPE html>
<html lang="fr">

<head>
    <title>BDE Ynov Paris</title>
    <?php require_once('views/include/CommonHead.view.php'); ?>
</head>

<body>
    <?php require_once('views/include/NavBar.view.php'); ?>

    <section>
        <?php if ($Message !== null) echo '<div>'.$Message.'</div>'; ?>
        <a class="button" href="/manage/events/add">Ajouter un événement</a>
        <?php
            if (!is_null($Events))
            {
                echo "<table>";
                echo "<thead><tr><th>Nom de l'événement</th><th>Date de début</th><th>Date de fin</th><th>Description</th><th>Event Facebook</th><th>Association</th><th>Actions</th></tr></thead>";

                foreach ($Events as $Event) {
                ?>
                    <tr>
                        <td><?= htmlentities($Event['name_event']) ?></td>
                        <td><?= htmlentities($Event['begin_date']) ?></td>
                        <td><?= htmlentities($Event['end_date']) ?></td>
                        <td><?= htmlentities($Event['description_event']) ?></td>
                        <td><?= htmlentities($Event['facebook_event_link']) ?></td>
                        <td><?php if (!is_null($Assos) && !empty($Assos))
                                    foreach ($Assos as $Asso)
                                        if (htmlentities($Asso['id_asso']) === htmlentities($Event['id_asso']))
                                            echo htmlentities($Asso['name_asso']) 
                            ?></td>
                        <td class="actions"><a class="button" href="/manage/events/edit/<?= htmlentities($Event['id_event']) ?>">Modifier</a> <a class="button" href="/manage/events/delete/<?= htmlentities($Event['id_event']) ?>">Supprimer</a></td>
                    </tr>
                <?php
                }

                echo "</table>";
            }

            else
            {
                echo "Aucun événement pour le moment";
            }
        ?>
    </section>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
