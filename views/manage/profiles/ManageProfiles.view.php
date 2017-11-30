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
        <a class="button" href="/manage/profiles/add">Ajouter un profil</a>
        <?php
            if (!is_null($Profiles))
            {
                echo "<table>";
                echo "<thead><tr><th>Prénom</th><th>Nom</th><th>Mail</th><th>Avatar</th><th>Description</th><th>Association</th><th>Poste</th><th>Téléphone</th><th>Facebook</th><th>Twitter</th><th>Actions</th></tr></thead>";

                foreach ($Profiles as $Profile)
                {
                    if (intval($Profile['visible']) === 0) continue;
                ?>
                    <tr>
                        <td><?= htmlentities($Profile['first_name']) ?></td>
                        <td><?= htmlentities($Profile['last_name']) ?></td>
                        <td><?= htmlentities($Profile['email']) ?></td>
                        <td><?php if(!is_null($Profile['avatar'])) echo htmlentities($Profile['avatar']) ?></td>
                        <td><?php if(!is_null($Profile['description_profile'])) echo htmlentities($Profile['description_profile']) ?></td>
                        <td><?php if(!is_null($Profile['id_asso']) && !is_null($Associations) && count($Associations) > 0)
                                      foreach($Associations as $Association)
                                          if ($Profile['id_asso'] === $Association['id_asso'])
                                              echo $Association['name_asso']
                            ?></td>
                        <td><?php if(!is_null($Profile['position'])) echo htmlentities($Profile['position']) ?></td>
                        <td><?php if(!is_null($Profile['phone'])) echo htmlentities($Profile['phone']) ?></td>
                        <td><?php if(!is_null($Profile['facebook_link'])) echo htmlentities($Profile['facebook_link']) ?></td>
                        <td><?php if(!is_null($Profile['twitter_link'])) echo htmlentities($Profile['twitter_link']) ?></td>
                        <td class="actions"><a class="button" href="/manage/profiles/edit/<?= htmlentities($Profile['id_profile']) ?>">Modifier</a> <a class="button" href="/manage/profiles/delete/<?= htmlentities($Profile['id_profile']) ?>">Supprimer</a></td>
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
