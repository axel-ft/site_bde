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
        <a class="btn btn-raised btn-success" href="/manage/assos/add">Ajouter une association</a>
        <?php
            if (!is_null($Associations))
            {
                echo '<table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th class="align-middle">Nom de l&apos;association</th>
                                <th class="align-middle">Acronyme</th>
                                <th class="align-middle d-none d-md-table-cell">Description</th>
                                <th class="align-middle d-none d-lg-table-cell">Logo</th>
                                <th class="align-middle d-none d-xl-table-cell">Email</th>
                                <th class="align-middle d-none d-xl-table-cell">Téléphone</th>
                                <th class="align-middle d-none d-sm-table-cell">Facebook</th>
                                <th class="align-middle d-none d-sm-table-cell">Twitter</th>
                                <th class="align-middle d-none d-sm-table-cell">Contact principal</th>
                                <th class="align-middle actions">Actions</th>
                            </tr>
                        </thead>
                        <tbody>';

                foreach ($Associations as $Association) {
                ?>
                    <tr>
                        <td class="align-middle"><?= htmlentities($Association['name_asso']) ?></td>
                        <td class="align-middle"><?php echo (!is_null($Association['acronym'])) ? htmlentities($Association['acronym']) : '-' ?></td>
                        <td class="align-middle text-left d-none d-md-table-cell"><?= htmlentities($Association['description_asso']) ?></td>
                        <td class="align-middle d-none d-lg-table-cell">
                            <a href="#" class="img-thumbnail withripple">
                                <div class="thumbnail-container text-center">
                                    <img src="<?= htmlentities($Association['logo']) ?>" class="img-table img-fluid" alt="Logo association">
                                </div>
                            <a>
                        </td>
                        <td class="align-middle d-none d-xl-table-cell"><?php echo (!is_null($Association['email'])) ? htmlentities($Association['email']) : '-' ?></td>
                        <td class="align-middle d-none d-xl-table-cell"><?php echo (!is_null($Association['phone'])) ? htmlentities($Association['phone']) : '-' ?></td>
                        <td class="align-middle d-none d-sm-table-cell">
                            <?php echo (!is_null($Association['facebook_link'])) ? '<a href="' . htmlentities($Association['facebook_link']) . '" target="_blank" title="Page Facebook" class="btn btn-default d-none d-lg-inline-block">Voir&nbsp;&nbsp;<i class="zmdi zmdi-open-in-new no-m"></i></a>
                                            <a href="' . htmlentities($Association['facebook_link']) . '" target="_blank" title="Page Facebook" class="btn-circle btn-circle-sm btn-circle-default d-inline-block d-lg-none"><i class="zmdi zmdi-open-in-new no-m"></i></a>' : '-'
                            ?>
                        </td>
                        <td class="align-middle d-none d-sm-table-cell">
                            <?php echo (!is_null($Association['twitter_link'])) ? '<a href="' . htmlentities($Association['twitter_link']) . '" target="_blank" title="Page Twitter" class="btn btn-default d-none d-lg-inline-block">Voir&nbsp;&nbsp;<i class="zmdi zmdi-open-in-new no-m"></i></a>
                                            <a href="' . htmlentities($Association['twitter_link']) . '" target="_blank" title="Page Twitter" class="btn-circle btn-circle-sm btn-circle-default d-inline-block d-lg-none"><i class="zmdi zmdi-open-in-new no-m"></i></a>' : '-'
                            ?>
                        </td>
                        <td class="align-middle d-none d-sm-table-cell"><?php foreach ($Profiles as $Profile)
                                    if (htmlentities($Profile['id_profile']) === htmlentities($Association['id_profile']))
                                        echo htmlentities($Profile['first_name'])." ".htmlentities($Profile['last_name'])
                            ?></td>
                        <td class="actions align-middle">
                            <a class="btn btn-raised btn-primary d-none d-lg-inline-block" href="/manage/assos/edit/<?= htmlentities($Association['id_asso']) ?>">
                                <i class="zmdi zmdi-edit"></i>Modifier
                            </a>
                            <a class="btn-circle btn-circle-sm btn-circle-raised btn-circle-primary d-inline-block d-lg-none" href="/manage/assos/edit/<?= htmlentities($Association['id_asso']) ?>">
                                <i class="zmdi zmdi-edit no-m"></i>
                            </a>
                            <a class="btn btn-raised btn-danger d-none d-lg-inline-block" href="/manage/assos/delete/<?= htmlentities($Association['id_asso']) ?>">
                                <i class="zmdi zmdi-delete"></i>Supprimer
                            </a>
                            <a class="btn-circle btn-circle-sm btn-circle-raised btn-circle-danger d-inline-block d-lg-none" href="/manage/assos/delete/<?= htmlentities($Association['id_asso']) ?>">
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
