<!DOCTYPE html>
<html lang="fr">

<head>
    <title>BDE Ynov Paris</title>
    <?php require_once('views/include/CommonHead.view.php'); ?>
</head>

<body>
    <?php require_once('views/include/NavBar.view.php'); ?>

    <div class="ms-hero-page-override ms-hero-img-team ms-hero-bg-info">
        <div class="container">
            <div class="text-center">
                <h1 class="no-m ms-site-title color-white center-block ms-site-title-lg mt-2 animated zoomInDown animation-delay-5">Contactez-<span>nous</span></h1>
                <p class="lead lead-lg color-white text-center center-block mt-2 mw-800 text-uppercase fw-300 animated fadeInUp animation-delay-7">Une question ? Une idée ? Une suggestion ? Vous savez quoi faire...</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-lg-12">
                <div class="card card-hero card-primary animated fadeInUp animation-delay-7">
                    <div class="card-block">
                        <?php if ($Message !== null) echo $Message ?>
                        <form method="POST" action="/contact" enctype="multipart/form-data">
                            <fieldset>
                                <div class="row justify-content-md-center">
                                    <div class="col-lg-6">
                                        <div class="form-group label-floating">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="zmdi zmdi-account"></i>
                                                </span>
                                                <label class="control-label" for="first_name">Prénom <small>*</small></label>
                                                <input type="text" id="first_name" name="first_name" class="form-control" required value="<?= (isset($this->ConnectedProfile) && !is_null($this->ConnectedProfile)) ? htmlentities($this->ConnectedProfile['first_name']): '' ?>">
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
                                                <input type="text" id="last_name" name="last_name" class="form-control" required value="<?= (isset($this->ConnectedProfile) && !is_null($this->ConnectedProfile)) ? htmlentities($this->ConnectedProfile['last_name']): '' ?>">
                                            </div>
                                        </div>
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
                                                <input type="email" id="email" name="email" class="form-control" required value="<?= (isset($this->ConnectedProfile) && !is_null($this->ConnectedProfile)) ? htmlentities($this->ConnectedProfile['email']) : '' ?>">
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
                                                <input type="tel" id="phone" name="phone" class="form-control" value="<?= (isset($this->ConnectedProfile) && !is_null($this->ConnectedProfile)) ? htmlentities($this->ConnectedProfile['phone']) : '' ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group label-floating">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="zmdi zmdi-arrow-split"></i>
                                        </span>
                                        <label class="control-label" for="subject">Sujet <small>*</small></label>
                                        <input type="text" id="subject" name="subject" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group label-floating">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="zmdi zmdi-comment-alt-text"></i>
                                        </span>
                                        <label class="control-label" for="message">Message <small>*</small></label>
                                        <textarea name="message" id="message" class="form-control" rows="6" required></textarea>
                                    </div>
                                </div>
                            <fieldset>
                            <button type="submit" class="btn btn-raised btn-primary btn-block">Envoyer votre message <i class="zmdi zmdi-long-arrow-right no-mr ml-1"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once('views/include/Scripts.view.php'); ?>
</body>

</html>
