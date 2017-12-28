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
                    <h1 class="color-primary text-center">Mettre à jour <?php if(!empty($Profile)) echo htmlentities($Profile['first_name']) . " " . htmlentities($Profile['last_name']) ?></h1>
                        <?php if ($Message !== null) echo $Message ?>
                        <form method="POST" action="/manage/profiles/edit/<?php if(!is_null($ProfileID) && !empty($ProfileID)) echo htmlentities($ProfileID) ?>" enctype="multipart/form-data">
                            <fieldset>
                                <div class="row justify-content-md-center">
                                    <div class="col-lg-6">
                                        <div class="form-group label-floating">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="zmdi zmdi-account"></i>
                                                </span>
                                                <label class="control-label" for="first_name">Prénom <small>*</small></label>
                                                <input type="text" name="first_name" id="first_name" class="form-control" required value="<?php if(!empty($Profile)) echo htmlentities($Profile['first_name']) ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group label-floating">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="zmdi zmdi-account"></i>
                                                </span>
                                                <label class="control-label" for="last_name">Nom <small>*</small></label>
                                                <input type="text" name="last_name" id="last_name" class="form-control" required value="<?php if(!empty($Profile)) echo htmlentities($Profile['last_name']) ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                if (!empty($Profile['avatar'])) {
                                ?>
                                <div class="row justify-content-md-center">
                                    <div class="col-md-6">
                                        <img src="<?= htmlentities($Profile['avatar']) ?>" alt="Photo de profil" class="img-fluid">
                                    </div>
                                </div>
                                <?php
                                }
                                ?>
                                <div class="form-group label-floating">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="zmdi zmdi-upload"></i>
                                        </span>
                                        <input type="text" readonly="true" class="form-control" placeholder="Modifier la photo de profil - Parcourir...">
                                        <input type="file" name="avatar" id="avatar" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group label-floating">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="zmdi zmdi-filter-list"></i>
                                        </span>
                                        <label class="control-label" for="description_profile">Description</label>
                                        <textarea name="description_profile" id="description_profile" class="form-control" rows="4"><?php if(!empty($Profile)) echo htmlentities($Profile['description_profile']) ?></textarea>
                                    </div>
                                </div>
                                <div class="row justify-content-md-center">
                                    <div class="col-lg-6">
                                        <div class="form-group label-floating">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="zmdi zmdi-email"></i>
                                                </span>
                                                <label class="control-label" for="email">E-mail <small>*</small></label>
                                                <input type="email" name="email" id="email" class="form-control" required value="<?php if(!empty($Profile)) echo htmlentities($Profile['email']) ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group label-floating">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="zmdi zmdi-phone"></i>
                                                </span>
                                                <label class="control-label" for="phone">Téléphone</label>
                                                <input type="tel" name="phone" id="phone" class="form-control" value="<?php if(!empty($Profile)) echo htmlentities($Profile['phone']) ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-conten-md-center">
                                    <div class="col-lg-6">
                                        <div class="form-group label-floating">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="zmdi zmdi-facebook"></i>
                                                </span>
                                                <label class="control-label" for="facebook_link">Lien Facebook</label>
                                                <input type="url" name="facebook_link" id="facebook_link" class="form-control" value="<?php if(!empty($Profile)) echo htmlentities($Profile['facebook_link']) ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group label-floating">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="zmdi zmdi-twitter"></i>
                                                </span>
                                                <label class="control-label" for="twitter_link">Lien Twitter</label>
                                                <input type="url" name="twitter_link" id="twitter_link" class="form-control" value="<?php if(!empty($Profile)) echo htmlentities($Profile['twitter_link']) ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-md-center">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="zmdi zmdi-accounts"></i>
                                                </span>
                                                <select name="asso" id="asso" class="form-control selectpicker" data-dropup-auto="false">
                                                    <option disabled selected value>Association</option>
                                                    <?php
                                                        if (!is_null($Associations))
                                                            foreach($Associations as $Association)
                                                                echo "<option value=" . $Association['id_asso'] . (($Profile['id_asso'] === $Association['id_asso']) ? " selected >" : ">") . $Association['name_asso'] . "</option>";
                                                        else
                                                            echo "<option disabled value>Vous devez d'abord ajouter au moins une association</option>"
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group label-floating">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="zmdi zmdi-email"></i>
                                                </span>
                                                <label class="control-label" for="position">Poste</label>
                                                <input type="text" name="position" id="position" class="form-control" value="<?php if(!empty($Profile)) echo htmlentities($Profile['position']) ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <button class="btn btn-raised btn-primary btn-block" type="submit">Mettre à jour ce profil <i class="zmdi zmdi-long-arrow-right no-mr ml-1"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
