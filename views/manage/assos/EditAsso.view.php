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
                        <h1 class="color-primary text-center">Modifier <?php if(!empty($Asso)) echo htmlentities($Asso['name_asso']) ?></h1>
                        <?php if ($Message !== null) echo $Message ?>
                        <form method="POST" action="/manage/assos/edit/<?php if(!is_null($IdAsso) && !empty($IdAsso)) echo htmlentities($IdAsso) ?>" enctype="multipart/form-data">
                            <fieldset>
                                <div class="row justify-content-md-center">
                                    <div class="col-lg-6">
                                        <div class="form-group label-floating">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="zmdi zmdi-accounts"></i>
                                                </span>
                                                <label class="control-label" for="name_asso">Nom de l'association <small>*</small></label>
                                                <input type="text" name="name_asso" id="name_asso" class="form-control" required value="<?php if(!empty($Asso)) echo htmlentities($Asso['name_asso']) ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group label-floating">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="zmdi zmdi-font"></i>
                                                </span>
                                                <label class="control-label" for="acronym">Acronyme</label>
                                                <input type="text" name="acronym" id="acronym" class="form-control" value="<?php if(!empty($Asso)) echo htmlentities($Asso['acronym']) ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group label-floating">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="zmdi zmdi-filter-list"></i>
                                        </span>
                                        <label class="control-label" for="description_asso">Description de l'association <small>*</small></label>
                                        <textarea name="description_asso" id="description_asso" class="form-control" rows="4" required><?php if(!empty($Asso)) echo htmlentities($Asso['description_asso']) ?></textarea>
                                    </div>
                                </div>
                                <div class="row justify-content-md-center">
                                    <div class="col-md-6">
                                        <img src="<?php if(!empty($Asso)) echo htmlentities($Asso['logo']) ?>" alt="Logo de l'association" class="img-fluid">
                                    </div>
                                </div>
                                <div class="form-group label-floating">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="zmdi zmdi-upload"></i>
                                        </span>
                                        <input type="text" readonly="true" class="form-control" placeholder="Modifier le logo de l'association - Parcourir... *">
                                        <input type="file" name="logo" id="logo" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row justify-content-md-center">
                                    <div class="col-lg-6">
                                        <div class="form-group label-floating">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="zmdi zmdi-email"></i>
                                                </span>
                                                <label class="control-label" for="email">E-mail</label>
                                                <input type="email" name="email" id="email" class="form-control" value="<?php if(!empty($Asso)) echo htmlentities($Asso['email']) ?>">
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
                                                <input type="tel" name="phone" id="phone" class="form-control" value="<?php if(!empty($Asso)) echo htmlentities($Asso['phone']) ?>">
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
                                                <input type="url" name="facebook_link" id="facebook_link" class="form-control" value="<?php if(!empty($Asso)) echo htmlentities($Asso['facebook_link']) ?>">
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
                                                <input type="url" name="twitter_link" id="twitter_link" class="form-control" value="<?php if(!empty($Asso)) echo htmlentities($Asso['twitter_link']) ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--<div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="zmdi zmdi-account"></i>
                                        </span>
                                        <select name="profile" id="profile" class="form-control selectpicker" data-dropup-auto="false" required>
                                            <option disabled selected value>Membre de l'équipe *</option>
                                            <?php /*
                                                if (!is_null($Profiles))
                                                    foreach($Profiles as $Profile)
                                                    {
                                                        echo "<option value=".$Profile['id_profile'] . '>';
                                                        echo $Profile['first_name']." ".$Profile['last_name']."</option>";
                                                    }
                                                else
                                                    echo "<option disabled value>Vous devez d'abord ajouter au moins un profil</option>"
                                             */ ?>
                                        </select>
                                    </div>
                                </div>-->
                            </fieldset>
                            <button class="btn btn-raised btn-primary btn-block" type="submit">Mettre à jour l'association<i class="zmdi zmdi-long-arrow-right no-mr ml-1"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
