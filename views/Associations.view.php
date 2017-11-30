<!DOCTYPE html>
<html lang="fr">

<head>
    <title>BDE Ynov Paris</title>
    <?php require_once('views/include/CommonHead.view.php'); ?>
</head>

<body>
    <?php require_once('views/include/NavBar.view.php'); ?>

    <section id="associations">
        <h2>Associations</h2>
        <?php
        if (!is_null($Associations) && !empty($Associations))
        {
            foreach ($Associations as $Asso)
            {
        ?>
                <article class="asso">
                    <a class="logo_asso" href="#<?= htmlentities($Asso['name_asso']) ?>" title="<?= htmlentities($Asso['acronym']) ?>"><img src="<?= htmlentities($Asso['logo']) ?>"></a>
                    <a class="name_asso" href="#<?= htmlentities($Asso['name_asso']) ?>" title="<?= htmlentities($Asso['acronym']) ?>"><h3><?= htmlentities($Asso['name_asso']) ?></h3></a>

                    <div id="<?= htmlentities($Asso['name_asso']) ?>" class="modal">
                        <div>
                            <a href="#close" title="Fermer" class="close_modal">X</a>
                            <div class="modal_header">
                                <div>
                                    <img src="http://www.acteus.com/wp-content/uploads/2016/08/equipe-regulation.jpg" alt="Photo d'équipe" class="team">
                                    <div class="modal_name"><h3><?= htmlentities($Asso['name_asso']) ?></h3></div>
                                </div>
                            </div>
                            <div class="modal_image"><div><img src="<?= htmlentities($Asso['logo']) ?>"></div></div>
                            <div class="modal_social">
<?php

                                if (!is_null($Asso['email']) && !empty(htmlentities($Asso['email'])))
                                    echo '<a class="social" href="mailto:' . $Asso['email'] . '" title="Envoyer un mail à ' . $Asso['name_asso'] . '" target="_blank">Mail</a>&nbsp;';

                                if (!is_null($Asso['facebook_link']) && !empty(htmlentities($Asso['facebook_link'])))
                                    echo '<a class="social" href="' . $Asso['facebook_link'] . '" title="' . $Asso['name_asso'] . ' sur Facebook" target="_blank">Facebook</a>';

                                if (!is_null($Asso['twitter_link']) && !empty(htmlentities($Asso['twitter_link'])))
                                    echo '&nbsp;<a class="social" href="' . $Asso['twitter_link'] . '" title="' . $Asso['name_asso'] . ' sur Twitter" target="_blank">Twitter</a>';

                                ?>
                            </div>
                            <div class="modal_body"><p><?= htmlentities($Asso['description_asso']) ?></p></div>
                        </div>
                    </div>
                </article>
        <?php
            }
        }

        else
        {
    ?>
        <div>Aucune association</div>
    <?php } ?>
    </section>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
