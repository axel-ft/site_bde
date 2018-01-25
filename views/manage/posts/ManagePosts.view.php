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
        <a class="btn btn-raised btn-success" href="/manage/posts/add">Ajouter un article</a>
        <?php
            if (!is_null($Posts))
            {
                echo '<table class="table table-striped text-center">';
                echo '<thead>
                        <tr>
                            <th class="align-middle">Nom de l\'article</th>
                            <th class="align-middle">Contenu</th>
                            <th class="align-middle">Image d\'en-tête</th>
                            <th class="align-middle">Publié le</th>
                            <th class="align-middle">Modifié le</th>
                            <th class="align-middle">Catégorie</th>
                            <th class="align-middle">Publié par</th>
                            <th class="align-middle">Actions</th>
                        </tr>
                      </thead>
                      <tbody>';

                foreach ($Posts as $Post) {
                ?>
                    <tr>
                        <td class="align-middle"><?= htmlentities($Post['name_post']) ?></td>
                        <td class="align-middle"><?= htmlentities($Post['content_post']) ?></td>
                        <td class="align-middle"><?= (!is_null($Post['heading_image'])) ? '<img src="' . htmlentities($Post['heading_image']) . '" alt="Image d\'en-tête" class="img-fluid img-table img-thumbnail">' : '-' ?></td>
                        <td class="align-middle"><?= htmlentities($Post['publish_date']) ?></td>
                        <td class="align-middle"><?= (!is_null($Post['edited_date'])) ? htmlentities($Post['edited_date']) : '-' ?></td>
                        <td class="align-middle"><?= (!is_null($Post['name_cat'])) ? htmlentities($Post['name_cat']) : '-' ?></td>
                        <td class="align-middle"><?= htmlentities($Post['first_name'] . ' ' . $Post['last_name']) ?></td>
                        <td class="actions align-middle">
                            <a class="btn btn-raised btn-primary d-none d-lg-inline-block" href="/manage/posts/edit/<?= htmlentities($Post['id_post']) ?>">
                                <i class="zmdi zmdi-edit"></i>&nbsp;&nbsp;Modifier
                            </a>
                            <a class="btn-circle btn-circle-sm btn-circle-raised btn-circle-primary d-inline-block d-lg-none" href="/manage/posts/edit/<?= htmlentities($Post['id_post']) ?>">
                                <i class="zmdi zmdi-edit"></i>
                            </a>
                            <a class="btn btn-raised btn-danger d-none d-lg-inline-block" href="/manage/posts/delete/<?= htmlentities($Post['id_post']) ?>">
                                <i class="zmdi zmdi-delete"></i>&nbsp;&nbsp;Supprimer
                            </a>
                            <a class="btn-circle btn-circle-sm btn-circle-raised btn-circle-danger d-inline-block d-lg-none" href="/manage/posts/delete/<?= htmlentities($Post['id_post']) ?>">
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
                echo "Aucun article pour le moment";
            }
        ?>
    </div>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
