<!DOCTYPE html>
<html lang="fr">

<head>
    <title>BDE Ynov Paris</title>
    <?php require_once('views/include/CommonHead.view.php'); ?>
</head>

<body>
    <?php require_once('views/include/NavBar.view.php'); ?>

    <div class="container-fluid">
         <?php
            if ($Message !== null) echo $Message;

            if (!is_null($AllStaff))
            {
                echo '<div aria-multiselectable="true" role="tablist" class="ms-collapse" id="allstaff">';
                $OpenTabKey = (!is_null($IdAsso)) ? $IdAsso : array_keys($AllStaff)[0];

                foreach ($AllStaff as $Key => $Staff) {
                ?>

                    <div class="mb-0 card card-default">
                        <div role="tab" class="card-header" id="asso_<?= $Key ?>">
                            <h4 class="card-title ms-rotate-icon">
                            <a href="#<?= preg_replace('/[^a-zA-Z0-9]+/', '', $Staff['name_asso']) ?>" role="button" data-parent="#allstaff" data-toggle="collapse" class="collapsed" aria-expanded="false" aria-controls="<?= preg_replace('/[^a-zA-Z0-9]+/', '', $Staff['name_asso']) ?>">
                                    <i class="zmdi zmdi-accounts mr-1 r-360"></i><?= $Staff['name_asso']?>
                                </a>
                            </h4>
                        </div>
                        <div aria-labelledby="asso_<?= $Key ?>" role="tabpanel" class="card-collapse collapse<?= ($OpenTabKey === $Key) ? ' show' : '' ?>" id="<?= preg_replace('/[^a-zA-Z0-9]+/', '', $Staff['name_asso']) ?>">
                            <div class="card-block">
                                <a class="btn btn-raised btn-success" href="/manage/staff/<?= htmlentities($Key) ?>/add">Ajouter un membre</a>
                                <div class="row">
                                <?php
                                foreach($Staff as $Member) {
                                    if (is_array($Member)) {
                                ?>

                                        <div class="col-lg-3 col-md-4 col-sm-6">
                                            <div class="panel panel-primary">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title text-center">
                                                        <i class="zmdi zmdi-account mr-1"></i> <?= $Member['position'] ?>
                                                    </h3>
                                                </div>
                                                <div class="withripple zoom-img">
                                                    <img src="<?= $Member['avatar'] ?>" alt="Photo de profil" class="img-fluid">
                                                </div>
                                                <div class="panel-body text-center">
                                                    <a href="/manage/profiles/edit/<?= $Member['id_profile'] ?>" title="Modifier le profil"><?= $Member['first_name'] . ' ' . $Member['last_name'] ?></a>
                                                    <a href="/manage/staff/<?= htmlentities($Key) ?>/edit/<?= htmlentities($Member['id_profile']) ?>" class="btn btn-raised btn-primary btn-block">Nouveau poste</a>
                                                    <a href="/manage/staff/<?= htmlentities($Key) ?>/delete/<?= htmlentities($Member['id_profile']) ?>" class="btn btn-raised btn-danger btn-block">Retirer</a>
                                                </div>
                                            </div>
                                        </div>

                                <?php
                                    }
                                }
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>




                <?php
                }

                echo '</div>';
            }

            else
            {
                echo "Aucune association pour le moment";
            }
        ?>
    </div>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
