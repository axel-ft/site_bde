<!DOCTYPE html>
<html lang="fr">

<head>
    <title>BDE Ynov Paris</title>
    <?php require_once('views/include/CommonHead.view.php'); ?>
</head>

<body>
    <?php require_once('views/include/NavBar.view.php'); ?>

    <section>
        <form method="POST" action="/manage/events/edit/<?php if(!is_null($IdEvent) && !empty($IdEvent)) echo htmlentities($IdEvent) ?>">
            <?php if ($Message !== null) echo '<div>'.$Message.'</div>'; ?>


            <div>
                <label for="name_event"><i class="material-icons">person</i></label>
                <input type="text" name="name_event" id="name_event" placeholder="Nom de l'événement" value="<?php if(!empty($Event)) echo htmlentities($Event['name_event']) ?>">
            </div>
            <div>
                <label for="begin_date"><i class="material-icons">lock</i></label>
                <input type="datetime-local" name="begin_date" id="begin_date" placeholder="Date de début" value="<?php if(!empty($Event)) echo htmlentities($Event['begin_date']->format('Y-m-d\TH:i:s')) ?>">
            </div>
            <div>
                <label for="end_date"><i class="material-icons">lock</i></label>
                <input type="datetime-local" name="end_date" id="end_date" placeholder="Date de fin" value="<?php if(!empty($Event)) echo htmlentities($Event['end_date']->format('Y-m-d\TH:i:s')) ?>">
            </div>
            <div>
                <label for="description_event"><i class="material-icons">lock</i></label>
                <textarea name="description_event" id="description_event" placeholder="Description de l'événement"><?php if(!empty($Event)) echo htmlentities($Event['description_event']) ?></textarea>
            </div>
            <div>
                <label for="facebook_event_link"><i class="material-icons">contacts</i></label>
                <input type="url" name="facebook_event_link" id="facebook_event_link" placeholder="Lien de l'événement Facebook" value="<?php if(!empty($Event)) echo htmlentities($Event['facebook_event_link']) ?>">
            </div>
            <div>
                <label for="asso"><i class="material-icons">person</i></label>
                <select name="asso" id="asso">
                    <option disabled value>Association organisatrice</option>
                    <?php
                        if (!is_null($Assos))
                            foreach($Assos as $Asso)
                                echo "<option value=".$Asso['id_asso'].((!empty($Event) && $Event['id_asso'] === $Asso['id_asso']) ? " selected" : "").">".$Asso['name_asso']."</option>";
                        else
                            echo "<option disabled value>Vous devez d'abord ajouter au moins une association</option>"
                    ?>
                </select>
            </div>

            <button type="submit">Mettre à jour l'événement</button>
        </form>
    </section>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
