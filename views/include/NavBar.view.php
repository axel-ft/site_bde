<div id="ms-preload" class="ms-preload">
    <div id="status">
        <div class="spinner">
            <div class="dot1"></div>
            <div class="dot2"></div>
        </div>
    </div>
</div>

<div class="ms-site-container">
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
                <a href="javascript:void(0)" class="btn-circle btn-circle-primary no-focus animated zoomInDown animation-delay-8">
                    <i class="zmdi zmdi-account"></i>
                </a>
                <form class="search-form animated zoomInDown animation-delay-9">
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
                    <li class="nav-item <?php if (isset($_SESSION['manager'])) echo "dropdown" ?> <?php if($_SERVER['REQUEST_URI'] === '/myprofile') echo "active" ?>">
                            <a class="nav-link dropdown-toggle animated fadeIn animation-delay-8" data-toggle="dropdown" data-hover="dropdown" role="button" aria-haspopup="true" aria-expanded="false" data-name"myprofile" href="/myprofile">Mon compte<?php if (isset($_SESSION['manager'])) echo ' <i class="zmdi zmdi-chevron-down"></i>' ?>
                            </a>
                            <?php if (isset($_SESSION['manager'])) { ?>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/manage/assos">Associations</a></li>
                                <li><a class="dropdown-item" href="/manage/events">Événements</a></li>
                                <li><a class="dropdown-item" href="/manage/profiles">Profils</a></li>
                                <li><a class="dropdown-item" href="/manage/users">Utilisateurs</a></li>
                            </ul>
                            <?php } ?>
                        </li>
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
