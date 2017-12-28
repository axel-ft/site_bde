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
                    <h1 class="color-primary text-center">Mettre à jour <?php if(!empty($User)) echo htmlentities($User['username']) ?></h1>
                        <?php if ($Message !== null) echo $Message ?>
                        <form method="POST" action="/manage/users/edit/<?php if(!is_null($UserID) && !empty($UserID)) echo htmlentities($UserID) ?>" enctype="multipart/form-data">
                            <fieldset>
                                <div class="form-group label-floating">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="zmdi zmdi-account"></i>
                                        </span>
                                        <label class="control-label" for="username">Nom d'utilisateur <small>*</small></label>
                                        <input type="text" name="username" id="username" class="form-control" required value="<?php if(!empty($User)) echo htmlentities($User['username']) ?>">
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
                                        <div class="row">
                                            <label class="col-lg-4 mt-2 align-self-center" style="color: #9E9E9E"><i class="zmdi zmdi-view-list-alt color-primary mr-1"></i>Rôle <small>*</small>&nbsp;&nbsp;&nbsp;: </label>
                                            <div class="col-lg-8">
                                                <div class="form-group">
                                                    <div class="radio radio-primary">
                                                        <label class="d-block">
                                                            <input type="radio" name="role" id="standard" value="0" <?php if (!is_null($User) && !empty($User) && intval($User['admin']) === 0) echo "checked" ?>> Utilisateur standard
                                                        </label>
                                                        <label class="d-block">
                                                            <input type="radio" name="role" id="author" value="2" <?php if (!is_null($User) && !empty($User) && intval($User['admin']) === 2) echo "checked" ?>> Auteur
                                                        </label>
                                                        <label class="d-block">
                                                            <input type="radio" name="role" id="manager" value="1" <?php if (!is_null($User) && !empty($User) && intval($User['admin']) === 1) echo "checked" ?>> Administrateur
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 align-self-center">
                                        <div class="form-group">
                                            <div class="togglebutton text-center">
                                                <label for="active">
                                                    <i class="zmdi zmdi-badge-check mr-1 color-primary"></i>Activé <small>*</small>&nbsp;&nbsp;&nbsp;:
                                                    <input class="ml-1" type="checkbox" name="active" id="active" value="yes" <?php if (!is_null($User) && !empty($User) && intval($User['active']) === 1) echo "checked" ?>>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <button class="btn btn-raised btn-primary btn-block" type="submit">Mettre à jour l'utilisateur<i class="zmdi zmdi-long-arrow-right no-mr ml-1"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
