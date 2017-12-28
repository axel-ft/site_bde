<!DOCTYPE html>
<html lang="fr">

<head>
    <title>BDE Ynov Paris</title>
    <?php require_once('views/include/CommonHead.view.php'); ?>
</head>

<body>
    <?php require_once('views/include/NavBar.view.php'); ?>

    <div class="container container-full">
        <h3 class="text-center">
            <span class="badge badge-primary">MOIS ANNEE</span>
        </h3>

        <section class="row timeline-center">
        <?php
        if (!is_null($Events) && !empty($Events))
        {
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

        else echo '<div>Aucun événement</div>';
        ?>
        </section>
    </div>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
