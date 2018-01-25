<!DOCTYPE html>
<html lang="fr">

<head>
    <title>BDE Ynov Paris</title>
    <?php require_once('views/include/CommonHead.view.php'); ?>
</head>

<body>
    <?php require_once('views/include/NavBar.view.php'); ?>

    <div style="background-image: url(http://www.acteus.com/wp-content/uploads/2016/08/equipe-regulation.jpg)" class="ms-hero-page-override ms-hero-img-team ms-hero-bg-dark">
    </div>

    <div class="container">
        <?php if ($Message !== null) echo $Message; ?>
        <div class="row">
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-top animated fadeInUp animation-delay-7">
                            <div class="ms-hero-bg-primary ms-hero-img-team">
                                <h3 class="color-white index-1 text-center no-m pt-4"><?= htmlentities($Asso['name_asso']) ?></h3>
                                <?= (!is_null($Asso['acronym'])) ? '<div class="color-medium index-1 text-center np-m">@' . htmlentities($Asso['acronym']) . '</div>' : '' ?>
                                <?= '<img src="' . htmlentities($Asso['logo']) . '" alt="Logo de l\'association" class="img-avatar-circle bg-light">' ?>
                            </div>
                            <div class="card-block pt-4 text-center">
                                <h3 class="color-primary">À propos de nous</h3>
                                <p><?php echo (!is_null($Asso['description_asso'])) ? htmlentities($Asso['description_asso']) : 'Pas de description' ?></p>
                                <?= (!empty($Asso) && !is_null($Asso['email'])) ? '<a href="mailto:' . htmlentities($Asso['email']) . '" class="btn-circle btn-circle-raised btn-circle-xs mt-1 mr-1 no-mr-md btn-circle-primary" title="Envoyer un mail à ' . htmlentities($Asso['name_asso']) . '"><i class="zmdi zmdi-email"></i></a>' : '' ?>
                                <?= (!empty($Asso) && !is_null($Asso['facebook_link'])) ? '<a href="' . htmlentities($Asso['facebook_link']) . '" class="btn-circle btn-circle-raised btn-circle-xs mt-1 mr-1 no-mr-md btn-facebook"><i class="zmdi zmdi-facebook"></i></a>' : '' ?>
                                <?= (!empty($Asso) && !is_null($Asso['twitter_link'])) ? '<a href="' . htmlentities($Asso['twitter_link']) .'" class="btn-circle btn-circle-raised btn-circle-xs mt-1 mr-1 no-mr-md btn-twitter"><i class="zmdi zmdi-twitter"></i></a>' : '' ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-primary animated fadeInUp animation-delay-7">
                            <div class="card-header">
                                <h3 class="card-title">Ce mois-ci</h3>
                            </div>
                            <div class="card-block">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card card-top card-primary animated fadeInUp animation-delay-12">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="zmdi zmdi-globe-alt"></i> Vue d'ensemble
                        </h3>
                    </div>
                    <table class="table table-no-border table-striped">
                        <tbody>
                            <tr>
                                <th><i class="zmdi zmdi-accounts mr-1"></i> Nom de l'association</th>
                                <td><?= (!empty($Asso)) ? htmlentities($Asso['name_asso']) : '' ?></td>
                            </tr>
                            <tr>
                                <th><i class="zmdi zmdi-font mr-1"></i> Acronyme</th>
                                <td><?= (!empty($Asso) && !is_null($Asso['acronym'])) ? htmlentities($Asso['acronym']) : '-' ?></td>
                            </tr>
                            <tr>
                                <th><i class="zmdi zmdi-email mr-1"></i> Adresse mail</th>
                                <td><?= (!empty($Asso) && !is_null($Asso['email'])) ? htmlentities($Asso['email']) : '-' ?></td>
                            </tr>
                            <tr>
                                <th><i class="zmdi zmdi-phone mr-1"></i> Numéro de téléphone</th>
                                <td><?= (!empty($Asso) && !is_null($Asso['phone'])) ? htmlentities($Asso['phone']) : '-' ?></td>
                            </tr>
                            <tr>
                                <th><i class="zmdi zmdi-facebook mr-1"></i> Lien Facebook</th>
                                <td><?= (!empty($Asso) && !is_null($Asso['facebook_link'])) ? '<a href="' . htmlentities($Asso['facebook_link']) . '" target=_blank>' . htmlentities($Asso['facebook_link']) . '</a>' : '-' ?></td>
                            </tr>
                            <tr>
                                <th><i class="zmdi zmdi-twitter mr-1"></i> Lien Twitter</th>
                                <td><?= (!empty($Asso) && !is_null($Asso['twitter_link'])) ? '<a href="' . htmlentities($Asso['twitter_link']) . '" target=_blank>' . htmlentities($Asso['twitter_link']) . '</a>' : '-' ?></td>
                            </tr>
                            <tr>
                                <th><i class="zmdi zmdi-accounts mr-1"></i> Nombre de membres</th>
                                <td><?= (isset($Staff) && !is_null($Staff)) ? count($Staff) : '0' ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="row d-flex justify-content-center">
                    <?php
                        if (isset($Staff) && !is_null($Staff))
                        {
                            foreach ($Staff as $Member)
                            {
                    ?>
                    <div class="col-lg-6">
                        <div class="card card-primary wow fadeInUp mb-4 animation-delay-15">
                            <div class="withripple zoom-img">
                                <a href="/profile/<?= htmlentities($Member['id_profile']) ?>" title="Voir le profil">
                                <img src="<?= htmlentities($Member['avatar']) ?>" alt="Photo de profil" class="img-fluid">
                                </a>
                            </div>
                            <div class="card-block">
                                <span class="label label-primary pull-right"><?= htmlentities($Member['position']) ?></span><br>
                                <h3 class="color-primary"><?= $Member['first_name'] . " " . $Member['last_name'] ?></h3>
                                <p><?= (!empty($Member) && !is_null($Member['description_profile'])) ? htmlentities($Member['description_profile']) : "Pas de description" ?></p>
                                <div class="row">
                                    <div class="col">
                                        <?= (!empty($Member) && !is_null($Member['email'])) ? '<a href="mailto:' . htmlentities($Member['email']) . '" class="btn-circle btn-circle-raised btn-circle-xs mt-1 mr-1 no-mr-md btn-circle-primary"><i class="zmdi zmdi-email"></i></a>' : '' ?>
                                        <?= (!empty($Member) && !is_null($Member['facebook_link'])) ? '<a href="' . htmlentities($Member['facebook_link']) . '" class="btn-circle btn-circle-raised btn-circle-xs mt-1 mr-1 no-mr-md btn-facebook"><i class="zmdi zmdi-facebook"></i></a>' : '' ?>
                                        <?= (!empty($Member) && !is_null($Member['twitter_link'])) ? '<a href="' . htmlentities($Member['twitter_link']) .'" class="btn-circle btn-circle-raised btn-circle-xs mt-1 mr-1 no-mr-md btn-twitter"><i class="zmdi zmdi-twitter"></i></a>' : '' ?>
                                    </div>
                                    <div class="col text-right">
                                        <a href="/profile/<?= htmlentities($Member['id_profile']) ?>" class="btn btn-raised btn-sm btn-primary">
                                            <i class="zmdi zmdi-account mr-1"></i> Profil
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                            }
                        };
                    ?>
                </div>
            </div>
        </div>
    </div>


    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
