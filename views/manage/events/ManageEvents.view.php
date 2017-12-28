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
        <a class="btn btn-raised btn-success" href="/manage/events/add">Ajouter un événement</a>
        <?php
            if (!is_null($Events))
            {
                echo '<table class="table table-striped text-center">';
                echo '<thead>
                        <tr>
                            <th class="align-middle">Nom de l\'événement</th>
                            <th class="align-middle">Date de début</th>
                            <th class="align-middle d-none d-sm-table-cell">Date de fin</th>
                            <th class="align-middle d-none d-lg-table-cell">Affiche</th>
                            <th class="align-middle d-none d-md-table-cell">Description</th>
                            <th class="align-middle d-none d-sm-table-cell">Event Facebook</th>
                            <th class="align-middle">Association</th>
                            <th class="align-middle">Actions</th>
                        </tr>
                      </thead>
                      <tbody>';

                foreach ($Events as $Event) {
                ?>
                    <tr>
                        <td class="align-middle"><?= htmlentities($Event['name_event']) ?></td>
                        <td class="align-middle"><?= htmlentities($Event['begin_date']) ?></td>
                        <td class="align-middle d-none d-sm-table-cell"><?= htmlentities($Event['end_date']) ?></td>
                        <td class="align-middle d-none d-lg-table-cell">
                            <a href="#" class="img-thumbnail withripple">
                                <div class="thumbnail-container text-center">
                                    <img src="<?= htmlentities($Event['poster']) ?>" class="img-table img-fluid" alt="Affiche événement">
                                </div>
                            </a>
                        </td>
                        <td class="align-middle text-left d-none d-md-table-cell"><?= htmlentities($Event['description_event']) ?></td>
                        <td class="align-middle d-none d-sm-table-cell">
                            <a href="<?= htmlentities($Event['facebook_event_link']) ?>" target="_blank" title="Événement Facebook" class="btn btn-default d-none d-lg-inline-block">Voir&nbsp;&nbsp;<i class="zmdi zmdi-open-in-new no-m"></i></a>
                            <a href="<?= htmlentities($Event['facebook_event_link']) ?>" target="_blank" title="Événement Facebook" class="btn-circle btn-circle-sm btn-circle-default d-inline-block d-lg-none"><i class="zmdi zmdi-open-in-new no-m"></i></a>
                        </td>
                        <td class="align-middle"><?php if (!is_null($Assos) && !empty($Assos))
                                    foreach ($Assos as $Asso)
                                        if (htmlentities($Asso['id_asso']) === htmlentities($Event['id_asso']))
                                            echo htmlentities($Asso['name_asso'])
                            ?></td>
                        <td class="actions align-middle">
                            <a class="btn btn-raised btn-primary d-none d-lg-inline-block" href="/manage/events/edit/<?= htmlentities($Event['id_event']) ?>">
                                <i class="zmdi zmdi-edit"></i>&nbsp;&nbsp;Modifier
                            </a>
                            <a class="btn-circle btn-circle-sm btn-circle-raised btn-circle-primary d-inline-block d-lg-none" href="/manage/events/edit/<?= htmlentities($Event['id_event']) ?>">
                                <i class="zmdi zmdi-edit"></i>
                            </a>
                            <a class="btn btn-raised btn-danger d-none d-lg-inline-block" href="/manage/events/delete/<?= htmlentities($Event['id_event']) ?>">
                                <i class="zmdi zmdi-delete"></i>&nbsp;&nbsp;Supprimer
                            </a>
                            <a class="btn-circle btn-circle-sm btn-circle-raised btn-circle-danger d-inline-block d-lg-none" href="/manage/events/delete/<?= htmlentities($Event['id_event']) ?>">
                                <i class="zmdi zmdi-delete"></i>
                            </a>
                        </td>
                    </tr>
                <?php
                }

                echo "</tbody></table>";
            }

            else
            {
                echo "Aucun événement pour le moment";
            }
        ?>
    </div>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
