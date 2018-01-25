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
                    <h1 class="color-primary text-center">Modifier <?php if(!empty($Category)) echo htmlentities($Category[0]['name_cat']) ?></h1>
                        <?php if ($Message !== null) echo $Message ?>
                        <form method="POST" action="/manage/categories/edit/<?= htmlentities($Category[0]['id_category']) ?>">
                            <fieldset>
                                <div class="form-group label-floating">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="zmdi zmdi-badge-check"></i>
                                        </span>
                                        <label class="control-label" for="name_cat">Nom de la catégorie <small>*</small></label>
                                        <input type="text" name="name_cat" id="name_cat" class="form-control" required value="<?= htmlentities($Category[0]['name_cat']) ?>">
                                    </div>
                                </div>
                                <div class="form-group label-floating">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="zmdi zmdi-filter-list"></i>
                                        </span>
                                        <label class="control-label" for="description_cat">Description</label>
                                        <textarea name="description_cat" id="description_cat" class="form-control" rows="4"><?= (!empty($Category) && !is_null($Category[0]['description_cat'])) ? htmlentities($Category[0]['description_cat']) : '' ?></textarea>
                                    </div>
                                </div>
                            </fieldset>
                            <button class="btn btn-raised btn-primary btn-block" type="submit">Mettre à jour la catégorie<i class="zmdi zmdi-long-arrow-right no-mr ml-1"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
