<!DOCTYPE html>
<html lang="fr">

<head>
    <title>BDE Ynov Paris</title>
    <?php require_once('views/include/CommonHead.view.php'); ?>
</head>

<body>
    <?php require_once('views/include/NavBar.view.php'); ?>

    <div class="container-fluid">
        <?php if ($Message !== null) echo $Message ?>
        <a class="btn btn-raised btn-success" href="/manage/users/add">Ajouter un utilisateur</a>
        <?php
            if (!is_null($Users))
            {
                echo '<table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th class="align-middle">Nom d&apos;utilisateur</th>
                                <th class="align-middle d-none d-md-table-cell">Dernière visite</th>
                                <th class="align-middle d-none d-md-table-cell">Inscrit depuis</th>
                                <th class="align-middle d-none d-sm-table-cell">Activé</th>
                                <th class="align-middle d-none d-sm-table-cell">Validé</th>
                                <th class="align-middle">Rôle</th>
                                <th class="align-middle">Profil lié</th>
                                <th class="align-middle">Actions</th>
                            </tr>
                        </thead>
                        <tbody>';

                foreach ($Users as $User)
                {
                    if (intval($User['active']) === 0) continue;
                ?>
                    <tr>
                        <td class="align-middle"><?= htmlentities($User['username']) ?></td>
                        <td class="align-middle d-none d-md-table-cell"><?= htmlentities($User['last_connection']) ?></td>
                        <td class="align-middle d-none d-md-table-cell"><?= htmlentities($User['signup_date']) ?></td>
                        <td class="align-middle d-none d-sm-table-cell"><?= (intval(htmlentities($User['active'])) === 1) ? "Oui" : "Non" ?></td>
                        <td class="align-middle d-none d-sm-table-cell"><?= (htmlentities($User['validation_hash']) === "") ? "Oui" : "Non" ?></td>
                        <td class="align-middle"><?= (intval(htmlentities($User['admin'])) === 1) ? "Admin" : "Utilisateur" ?></td>
                        <td class="align-middle"><?php if(!is_null($Profiles) && count($Profiles) > 0)
                                      foreach($Profiles as $Profile)
                                          if ($User['id_profile'] === $Profile['id_profile'])
                                              echo "<a href='/manage/profiles/edit/".$Profile['id_profile']."' target='_blank'>".$Profile['first_name']." ".$Profile['last_name']."</a>"
                            ?></td>
                        <td class="actions align-middle">
                            <a class="btn btn-raised btn-primary d-none d-lg-inline-block" href="/manage/users/edit/<?= htmlentities($User['id_user']) ?>">
                                <i class="zmdi zmdi-edit"></i>Modifier
                            </a>
                            <a class="btn-circle btn-circle-sm btn-circle-raised btn-circle-primary d-inline-block d-lg-none" href="/manage/users/edit/<?= htmlentities($User['id_user']) ?>">
                                <i class="zmdi zmdi-edit"></i>
                            </a>
                            <a class="btn btn-raised btn-danger d-none d-lg-inline-block" href="/manage/users/deactivate/<?= htmlentities($User['id_user']) ?>">
                                <i class="zmdi zmdi-close-circle"></i>Désactiver
                            </a>
                            <a class="btn-circle btn-circle-sm btn-circle-raised btn-circle-danger d-inline-block d-lg-none" href="/manage/users/deactivate/<?= htmlentities($User['id_user']) ?>">
                                <i class="zmdi zmdi-close-circle"></i>
                            </a>
                        </td>
                    </tr>
                <?php
                }

                echo "</tbody></table>";
            }

            else
            {
                echo "Aucun compte pour le moment";
            }
        ?>
    </div>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
