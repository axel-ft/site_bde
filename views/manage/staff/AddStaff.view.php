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
            <div class="col-lg-6">
                <div class="card card-hero card-primary animated fadeInUp animation-delay-7">
                    <div class="card-block">
                    <h1 class="color-primary text-center">Ajouter un membre à l'équipe de <?= $Asso['name_asso'] ?></h1>
                        <?php if ($Message !== null) echo $Message ?>
                        <form method="POST" action="/manage/staff/<?= $Asso['id_asso'] ?>/add" enctype="multipart/form-data">
                            <fieldset>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="zmdi zmdi-account"></i>
                                        </span>
                                        <select name="profile" id="profile" class="form-control selectpicker" data-dropup-auto="false" required>
                                            <option disabled selected value>Membre de l'équipe *</option>
                                            <?php
                                                if (!is_null($PossibleStaff))
                                                    foreach($PossibleStaff as $MemberAvail)
                                                        echo "<option value=".$MemberAvail['id_profile'].">".$MemberAvail['first_name']." ".$MemberAvail['last_name']."</option>";
                                                else
                                                    echo "<option disabled value>Vous devez d'abord ajouter au moins un profil</option>"
                                             ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group label-floating">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="zmdi zmdi-filter-list"></i>
                                        </span>
                                        <label class="control-label" for="position">Poste <small>*</small></label>
                                        <input name="position" id="position" class="form-control" required>
                                    </div>
                                </div>
                            </fieldset>
                            <button class="btn btn-raised btn-primary btn-block" type="submit">Ajouter un membre<i class="zmdi zmdi-long-arrow-right no-mr ml-1"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
