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
                    <h1 class="color-primary text-center">Mettre à jour mon profil</h1>
                        <?php if ($Message !== null) echo $Message ?>
                        <form method="POST" action="/myprofile/edit" enctype="multipart/form-data">
                            <fieldset>
                                <div class="form-group label-floating">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="zmdi zmdi-account"></i>
                                        </span>
                                        <label class="control-label" for="username">Nom d'utilisateur <small>*</small></label>
                                        <input type="text" name="username" id="username" class="form-control" value="<?php if(!empty($AccountAndProfile)) echo htmlentities($AccountAndProfile[0]['username']) ?>">
                                    </div>
                                </div>
                                <div class="row justify-content-md-center">
                                    <div class="col-lg-6">
                                        <div class="form-group label-floating">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="zmdi zmdi-lock"></i>
                                                </span>
                                                <label class="control-label" for="password">Mot de passe</label>
                                                <input type="password" name="password" id="password" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group label-floating">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="zmdi zmdi-lock"></i>
                                                </span>
                                                <label class="control-label" for="password_confirm">Mot de passe (confirmation)</label>
                                                <input type="password" name="password_confirm" id="password_confirm" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-md-center">
                                    <div class="col-lg-6">
                                        <div class="form-group label-floating">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="zmdi zmdi-account"></i>
                                                </span>
                                                <label class="control-label" for="first_name">Prénom <small>*</small></label>
                                                <input type="text" name="first_name" id="first_name" class="form-control" required value="<?php if(!empty($AccountAndProfile)) echo htmlentities($AccountAndProfile[1]['first_name']) ?>">
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
                                                <input type="text" name="last_name" id="last_name" class="form-control" required value="<?php if(!empty($AccountAndProfile)) echo htmlentities($AccountAndProfile[1]['last_name']) ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                if (!empty($AccountAndProfile) && !is_null($AccountAndProfile[1]['avatar'])) {
                                ?>
                                <div class="row justify-content-md-center">
                                    <div class="col-md-4">
                                        <img src="<?= htmlentities($AccountAndProfile[1]['avatar']) ?>" alt="Photo de profil" class="img-fluid">
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
                                        <textarea name="description_profile" id="description_profile" class="form-control" rows="4"><?php if(!empty($AccountAndProfile)) echo htmlentities($AccountAndProfile[1]['description_profile']) ?></textarea>
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
                                                <input type="email" name="email" id="email" class="form-control" required value="<?php if(!empty($AccountAndProfile)) echo htmlentities($AccountAndProfile[1]['email']) ?>">
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
                                                <input type="tel" name="phone" id="phone" class="form-control" value="<?php if(!empty($AccountAndProfile)) echo htmlentities($AccountAndProfile[1]['phone']) ?>">
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
                                                <input type="url" name="facebook_link" id="facebook_link" class="form-control" value="<?php if(!empty($AccountAndProfile)) echo htmlentities($AccountAndProfile[1]['facebook_link']) ?>">
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
                                                <input type="url" name="twitter_link" id="twitter_link" class="form-control" value="<?php if(!empty($AccountAndProfile)) echo htmlentities($AccountAndProfile[1]['twitter_link']) ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <button class="btn btn-raised btn-primary btn-block" type="submit">Mettre à jour <i class="zmdi zmdi-long-arrow-right no-mr ml-1"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
