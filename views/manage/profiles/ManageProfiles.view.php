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
        <a class="btn btn-raised btn-success" href="/manage/profiles/add">Ajouter un profil</a>
        <?php
            if (!is_null($Profiles))
            {
                echo '<table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th class="align-middle">Prénom</th>
                                <th class="align-middle">Nom</th>
                                <th class="align-middle">Mail</th>
                                <th class="align-middle d-none d-lg-table-cell">Avatar</th>
                                <th class="align-middle d-none d-md-table-cell">Association</th>
                                <th class="align-middle d-none d-lg-table-cell">Poste</th>
                                <th class="align-middle d-none d-xl-table-cell">Téléphone</th>
                                <th class="align-middle d-none d-sm-table-cell">Facebook</th>
                                <th class="align-middle d-none d-sm-table-cell">Twitter</th>
                                <th class="align-middle">Actions</th>
                            </tr>
                        </thead>
                        <tbody>';

                foreach ($Profiles as $Profile)
                {
                    if (intval($Profile['visible']) === 0) continue;
                ?>
                    <tr>
                        <td class="align-middle"><?= htmlentities($Profile['first_name']) ?></td>
                        <td class="align-middle"><?= htmlentities($Profile['last_name']) ?></td>
                        <td class="align-middle"><?= htmlentities($Profile['email']) ?></td>
                        <td class="align-middle d-none d-lg-table-cell">
                            <?php echo (!is_null($Profile['avatar'])) ? '<a hre="#" class="img-thumbnail withripple">
                                                                            <div class="thumbnail-container text-center">
                                                                                <img src="' . htmlentities($Profile['avatar']) . '" class="img-table img-fluid" alt="Photo de profil">
                                                                            </div>
                                                                         </a>' : '-'?>
                        </td>
                        <td class="align-middle d-none d-md-table-cell">
                            <?php if (!is_null($Profile['id_asso']) && !is_null($Associations) && count($Associations) > 0)
                                  {
                                      foreach($Associations as $Association)
                                          if ($Profile['id_asso'] === $Association['id_asso'])
                                              echo $Association['name_asso'];
                                  }

                                  else echo '-'
                            ?>
                        </td>
                        <td class="align-middle d-none d-lg-table-cell"><?php echo (!is_null($Profile['position'])) ? htmlentities($Profile['position']) : '-' ?></td>
                        <td class="align-middle d-none d-xl-table-cell"><?php echo (!is_null($Profile['phone'])) ? htmlentities($Profile['phone']) : '-' ?></td>
                        <td class="align-middle d-none d-sm-table-cell">
                            <?php echo (!is_null($Profile['facebook_link'])) ? '<a href="' . htmlentities($Profile['facebook_link']) . '" target="_blank" title="Profil Facebook" class="btn-circle btn-circle-sm btn-circle-default"><i class="zmdi zmdi-open-in-new no-m"></i></a>' : '-' ?>
                        </td>
                        <td class="align-middle d-none d-sm-table-cell">
                            <?php echo (!is_null($Profile['twitter_link'])) ? '<a href="' . htmlentities($Profile['twitter_link']) . '" target="_blank" title="Profil Twitter" class="btn-circle btn-circle-sm btn-circle-default"><i class="zmdi zmdi-open-in-new no-m"></i></a>' : '-' ?>
                        </td>
                        <td class="actions align-middle">
                            <a class="btn btn-raised btn-primary d-none d-lg-inline-block" href="/manage/profiles/edit/<?= htmlentities($Profile['id_profile']) ?>">
                                <i class="zmdi zmdi-edit no-m"></i>&nbsp;&nbsp;Modifier
                            </a>
                            <a class="btn-circle btn-circle-sm btn-circle-raised btn-circle-primary d-inline-block d-lg-none" href="/manage/profiles/edit/<?= htmlentities($Profile['id_profile']) ?>">
                                <i class="zmdi zmdi-edit no-m"></i>
                            </a>
                            <a class="btn btn-raised btn-danger d-none d-lg-inline-block" href="/manage/profiles/delete/<?= htmlentities($Profile['id_profile']) ?>">
                                <i class="zmdi zmdi-delete no-m"></i>&nbsp;&nbsp;Supprimer
                            </a>
                            <a class="btn-circle btn-circle-sm btn-circle-raised btn-circle-danger d-inline-block d-lg-none" href="/manage/profiles/delete/<?= htmlentities($Profile['id_profile']) ?>">
                                <i class="zmdi zmdi-delete no-m"></i>
                            </a>
                        </td>
                    </tr>
                <?php
                }

                echo "</tbody></table>";
            }

            else
            {
                echo "Aucune association pour le moment";
            }
        ?>
    </div>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
