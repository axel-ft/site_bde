<!DOCTYPE html>
<html lang="fr">

<head>
    <title>BDE Ynov Paris</title>
    <?php require_once('views/include/CommonHead.view.php'); ?>
</head>

<body>
    <?php require_once('views/include/NavBar.view.php'); ?>

    <section>
        <form method="POST" action="/manage/events/add">
            <?php if ($Message !== null) echo '<div>'.$Message.'</div>'; ?>
            <div class="field">
                <label class="icon" for="name_event"><i class="material-icons">person</i></label>
                <input type="text" name="name_event" id="name_event" placeholder=" " required>
                <label class="text" for="name_event">Nom de l'événement *</label>
            </div>
            <div class="field">
                <label class="icon" for="begin_date"><i class="material-icons">lock</i></label>
                <input type="datetime-local" name="begin_date" id="begin_date" placeholder=" " required>
                <label class="text" for="begin_date">Date de début *</label>
            </div>
            <div class="field">
                <label class="icon" for="end_date"><i class="material-icons">lock</i></label>
                <input type="datetime-local" name="end_date" id="end_date" placeholder=" " required>
                <label class="text" for="end_date">Date de fin *</label>
            </div>
            <div class="field">
                <label class="icon" for="description_event"><i class="material-icons">lock</i></label>
                <textarea name="description_event" id="description_event" placeholder=" " required></textarea>
                <label class="text" for="description_event">Description de l'événement *</label>
            </div>
            <div class="field">
                <label class="icon" for="facebook_event_link"><i class="material-icons">contacts</i></label>
                <input type="url" name="facebook_event_link" id="facebook_event_link" placeholder=" " required>
                <label class="text" for="facebook_event_link">Lien de l'événement Facebook *</label>
            </div>
            <div class="field">
                <label class="icon" for="asso"><i class="material-icons">person</i></label>
                <select name="asso" id="asso" required>
                    <option disabled selected value>Association organisatrice</option>
                    <?php
                        if (!is_null($Assos))
                            foreach($Assos as $Asso)
                                echo "<option value=".$Asso['id_asso'].">".$Asso['name_asso']."</option>";
                        else
                            echo "<option disabled value>Vous devez d'abord ajouter au moins un profil</option>"
                    ?>
                </select>
                <label class="text" for="asso">Association organisatrice *</label>
            </div>

            <div class="field">
                <button class="button" type="submit">Ajouter un événement</button>
            </div>
        </form>
    </section>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
