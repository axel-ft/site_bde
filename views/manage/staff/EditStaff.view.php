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
            <div class="col-lg-8">
                <div class="card card-hero card-primary animated fadeInUp animation-delay-7">
                    <div class="card-block">
                        <h1 class="color-primary text-center">Modifier le poste de <?php if(isset($Staff) && !empty($Staff)) echo htmlentities($Staff[0]['first_name'] . ' ' . $Staff[0]['last_name'] . ' à ' . $Staff[0]['name_asso']) ?></h1>
                        <?php if ($Message !== null) echo $Message ?>
                        <form method="POST" action="/manage/staff/<?= (!is_null($IdAsso) && !empty($IdAsso)) ? htmlentities($IdAsso) : '' ?>/edit/<?= (!is_null($IdProfile) && !empty($IdProfile)) ? htmlentities($IdProfile) : '' ?>" enctype="multipart/form-data">
                            <fieldset>
                                <div class="form-group label-floating">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="zmdi zmdi-account"></i>
                                        </span>
                                        <label class="control-label disabled-label" for="position">Membre <small>*</small></label>
                                        <input id="position" class="form-control" read-only disabled required value="<?= (isset($Staff) && !empty($Staff)) ? htmlentities($Staff[0]['first_name'] . ' ' . $Staff[0]['last_name']) : ' ' ?>">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group label-floating">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="zmdi zmdi-filter-list"></i>
                                        </span>
                                        <label class="control-label" for="position">Poste <small>*</small></label>
                                        <input name="position" id="position" class="form-control" required value="<?= htmlentities($Staff[0]['position']) ?>">
                                    </div>
                                </div>
                            </fieldset>
                            <button class="btn btn-raised btn-primary btn-block" type="submit">Mettre à jour le membre<i class="zmdi zmdi-long-arrow-right no-mr ml-1"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
