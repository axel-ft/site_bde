<!DOCTYPE html>
<html lang="fr">

<head>
    <title>BDE Ynov Paris</title>
    <?php require_once('views/include/CommonHead.view.php'); ?>
</head>

<body>
    <?php require_once('views/include/NavBar.view.php'); ?>

    <div class="ms-hero-page ms-hero-img-team ms-hero-bg-royal">
        <div class="container">
            <div class="text-center">
                <h2 class="no-m ms-site-title color-white center-block ms-site-title-lg mt-2 animated zoomInDown animation-delay-5">Événements</h2>
                <p class="lead lead-lg color-light text-center center-block mt-2 mw-800 text-uppercase fw-300 animated fadeInUp animation-delay-7">Qu'ils soient passés ou à venir, l'agenda associatif du campus se trouve ici<br>Défilez pour plus d'infos</p>
                <div class="row justify-content-center mt-4">
                    <div class="col-md-7 col-lg-6">
                        <table class="table table-bordered table-condensed bg-light text-center calendar">
                            <caption class="color-light fw-400 h3">
                                <div class="row">
                                    <div class="col-6 text-left">
                                        <p class="mt-2"><?= $Cal->GetFullMonthName() . ' ' . $Cal->GetCalYear() ?></p>
                                    </div>
                                    <div class="col-6 text-right">
                                        <a href="/events/<?= $Cal->GetPreviousCalMonth() ?>" data-toggle="tooltip" data-placement="bottom" title="<?= $Cal->GetPreviousFullMonthName() . ' ' . $Cal->GetCalYear() ?>" class="btn-circle btn-circle-raised btn-circle-primary mr-2"><i class="zmdi zmdi-chevron-left"></i></a>
                                        <a href="/events/<?= $Cal->GetNextCalMonth() ?>" data-toggle="tooltip" data-placement="bottom" title="<?= $Cal->GetNextFullMonthName() . ' ' . $Cal->GetCalYear() ?>" class="btn-circle btn-circle-raised btn-circle-primary ml-2"><i class="zmdi zmdi-chevron-right"></i></a>
                                    </div>
                                </div>
                            </caption>
                            <?= $CalHTML ?>
                        </table>
                    </div>
                    <div class="col-md-5 col-lg-6 d-none d-md-block">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Résumé</h3>
                            </div>
                            <table class="table table-no-border">
                                <thead></thead>
                                <tbody>
                                <?php
                                    if (!is_null($Events) && !empty($Events))
                                    {
                                        foreach ($Events as $Event)
                                        {
                                            echo '<tr><td>' . htmlentities($Event['name_event']) . '</td><td>' . htmlentities($Event['begin_date']->format('d/m/Y')) . '</td><td class="d-none d-lg-table-cell">Par</td></tr>';
                                        }
                                    }

                                    else
                                    {
                                        echo '<tr><td>Pas événement ce mois</td></tr>';
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container container-full">
        <h2 class="text-center">
            <span class="badge badge-primary"><?= $Cal->GetFullMonthName() . ' ' . $Cal->GetCalYear() ?></span>
        </h2>

        <?php
        if (!is_null($Events) && !empty($Events))
        {
            echo '<section class="row timeline-center">';

            for ($i = 0; $i < \count($Events); $i++)
            {
                if ($i % 2 === 0)
                {
        ?>

            <div class="col-md-6">
                <article class="card card-primary timeline-center-item left wow slideInLeftTiny">
                    <header class="card-header">
                        <h3 class="card-title">
                            <i class="zmdi zmdi-flag"></i><?= htmlentities($Events[$i]['name_event']) ?>
                        </h3>
                    </header>
                    <img src="<?= htmlentities($Events[$i]['poster']) ?>" alt="Affiche" class="img-fluid">
                    <div class="card-block">
                        <p><?= strftime('le %e %B %G', htmlentities($Events[$i]['begin_date']->getTimestamp())) ?></p>
                        <p><?= htmlentities($Events[$i]['description_event']) ?></p>
                        <div class="text-center"><a href="#" class="btn btn-raised">En savoir plus...</a></div>
                    </div>
                </article>
            </div>

        <?php } else { ?>

            <div class="col-md-6">
                <article class="card card-primary timeline-center-item right wow fadeInUp">
                    <header class="card-header">
                        <h3 class="card-title">
                            <i class="zmdi zmdi-flag"></i><?= htmlentities($Events[$i]['name_event']) ?>
                        </h3>
                    </header>
                    <img src="<?= htmlentities($Events[$i]['poster']) ?>" alt="Affiche" class="img-fluid">
                    <div class="card-block">
                        <p><?= strftime('le %e %B %G', htmlentities($Events[$i]['begin_date']->getTimestamp())) ?></p>
                        <p><?= htmlentities($Events[$i]['description_event']) ?></p>
                        <div class="text-center"><a href="#" class="btn btn-raised">En savoir plus...</a></div>
                    </div>
                </article>
            </div>

        <?php
                }
            }
        }

        else {
        ?>
        <section>
            <div class="col-md-12">
                <article class="card card-primary wow fadeInUp">
                    <header class="card-header">
                        <h3 class="card-title">
                            <i class="zmdi zmdi-close-circle"></i>Pas d'événement
                        </h3>
                    </header>
                    <div class="card-block">
                        <p class="text-center">Pas d'événement ce mois</p>
                    </div>
                </article>
            </div>

        <?php } ?>
        </section>

    </div>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
