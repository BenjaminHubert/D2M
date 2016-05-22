<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $this->getTitle();?></title>        
        <link rel="icon" href="<?php echo BASE_URL;?>img/favicon.ico">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">  
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- JQUERY -->
        <script src="<?php echo BASE_URL;?>js/jquery-2.1.1.min.js"></script>

        <!-- MATERIALIZE -->
        <link href="<?php echo BASE_URL;?>css/material-icon.css" rel="stylesheet">
        <link href="<?php echo BASE_URL;?>css/materialize.min.css" rel="stylesheet" type="text/css">
        <script src="<?php echo BASE_URL;?>js/materialize.min.js"></script>

        <link href="<?php echo BASE_URL_ADMIN;?>css/mystyle.css" rel="stylesheet" type="text/css">
        <script src="<?php echo BASE_URL_ADMIN;?>js/functions.js"></script>
    </head>
    <body>
        <header>
            <nav role="navigation">
                <div class="nav-wrapper container">
                    <ul class="right ">
                        <li><a href="<?php echo BASE_URL;?>">Voir le site</a></li>
                        <li><a href="<?php echo BASE_URL;?>login/logout">Deconnexion</a></li>
                    </ul>
                    <ul id="slide-out" class="side-nav fixed">
                        <li><a href="<?php echo BASE_URL_ADMIN;?>monCompte">Mon compte</a></li>
                    </ul>
                    <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
                </div>
            </nav>
        </header>
        <main>