<div id="ms-preload" class="ms-preload">
    <div id="status">
        <div class="spinner">
            <div class="dot1"></div>
            <div class="dot2"></div>
        </div>
    </div>
</div>

<div class="ms-site-container">
  <?php if (!isset($_SESSION['connected'])) { ?>
    <div class="modal modal-primary" id="ms-account-modal" tabindex="-1" role="dialog" aria-labelledby="Mon compte">
        <div class="modal-dialog modal-lg animated zoomIn animated-3x" role="document">
            <div class="modal-content">
                <div class="modal-header d-block shadow-2dp no-pb">
                    <button type="button" class="close d-inline pull-right mt-2" data-dismiss="modal" aria-label="Fermer">
                        <span aria-hidden="true">
                            <i class="zmdi zmdi-close"></i>
                        </span>
                    </button>
                    <div class="modal-title text-center">
                        <span class="ms-logo ms-logo-white ms-logo-sm mr-1">Y</span>
                        <h3 class="no-m ms-site-title">Inter-
                            <span>Assos</span>
                        </h3>
                    </div>
                    <div class="modal-header-tabs">
                        <ul class="nav nav-tabs nav-tabs-full nav-tabs-3 nav-tabs-primary" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a href="#ms-login-tab" aria-controls="ms-login-tab" role="tab" data-toggle="tab" class="nav-link active withoutripple">
                                    <i class="zmdi zmdi-account"></i> Connexion</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#ms-signup-tab" aria-controls="ms-signup-tab" role="tab" data-toggle="tab" class="nav-link withoutripple">
                                    <i class="zmdi zmdi-account-add"></i> Inscription</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#ms-recovery-tab" aria-controls="ms-recovery-tab" role="tab" data-toggle="tab" class="nav-link withoutripple">
                                    <i class="zmdi zmdi-key"></i> Mot de passe oublié</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active show" id="ms-login-tab">
                            <form method="POST" action="/login">
                                <fieldset>
                                    <div class="form-group label-floating">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="zmdi zmdi-account"></i>
                                            </span>
                                            <label class="control-label" for="username_login">Nom d'utilisateur <small>*</small></label>
                                            <input type="text" id="username_login" name="username" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group label-floating">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="zmdi zmdi-lock"></i>
                                            </span>
                                            <label class="control-label" for="password_login">Mot de passe <small>*</small></label>
                                            <input type="password" id="password_login" name="password" class="form-control" required>
                                        </div>
                                    </div>
                                </fieldset>
                                <button type="submit" class="btn btn-raised btn-primary btn-block">Se connecter <i class="zmdi zmdi-long-arrow-right no-mr ml-1"></i></button>
                            </form>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="ms-signup-tab">
                            <form method="POST" action="/signup" enctype="multipart/form-data">
                                <fieldset>
                                    <div class="row justify-content-md-center">
                                        <div class="col-lg-6">
                                            <div class="form-group label-floating">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="zmdi zmdi-account"></i>
                                                    </span>
                                                    <label class="control-label" for="username_signup">Nom d'utilisateur <small>*</small></label>
                                                    <input type="text" id="username_signup" name="username" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group label-floating">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="zmdi zmdi-email"></i>
                                                    </span>
                                                    <label class="control-label" for="email">E-mail <small>*</small></label>
                                                    <input type="email" id="email" name="email" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-md-center">
                                        <div class="col-lg-6">
                                            <div class="form-group label-floating">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="zmdi zmdi-lock"></i>
                                                    </span>
                                                    <label class="control-label" for="password_signup">Mot de passe <small>*</small></label>
                                                    <input type="password" id="password_signup" name="password" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group label-floating">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="zmdi zmdi-lock"></i>
                                                    </span>
                                                    <label class="control-label" for="password_confirm_signup">Mot de passe (confirmation) <small>*</small></label>
                                                    <input type="password" id="password_confirm_signup" name="password_confirm" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-md-center">
                                        <div class="col-lg-6">
                                            <div class="form-group label-floating">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="zmdi zmdi-account"></i>
                                                    </span>
                                                    <label class="control-label" for="first_name">Prénom <small>*</small></label>
                                                    <input type="text" id="first_name" name="first_name" class="form-control" required>
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
                                                    <input type="text" id="last_name" name="last_name" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-md-center">
                                        <div class="col-lg-6">
                                            <div class="form-group label-floating">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="zmdi zmdi-upload"></i>
                                                    </span>
                                                    <input type="text" readonly="true" class="form-control" placeholder="Photo de profil - Parcourir...">
                                                    <input type="file" id="avatar" name="avatar" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group label-floating">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="zmdi zmdi-facebook"></i>
                                                    </span>
                                                    <label class="control-label" for="facebook_link">Lien Facebook</label>
                                                    <input type="url" id="facebook_link" name="facebook_link" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <fieldset>
                                <button type="submit" class="btn btn-raised btn-primary btn-block">Créer un compte <i class="zmdi zmdi-long-arrow-right no-mr ml-1"></i></button>
                            </form>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="ms-recovery-tab">
                            <p class="text-center">La récupération automatique du mot de passe n'est pas encore possible. Vous pouvez nous contacter pour récupérer votre accès</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>

    <header class="ms-header ms-header-primary">
        <div class="container container-full">
            <div class="ms-title">
                <a href="/home">
                    <span class="ms-logo animated zoomInDown animation-delay-5">Y</span>
                    <h1 class="animated fadeInRight animation-delay-6">Inter-<span>Assos</span></h1>
                </a>
            </div>

            <div class="header-right">
                <div class="share-menu">
                    <ul class="share-menu-list">
                        <li class="animated fadeInRight animation-delay-1">
                            <a href="https://www.facebook.com/tim.pandora.71" target="_blank" class="btn-circle btn-facebook">
                                <i class="zmdi zmdi-facebook"></i>
                            </a>
                        </li>
                    </ul>
                    <a href="javascript:void(0)" class="btn-circle btn-circle-primary animated zoomInDown animation-delay-7">
                        <i class="zmdi zmdi-share"></i>
                    </a>
                </div>
                <a class="btn-circle btn-circle-primary no-focus animated zoomInDown animation-delay-8" <?= (isset($_SESSION['connected'])) ? 'href="/myprofile"' : 'href="javascript:void(0)" data-toggle="modal" data-target="#ms-account-modal"' ?>>
                    <i class="zmdi zmdi-account"></i>
                </a>
                <form action="/search" method="POST" class="search-form animated zoomInDown animation-delay-9">
                    <input id="search-box" type="search" class="search-input" placeholder="Rechercher..." name="query" />
                    <label for="search-box">
                        <i class="zmdi zmdi-search"></i>
                    </label>
                </form>
                <a href="javascript:void(0)" class="btn-ms-menu btn-circle btn-circle-primary ms-toggle-left animated zoomInDown animation-delay-10">
                    <i class="zmdi zmdi-menu"></i>
                </a>
            </div>
        </div>
    </header>

    <nav class="navbar navbar-expand-md navbar-static ms-navbar ms-navbar-primary">
        <div class="container container-full">
            <div class="navbar-header">
                <a class="navbar-brand" href="/home">
                    <span class="ms-logo ms-logo-sm">Y</span>
                    <span class="ms-title">Inter-Assos</span>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="ms-navbar">
                <ul class="navbar-nav">
                    <li class="nav-item <?php if ($_SERVER['REQUEST_URI'] === '/home') echo "active" ?>">
                        <a class="nav-link animated fadeIn animation-delay-7" role="button" data-name="home" href="/home">Accueil</a>
                    </li>
                    <li class="nav-item <?php if ($_SERVER['REQUEST_URI'] === '/assos') echo "active" ?>">
                        <a class="nav-link animated fadeIn animation-delay-7" role="button" data-name="assos" href="/assos">Associations</a>
                    </li>
                    <li class="nav-item <?php if ($_SERVER['REQUEST_URI'] === '/events') echo "active" ?>">
                        <a class="nav-link animated fadeIn animation-delay-7" role="button" data-name="events" href="/events">Événements</a>
                    </li>
                    <li class="nav-item <?php if ($_SERVER['REQUEST_URI'] === '/bde') echo "active" ?>">
                        <a class="nav-link animated fadeIn animation-delay-7" role="button" data-name="bde" href="/bde">BDE</a>
                    </li>
                    <li class="nav-item <?php if ($_SERVER['REQUEST_URI'] === '/contact') echo "active" ?>">
                        <a class="nav-link animated fadeIn animation-delay-7" role="button" data-name="contact" href="/contact">Contact</a>
                    </li>

                    <?php if (!isset($_SESSION['connected'])) { ?>
                        <li class="nav-item <?php if ($_SERVER['REQUEST_URI'] === '/login') echo "active" ?>">
                            <a class="nav-link animated fadeIn animation-delay-8" role="button" data-name="login" href="/login">Connexion</a>
                        </li>
                        <li class="nav-item <?php if ($_SERVER['REQUEST_URI'] === '/signup') echo "active" ?>">
                            <a class="nav-link animated fadeIn animation-delay-9" role="button" data-name="signup" href="/signup">Inscription</a>
                        </li>
                    <?php } else if ($_SESSION['connected']) { ?>
                        <li class="nav-item <?php if ($_SERVER['REQUEST_URI'] === '/myprofile') echo "active" ?>">
                            <a class="nav-link animated fadeIn animation-delay-9" role="button" data-name="signup" href="/myprofile">Mon compte</a>
                        </li>
                            <?php if (isset($_SESSION['manager'])) { ?>
                        <li class="nav-item dropdown <?php if(strpos($_SERVER['REQUEST_URI'], "manage") !== false) echo "active" ?>">
                            <a class="nav-link dropdown-toggle animated fadeIn animation-delay-8" data-toggle="dropdown" data-hover="dropdown" role="button" aria-haspopup="true" aria-expanded="false" data-name"manage" href="javascript:void(0)">Administration<i class="zmdi zmdi-chevron-down ml-1"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/manage/assos">Associations</a></li>
                                <li><a class="dropdown-item" href="/manage/staff">Membres</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="/manage/events">Événements</a></li>
                                <li><a class="dropdown-item" href="/manage/photos">Photos</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="/manage/categories">Catégories</a></li>
                                <li><a class="dropdown-item" href="/manage/posts">Articles</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="/manage/profiles">Profils</a></li>
                                <li><a class="dropdown-item" href="/manage/users">Utilisateurs</a></li>
                            </ul>
                        </li>
                            <?php } ?>
                        <li class="nav-item <?php if ($_SERVER['REQUEST_URI'] === '/logout') echo "active" ?>">
                            <a class="nav-link animated fadeIn animation-delay-9" role="button" data-name="logout" href="/logout">Déconnexion</a>
                        </li>
                    <?php } ?>

                </ul>
            </div>

            <a href="javascript:void(0)" class="ms-toggle-left btn-navbar-menu">
                <i class="zmdi zmdi-menu"></i>
            </a>

        </div>
    </nav>

    <!--<div class="material-background"></div>-->
