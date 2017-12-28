</div>
<div class="ms-slidebar sb-slidebar sb-left sb-style-overlay" id="ms-slidebar">
    <div class="sb-slidebar-container">
        <header class="ms-slidebar-header">
            <div class="ms-slidebar-login">
                <?php if (!isset($_SESSION['connected'])) { ?>
                <a href="/login" class="withripple">
                    <i class="zmdi zmdi-account"></i>Connexion
                </a>
                <a href="/signup" class="withripple">
                    <i class="zmdi zmdi-account-add"></i>Inscription
                </a>
                <?php } else if ($_SESSION['connected']) { ?>
                <a href="/myprofile" class="withripple">
                    <i class="zmdi zmdi-account"></i>Mon compte
                </a>
                <a href="/logout" class="withripple">
                    <i class="zmdi zmdi-arrow-right"></i>Déconnexion
                </a>
                <?php } ?>
            </div>
            <div class="ms-slidebar-title">
                <form class="search-form">
                    <input id="search-box-slidebar" type="text" class="search-input" placeholder="Rechercher..." name="query" />
                    <label for="search-box-slidebar">
                        <i class="zmdi zmdi-search"></i>
                    </label>
                </form>
                <div class="ms-slidebar-t">
                    <span class="ms-logo ms-logo-sm">Y</span>
                    <h3>Inter-<span>Assos</span></h3>
                </div>
            </div>
        </header>
        <ul class="ms-slidebar-menu" id="slidebar-menu" <?php if(isset($_SESSION['manager'])) echo 'role="tablist" aria-multiselectable="true"' ?>>
            <li>
                <a class="link" href="/home"><i class="zmdi zmdi-home"></i> Accueil</a>
            </li>
            <li>
                <a class="link" href="/assos"><i class="zmdi zmdi-view-compact"></i> Associations</a>
            </li>
            <li>
                <a class="link" href="/events"><i class="zmdi zmdi-calendar-note"></i> Événements</a>
            </li>
            <li>
                <a class="link" href="/bde"><i class="zmdi zmdi-accounts"></i> BDE</a>
            </li>
            <li>
                <a class="link" href="/contact"><i class="zmdi zmdi-email"></i> Contact</a>
            </li>
            <?php if (!isset($_SESSION['connected'])) { ?>
            <li>
                <a class="link" href="/login"><i class="zmdi zmdi-account"></i>Connexion</a>
            </li>
            <li>
                <a class="link" href="/signup"><i class="zmdi zmdi-account-add"></i>Inscription</a>
            </li>
            <?php } else if ($_SESSION['connected']) { ?>
                <?php if (isset($_SESSION['manager'])) { ?>
                <li class="card" role="tab" id="myaccount">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#slidebar-menu" href="#myaccount-menu" aria-expanded="false" aria-controls="myaccount-menu">
                        <i class="zmdi zmdi-account"></i> Mon compte
                    </a>
                    <ul id="myaccount-menu" class="card-collapse collapse" role="tabpanel" aria-labelledby="myaccount-menu">
                        <li>
                            <a href="/myprofile">Mon profil</a>
                        </li>
                        <li>
                            <a href="/manage/assos">Associations</a>
                        </li>
                        <li>
                            <a href="/manage/events">Événements</a>
                        </li>
                        <li>
                            <a href="/manage/profiles">Profils</a>
                        </li>
                        <li>
                            <a href="/manage/users">Utilisateurs</a>
                        </li>
                    </ul>
                </li>
                <?php } else { ?>
                <li>
                    <a class="link" href="/myprofile"><i class="zmdi zmdi-account"></i> Mon compte</a>
                </li>
                <?php } ?>
            <li>
                <a class="link" href="/logout"><i class="zmdi zmdi-arrow-right"></i> Déconnexion</a>
            </li>
            <?php } ?>
        </ul>

        <div class="ms-slidebar-social ms-slidebar-block">
            <h4 class="ms-slidebar-block-title">Réseaux sociaux</h4>
            <div class="ms-slidebar-social">
                <a href="https://www.facebook.com/tim.pandora.71" target="_blank" class="btn-circle btn-circle-raised btn-facebook">
                    <i class="zmdi zmdi-facebook"></i>
                    <span class="badge-pill badge-pill-pink">1</span>
                    <div class="ripple-container"></div>
                </a>
            </div>
        </div>
    </div>
</div>
<!--<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>-->
<script type="text/javascript" src="/public/js/plugins.min.js"></script>
<script type="text/javascript" src="/public/js/app.min.js"></script>
