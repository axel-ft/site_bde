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
                        <h1 class="color-primary text-center">Ajouter un utilisateur</h1>
                        <?php if ($Message !== null) echo $Message ?>
                        <form method="POST" action="/manage/users/add" enctype="multipart/form-data">
                            <fieldset>
                                <legend>Identification</legend>
                                <div class="form-group label-floating">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="zmdi zmdi-account"></i>
                                        </span>
                                        <label class="control-label" for="username">Nom d'utilisateur <small>*</small></label>
                                        <input type="text" name="username" id="username" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row justify-content-md-center">
                                    <div class="col-lg-6">
                                        <div class="form-group label-floating">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="zmdi zmdi-lock"></i>
                                                </span>
                                                <label class="control-label" for="password">Mot de passe <small>*</small></label>
                                                <input type="password" name="password" id="password" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group label-floating">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="zmdi zmdi-lock"></i>
                                                </span>
                                                <label class="control-label" for="password_confirm">Mot de passe (confirmation) <small>*</small></label>
                                                <input type="password" name="password_confirm" id="password_confirm" class="form-control" required>
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
                                                            <input type="radio" name="role" id="standard" value="0" checked> Utilisateur standard
                                                        </label>
                                                        <label class="d-block">
                                                            <input type="radio" name="role" id="author" value="2"> Auteur
                                                        </label>
                                                        <label class="d-block">
                                                            <input type="radio" name="role" id="manager" value="1"> Administrateur
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
                                                    <input class="ml-1" type="checkbox" name="active" id="active" value="yes" checked>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <legend class="mt-4">Profil</legend>

                            <div class="ms-collapse" id="profile_accordion" role="tablist" aria-multiselectable="true">
                                <div class="mb-0 card card-light">
                                    <div class="card-header" role="tab" id="profile_link_head">
                                        <h4 class="card-title ms-rotate-icon">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#profile_accordion" href="#profile_link" aria-expanded="false" aria-controls="profile_link">
                                                <i class="zmdi zmdi-link"></i> Lier un profil existant
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="profile_link" class="card-collapse collapse" role="tabpanel" aria-labelledby="profile_link_head">
                                        <div class="card-block">
                                            <fieldset>
                                                <h3>Lier un profil existant</h3>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="zmdi zmdi-accounts"></i>
                                                        </span>
                                                        <select name="profile" id="profile" class="form-control selectpicker" data-dropup-auto="false">
                                                            <option disabled selected value>Profils disponibles (sans compte)</option>
                                                            <?php
                                                                if (!is_null($FreeProfiles))
                                                                    foreach($FreeProfiles as $FreeProfile)
                                                                        echo "<option value=".$FreeProfile['id_profile'].">".$FreeProfile['first_name']." ".$FreeProfile['last_name']."</option>";
                                                                else
                                                                    echo "<option disabled value>Vous devez d'abord ajouter au moins un profil non lié à un compte</option>"
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>

                                <div class="divider mt-3 mb-3"><div class="text-center align-middle">OU</div></div>

                                <div class="mb-2 card card-light">
                                    <div class="card-header" role="tab" id="profile_new_head">
                                        <h4 class="card-title ms-rotate-icon">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#profile_accordion" href="#profile_new" aria-expanded="false" aria-controls="profile_new">
                                                <i class="zmdi zmdi-file-plus"></i> Créer et lier un nouveau profil
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="profile_new" class="card-collapse collapse" role="tabpanel" aria-labelledby="profile_new_head">
                                        <div class="card-block">
                                            <fieldset>
                                                <h3>Nouveau profil</h3>
                                                <div class="row justify-content-md-center">
                                                    <div class="col-lg-6">
                                                        <div class="form-group label-floating">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="zmdi zmdi-account"></i>
                                                                </span>
                                                                <label class="control-label" for="first_name">Prénom <small>*</small></label>
                                                                <input type="text" name="first_name" id="first_name" class="form-control">
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
                                                                <input type="text" name="last_name" id="last_name" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group label-floating">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="zmdi zmdi-upload"></i>
                                                        </span>
                                                        <input type="text" readonly="true" class="form-control" placeholder="Photo de profil - Parcourir...">
                                                        <input type="file" name="avatar" id="avatar" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group label-floating">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="zmdi zmdi-filter-list"></i>
                                                        </span>
                                                        <label class="control-label" for="description_profile">Description</label>
                                                        <textarea name="description_profile" id="description_profile" class="form-control" rows="4"></textarea>
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
                                                                <input type="email" name="email" id="email" class="form-control">
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
                                                                <input type="tel" name="phone" id="phone" class="form-control">
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
                                                                <input type="url" name="facebook_link" id="facebook_link" class="form-control">
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
                                                                <input type="url" name="twitter_link" id="twitter_link" class="form-control">
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
                                                                                echo "<option value=".$Association['id_asso'].">".$Association['name_asso']."</option>";
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
                                                                <input type="text" name="position" id="position" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-raised btn-primary btn-block" type="submit">Ajouter un utilisateur<i class="zmdi zmdi-long-arrow-right no-mr ml-1"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
