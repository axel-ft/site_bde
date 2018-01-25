<!DOCTYPE html>
<html lang="fr">

<head>
    <title>BDE Ynov Paris</title>
    <?php require_once('views/include/CommonHead.view.php'); ?>
</head>

<body>
    <?php require_once('views/include/NavBar.view.php'); ?>

    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-lg-12">
                <div class="card card-hero card-primary animated fadeInUp animation-delay-7">
                    <div class="card-block">
                    <h1 class="color-primary text-center">Modifier <?php if(!empty($Post)) echo htmlentities($Post[0]['name_post']) ?></h1>
                        <?php if ($Message !== null) echo $Message ?>
                        <form method="POST" action="/manage/posts/edit/<?= htmlentities($Post[0]['id_post']) ?>" enctype="multipart/form-data">
                            <fieldset>
                                <div class="form-group label-floating">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="zmdi zmdi-badge-check"></i>
                                        </span>
                                        <label class="control-label" for="name_post">Nom de l'article <small>*</small></label>
                                        <input type="text" name="name_post" id="name_post" class="form-control" required value="<?= (!is_null($Post)) ? htmlentities($Post[0]['name_post']) : '' ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="zmdi zmdi-account"></i>
                                        </span>
                                        <select name="category" id="category" class="form-control selectpicker" data-dropup-auto="false">
                                            <option disabled selected value>Catégorie</option>
                                            <option value="-1">Sans catégorie</option>
                                            <?php
                                                if (!is_null($Categories))
                                                    foreach($Categories as $Category)
                                                        echo '<option value="'.$Category['id_category']. (($Category['id_category'] === $Post[0]['id_category']) ? '" selected>' : '">') .$Category['name_cat']."</option>";
                                                else
                                                    echo "<option disabled value>Vous devez d'abord ajouter au moins une catégorie</option>"
                                             ?>
                                        </select>
                                    </div>
                                </div>
                                <?= (!is_null($Post['heading_image'])) ? '<div class="row justify-content-md-center"><div class="col-md-6"><img src="' . htmlentities($Post[0]['heading_image']) . '" alt="Image d\'en-tête" class="img-fluid"></div></div>' : '' ?>
                                <div class="form-group label-floating">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="zmdi zmdi-upload"></i>
                                        </span>
                                        <input type="text" readonly="true" class="form-control" placeholder="Image d'en-tête - Parcourir...">
                                        <input type="file" name="heading_image" id="heading_image" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group label-floating">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="zmdi zmdi-filter-list"></i>
                                        </span>
                                        <label class="control-label" for="content_post">Article</label>
                                        <textarea name="content_post" id="content_post" class="form-control" rows="4"><?= (!is_null($Post)) ? htmlentities($Post[0]['content_post']) : '' ?></textarea>
                                    </div>
                                </div>
                            </fieldset>
                            <button class="btn btn-raised btn-primary btn-block" type="submit">Mettre à jour l'article<i class="zmdi zmdi-long-arrow-right no-mr ml-1"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
