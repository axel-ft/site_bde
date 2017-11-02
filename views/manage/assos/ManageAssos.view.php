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
        <a href="/manage/assos/add">Ajouter une association</a>
        <?php
            if (!is_null($Associations))
            {
                echo "<table>";
                echo "<tr><th>Nom de l'association</th><th>Acronyme</th><th>Description</th><th>Logo</th><th>Email</th><th>Téléphone</th><th>Facebook</th><th>Twitter</th><th>Contact principal</th><th>Actions</th></tr>";

                foreach ($Associations as $Association) {
                ?>
                    <tr>
                        <td><?= htmlentities($Association['name_asso']) ?></td>
                        <td><?php if(!is_null($Association['acronym'])) echo htmlentities($Association['acronym']) ?></td>
                        <td><?= htmlentities($Association['description_asso']) ?></td>
                        <td><?= htmlentities($Association['logo']) ?></td>
                        <td><?php if(!is_null($Association['email'])) echo htmlentities($Association['email']) ?></td>
                        <td><?php if(!is_null($Association['phone'])) echo htmlentities($Association['phone']) ?></td>
                        <td><?php if(!is_null($Association['facebook_link'])) echo htmlentities($Association['facebook_link']) ?></td>
                        <td><?php if(!is_null($Association['twitter_link'])) echo htmlentities($Association['twitter_link']) ?></td>
                        <td><?php foreach ($Profiles as $Profile)
                                    if (htmlentities($Profile['id_profile']) === htmlentities($Association['id_profile']))
                                        echo htmlentities($Profile['first_name'])." ".htmlentities($Profile['last_name']) 
                            ?></td>
                        <td><a href="/manage/assos/edit/<?= htmlentities($Association['id_asso']) ?>">Modifier</a> <a href="/manage/assos/delete/<?= htmlentities($Association['id_asso']) ?>">Supprimer</a></td>
                    </tr>
                <?php
                }

                echo "</table>";
            }

            else
            {
                echo "Aucune association pour le moment";
            }
        ?>
    </section>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
