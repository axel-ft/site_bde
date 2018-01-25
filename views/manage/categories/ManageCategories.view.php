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
        <a class="btn btn-raised btn-success" href="/manage/categories/add">Ajouter une catégorie</a>
        <?php
            if (!is_null($Categories))
            {
                echo '<table class="table table-striped text-center">';
                echo '<thead>
                        <tr>
                            <th class="align-middle">Nom de la catégorie</th>
                            <th class="align-middle">Description</th>
                            <th class="align-middle">Actions</th>
                        </tr>
                      </thead>
                      <tbody>';

                foreach ($Categories as $Category) {
                ?>
                    <tr>
                        <td class="align-middle"><?= htmlentities($Category['name_cat']) ?></td>
                        <td class="align-middle"><?= (!is_null($Category['description_cat'])) ? htmlentities($Category['description_cat']) : '-' ?></td>
                        <td class="actions align-middle">
                            <a class="btn btn-raised btn-primary d-none d-lg-inline-block" href="/manage/categories/edit/<?= htmlentities($Category['id_category']) ?>">
                                <i class="zmdi zmdi-edit"></i>&nbsp;&nbsp;Modifier
                            </a>
                            <a class="btn-circle btn-circle-sm btn-circle-raised btn-circle-primary d-inline-block d-lg-none" href="/manage/categories/edit/<?= htmlentities($Event['id_category']) ?>">
                                <i class="zmdi zmdi-edit"></i>
                            </a>
                            <a class="btn btn-raised btn-danger d-none d-lg-inline-block" href="/manage/categories/delete/<?= htmlentities($Category['id_category']) ?>">
                                <i class="zmdi zmdi-delete"></i>&nbsp;&nbsp;Supprimer
                            </a>
                            <a class="btn-circle btn-circle-sm btn-circle-raised btn-circle-danger d-inline-block d-lg-none" href="/manage/categories/delete/<?= htmlentities($Category['id_category']) ?>">
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
                echo "Aucune catégorie pour le moment";
            }
        ?>
    </div>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
