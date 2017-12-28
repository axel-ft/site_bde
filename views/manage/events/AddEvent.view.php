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
                        <h1 class="color-primary text-center">Ajouter un événement</h1>
                        <?php if ($Message !== null) echo $Message ?>
                        <form method="POST" action="/manage/events/add" enctype="multipart/form-data">
                            <fieldset>
                                <div class="form-group label-floating">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="zmdi zmdi-badge-check"></i>
                                        </span>
                                        <label class="control-label" for="name_event">Nom de l'événement <small>*</small></label>
                                        <input type="text" name="name_event" id="name_event" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row justify-content-md-center">
                                    <div class="col-lg-6">
                                        <div class="form-group label-floating datetime-label">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="zmdi zmdi-calendar-alt"></i>
                                                </span>
                                                <label class="control-label" for="begin_date">Date de début <small>*</small></label>
                                                <input type="datetime-local" name="begin_date" id="begin_date" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group label-floating datetime-label">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="zmdi zmdi-calendar"></i>
                                                </span>
                                                <label class="control-label" for="end_date">Date de fin <small>*</small></label>
                                                <input type="datetime-local" name="end_date" id="end_date" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group label-floating">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="zmdi zmdi-filter-list"></i>
                                        </span>
                                        <label class="control-label" for="description_event">Description de l'événement <small>*</small></label>
                                        <textarea name="description_event" id="description_event" class="form-control" rows="4" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group label-floating">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="zmdi zmdi-upload"></i>
                                        </span>
                                        <input type="text" readonly="true" class="form-control" placeholder="Affiche de l'événement - Parcourir... *">
                                        <input type="file" name="poster" id="poster" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group label-floating">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="zmdi zmdi-facebook"></i>
                                        </span>
                                        <label class="control-label" for="facebook_event_link">Lien de l'événement Facebook</label>
                                        <input type="url" name="facebook_event_link" id="facebook_event_link" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="zmdi zmdi-accounts"></i>
                                        </span>
                                        <select name="asso" id="asso" class="form-control selectpicker" data-dropup-auto="false" required>
                                            <option disabled selected value>Association organisatrice <small>*</small></option>
                                            <?php
                                                if (!is_null($Assos))
                                                    foreach($Assos as $Asso)
                                                        echo "<option value=".$Asso['id_asso'].">".$Asso['name_asso']."</option>";
                                                else
                                                    echo "<option disabled value>Vous devez d'abord ajouter au moins une association</option>"
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                            <button class="btn btn-raised btn-primary btn-block" type="submit">Ajouter un événement<i class="zmdi zmdi-long-arrow-right no-mr ml-1"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
