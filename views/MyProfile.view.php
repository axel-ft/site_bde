<!DOCTYPE html>
<html lang="fr">

<head>
    <title>BDE Ynov Paris</title>
    <?php require_once('views/include/CommonHead.view.php'); ?>
</head>

<body>
    <?php require_once('views/include/NavBar.view.php'); ?>

    <div class="container">
        <?php if ($Message !== null) echo '<div>'.$Message.'</div>'; ?>
        <div class="row">
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-lg-12 col-md-6 order-md-1">
                        <div class="card animated fadeInUp animation-delay-7">
                            <div class="ms-hero-bg-primary ms-hero-img-coffee">
                                <h3 class="color-white index-1 text-center no-m pt-4"><?php if(!empty($AccountAndProfile)) echo htmlentities($AccountAndProfile[1]['first_name']) ?> <?php if(!empty($AccountAndProfile)) echo htmlentities($AccountAndProfile[1]['last_name']) ?></h3>
                                <div class="color-medium index-1 text-center np-m">@<?php if(!empty($AccountAndProfile)) echo htmlentities($AccountAndProfile[0]['username']) ?></div>
                                <img src="<?php if(!empty($AccountAndProfile)) echo htmlentities($AccountAndProfile[1]['avatar']) ?>" alt="Photo de profil" class="img-avatar-circle">
                            </div>
                            <div class="card-block pt-4 text-center">
                                <h3 class="color-primary">À propos de moi</h3>
                                <p><?php echo (!is_null($AccountAndProfile[1]['description_profile'])) ? htmlentities($AccountAndProfile[1]['description_profile']) : 'Pas de description' ?></p>
                                <?= (!empty($AccountAndProfile) && !is_null($AccountAndProfile[1]['email'])) ? '<a href="mailto:' . htmlentities($AccountAndProfile[1]['email']) . '" class="btn-circle btn-circle-raised btn-circle-xs mt-1 mr-1 no-mr-md btn-circle-primary"><i class="zmdi zmdi-email"></i></a>' : '' ?>
                                <?= (!empty($AccountAndProfile) && !is_null($AccountAndProfile[1]['facebook_link'])) ? '<a href="' . htmlentities($AccountAndProfile[1]['facebook_link']) . '" class="btn-circle btn-circle-raised btn-circle-xs mt-1 mr-1 no-mr-md btn-facebook"><i class="zmdi zmdi-facebook"></i></a>' : '' ?>
                                <?= (!empty($AccountAndProfile) && !is_null($AccountAndProfile[1]['twitter_link'])) ? '<a href="' . htmlentities($AccountAndProfile[1]['twitter_link']) .'" class="btn-circle btn-circle-raised btn-circle-xs mt-1 mr-1 no-mr-md btn-twitter"><i class="zmdi zmdi-twitter"></i></a>' : '' ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 order-md-2 order-lg-2">
                        <a href="/myprofile/edit" class="btn btn-raised btn-block btn-warning animated fadeInUp animation-delay-12">
                            <i class="zmdi zmdi-edit"></i> Mettre à jour mon profil
                        </a>
                        <a href="/myprofile/deactivate" class="btn btn-raised btn-block btn-danger animated fadeInUp animation-delay-12">
                            <i class="zmdi zmdi-delete"></i> Désactiver mon profil
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card card-primary animated fadeInUp animation-delay-12">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="zmdi zmdi-account-circle"></i> Vue d'ensemble
                        </h3>
                    </div>
                    <table class="table table-no-border table-striped">
                        <tbody>
                            <tr>
                                <th><i class="zmdi zmdi-account mr-1"></i> Nom d'utilisateur</th>
                                <td><?php if(!empty($AccountAndProfile)) echo htmlentities($AccountAndProfile[0]['username']) ?></td>
                            </tr>
                            <tr>
                                <th><i class="zmdi zmdi-face mr-1"></i> Nom complet</th>
                                <td><?php if(!empty($AccountAndProfile)) echo htmlentities($AccountAndProfile[1]['first_name']) ?> <?php if(!empty($AccountAndProfile)) echo htmlentities($AccountAndProfile[1]['last_name']) ?></td>
                            </tr>
                            <tr>
                                <th><i class="zmdi zmdi-email mr-1"></i> Adresse mail</th>
                                <td><?php if(!empty($AccountAndProfile)) echo htmlentities($AccountAndProfile[1]['email']) ?></td>
                            </tr>
                            <tr>
                                <th><i class="zmdi zmdi-phone mr-1"></i> Numéro de téléphone</th>
                                <td><?= (!empty($AccountAndProfile) && !is_null($AccountAndProfile[1]['phone'])) ? htmlentities($AccountAndProfile[1]['phone']) : '-' ?></td>
                            </tr>
                            <tr>
                                <th><i class="zmdi zmdi-facebook mr-1"></i> Lien Facebook</th>
                                <td><?= (!empty($AccountAndProfile) && !is_null($AccountAndProfile[1]['facebook_link'])) ? htmlentities($AccountAndProfile[1]['facebook_link']) : '-' ?></td>
                            </tr>
                            <tr>
                                <th><i class="zmdi zmdi-twitter mr-1"></i> Lien Twitter</th>
                                <td><?= (!empty($AccountAndProfile) && !is_null($AccountAndProfile[1]['twitter_link'])) ? htmlentities($AccountAndProfile[1]['twitter_link']) : '-' ?></td>
                            </tr>
                            <tr>
                                <th><i class="zmdi zmdi-accounts mr-1"></i> Association</th>
                                <td><?= (isset($Staff) && !is_null($Staff[0]['name_asso'])) ? htmlentities($Staff[0]['name_asso']) : '-' ?></td>
                            </tr>
                            <tr>
                                <th><i class="zmdi zmdi-filter-list mr-1"></i> Poste</th>
                                <td><?= (isset($Staff) && !is_null($Staff[0]['position'])) ? htmlentities($Staff[0]['position']) : '-' ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
