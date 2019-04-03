
<!doctype html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="public/assets/css/bootstrap.css">
    <link rel="stylesheet" href="public/assets/css/animate.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="public/assets/css/custom.css">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>
</head>
<body>
<div class="container-fluid bg-light d-flex justify-content-end">
    <ul class="list-unstyled m-0 p-0">
        <li class="list-inline-item menu-top-link">
            <a href="#" class="menu-connec-link"><i class="fas fa-info mr-2"></i>A propos</a>
            <ul  class="list-unstyled sub-menu-connec list-inline">
                <li style="border-top: 1px solid lightgrey;">
                    <a href="#" class="sub-menu-link">Me contacter</a></li>
                <li style="border-top: 1px solid lightgrey;">
                    <a href="#" class="sub-menu-link">Presentation</a>
                </li>
            </ul>
        </li>
        <li class="list-inline-item">
            <a href="#" class="menu-connec-link"><i class="far fa-user mr-2" style="font-size: 15px;"> </i>  Espace membre</a>
            <ul  class="list-unstyled sub-menu-connec">
                <?php
                if ($_SESSION['username'] === 'Anonymous') {?>
                    <li style="border-top: 1px solid lightgrey;">
                        <a href="index.php?action=login" class="sub-menu-link"><i class="fas fa-sign-in-alt mr-2"></i>Se connecter</a></li>
                    <li style="border-top: 1px solid lightgrey;">
                        <a href="index.php?action=createAccount" class="sub-menu-link"><i class="fas fa-clipboard-list mr-2"></i> S'inscrire</a>
                    </li>
                    <?php
                } else {
                    if ($_SESSION['role'] === 'Admin') { ?>
                        <li style="border-top: 1px solid lightgrey;">
                            <a href="index.php?action=adminView" class="sub-menu-link"><i class="fas fa-users-cog mr-2"></i>  Administration</a>
                        </li>
                    <?php } ?>
                    <li style="border-top: 1px solid lightgrey;">
                        <a href="index.php?action=myAccount" class="sub-menu-link"><i class="fas fa-users-cog mr-2"></i>  Mon compte</a>
                    </li>
                    <li style="border-top: 1px solid lightgrey;">
                        <a href="index.php?action=logout" class="sub-menu-link">Se déconnecter</a>
                    </li>
                    <?php
                } ?>

            </ul>
        </li>
    </ul>
</div>
<div class="top-bg d-flex justify-content-center">
    <div class="bg">
        <img src="public/assets/img/bgstars.png" alt="bg" class="bgstars">
        <img src="public/assets/img/bgstars2.png" alt="bg2" class="bgstars2">
        <img src="public/assets/img/bg5.png" alt="bg">
    </div>
</div>
<div class="container-fluid bg-info" style="height: 35px;">

</div>
<div class="container-fluid">
    <div class="container">
            <ul class=" nav justify-content-around nav-custom">
                <a href="index.php?action=home">
                    <li class="nav-item nav-item-special">
                        <p class="text-center">Accueil</p>
                        <img src="public/assets/img/home.svg" alt="home">
                    </li>
                </a>
                <a href="index.php?action=pres">
                    <li class="nav-item nav-item-special">
                        <p class="text-center">Présentation</p>
                        <img src="public/assets/img/pres.png" alt="home">
                    </li>
                </a>

                    <li class="nav-item nav-item-special cat-menu">
                        <p href="#">Categories</p>
                        <ul class="list-unstyled categories m-0 p-0">
                            <?php
                            foreach ($categories as $category) { ?>
                            <a href="index.php?action=viewByCat&id=<?= $category['id']; ?>">
                                <li class="text-center categories-link">
                                    <p><?= $category['libelle']; ?></p>
                                </li>
                            </a>
                            <?php
                            }
                            ?>
                        </ul>
                        <img src="public/assets/img/category.png" alt="home">
                    </li>

                <a href="index.php?action=book">
                    <li class="nav-item nav-item-special">
                        <p class="text-center">Contact</p>
                        <img src="public/assets/img/livre.png" alt="home">
                    </li>
                </a>
            </ul>
    </div>
</div>
<div class="container-fluid m-0 p-0 content">
    <div class="container">
        <ol class="breadcrumb bg-transparent mb-2">
        <?= $breadcrumb ?>
        </ol>
        <div class="row m-0 p-0">
            <?= $content ?>
        </div>
    </div>
</div>
<div class="container-fluid footer">
    <p class="text-center text-white">HELLO WORLD</p>
</div>
<script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="public/assets/js/bootstrap.min.js"></script>
</body>
<?php
if (isset($script)) {
    echo $script;
}
?>
<script>
    $('.cat-menu').on('mouseover', function() {
        $(this).find('ul').slideDown(300);
    });
    $('.cat-menu').on('mouseleave', function() {
        $(this).find('ul').slideUp(300);
    });
    $('.menu-connec-link').on('mouseover', function() {
        console.log($(this).parent('li').find('ul'));
        $('.sub-menu-connec').hide();
        $(this).parent('li').find('ul').show();
    });
    $('.sub-menu-connec').on('mouseleave', function() {
        $(this).hide(220);
    });
    $(document).on('click', function() {
        $('.sub-menu-connec').hide();
    });
    setInterval(function(){
        setTimeout(function() {
            $('.bgstars').fadeIn(300);
        }, 300);
        setTimeout(function() {
            $('.bgstars').fadeOut(500);
        }, 500);
    }, 2000);
</script>
</html>