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
        <a href="/manage/users/add">Ajouter un utilisateur</a>
        <?php
            if (!is_null($Users))
            {
                echo "<table>";
                echo "<tr><th>Nom d'utilisateur</th><th>Dernière visite</th><th>Inscrit depuis</th><th>Activé</th><th>Validé</th><th>Rôle</th><th>Profil lié</th><th>Actions</th></tr>";

                foreach ($Users as $User)
                {
                    if (intval($User['active']) === 0) continue;
                ?>
                    <tr>
                        <td><?= htmlentities($User['username']) ?></td>
                        <td><?= htmlentities($User['last_connection']) ?></td>
                        <td><?= htmlentities($User['signup_date']) ?></td>
                        <td><?= (intval(htmlentities($User['active'])) === 1) ? "Oui" : "Non" ?></td>
                        <td><?= (htmlentities($User['validation_hash']) === "") ? "Oui" : "Non" ?></td>
                        <td><?= (intval(htmlentities($User['admin'])) === 1) ? "Administrateur" : "Utilisateur" ?></td>
                        <td><?php if(!is_null($Profiles) && count($Profiles) > 0)
                                      foreach($Profiles as $Profile)
                                          if ($User['id_profile'] === $Profile['id_profile'])
                                              echo "<a href='/manage/profiles/edit/".$Profile['id_profile']."' target='_blank'>".$Profile['first_name']." ".$Profile['last_name']."</a>"
                            ?></td>
                        <td><a href="/manage/users/edit/<?= htmlentities($User['id_user']) ?>">Modifier</a> <a href="/manage/users/deactivate/<?= htmlentities($User['']) ?>">Supprimer</a></td>
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
