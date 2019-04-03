<?php $title = 'Mon Blog D\'écrivain - Login'; ?>
<?php ob_start(); ?>
<a href="index.php?action=home" class="breadcrumb-item">Accueil</a>
<li class="breadcrumb-item active">Post <?= $rep['title']; ?> </li>
<?php $breadcrumb = ob_get_clean(); ?>
<?php ob_start(); ?>
<div class="col-md-12 post">
    <div class="d-flex justify-content-center m-5 post-img">
        <img src="<?= $rep['imgsrc']; ?>" alt="image">
    </div>
    <div class="d-flex justify-content-center flex-column">
        <h6 class="text-center post-title mt-1"><b><a href="index.php?action=viewPost&id="> <?php echo $rep['title']; ?> </a></b></h6>
        <p class="text-center post-inf mb-2">Posté paaaaar Admin le <?= $rep['createdAt']; ?> - <span class="badge badge-primary"><i class="far fa-comment"> 0 </i></span></p>
    </div>
    <div class="row bg-light">
    </div>
    <div class="row">
        <div class="col-12 mt-2 post-content">
            <p class="text-center text-capitalize text-info"><?= nl2br($rep['content']); ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-12 d-flex flex-column">
            <?php
            foreach ($comsCustom as $com) { ?>
            <div class="row bg-light  com border">
                <div class="col-2 d-flex flex-column justify-content-center align-items-center p-3">
                    <div class="user-com">
                        <i class="fas fa-user"></i>
                    </div>
                    <p class="text-center user-com-name"><b> <?php if ($com['author'] !== 'Anonymous') {
                                echo $com['author'] . '<img class="verified" src="public/assets/img/verified.png">';
                            } else {
                                echo $com['anonymous'] . '<span class="badge badge-primary m-2">Anonyme</span>';
                            } ?></b></p>
                    <p class="user-com-date">le 01/02/2019 à 11h54</p>
                </div>
                <div class="col-10 d-flex flex-column justify-content-center post-infos">
                    <?php
                    if ($_SESSION['role'] == 'Admin') { ?>
                        <div class="d-flex justify-content-end">
                            <a href="index.php?action=delCom&id=<?= $com['id']; ?>&postId=<?= $rep['id']; ?>">
                                <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </a>
                        </div>
                        <?php
                    }
                    ?>
                    <p><?= $com['content']; ?></p>
                </div>
            </div>
        </div>
        <div class="col-12 d-flex flex-column">
            <form action="index.php?action=addCom&id=<?= $rep['id']; ?>" method="post" class="align-items-center">
                <div class="col-12 d-flex justify-content-center mt-5 mb-4">
                    <img src="public/assets/img/avis.png" alt="avis">
                </div>
                <?php
                if (!isset($_SESSION['id'])) { ?>
                    <div class="form-group row">
                        <label for="username" class="col-2">Votre pseudo </label>
                        <input type="text" name="username" class="form-control col-9">
                    </div>
                <?php } ?>
                <div class="form-group row">
                    <label for="comment" class="col-2">Votre commentaire</label>
                    <textarea name="comment" id="comment" cols="30" rows="10" class="form-control col-9"></textarea>
                </div>
                <div class="d-flex justify-content-center mb-2">
                    <input type="submit" value="Envoyer" class="btn btn-sm btn-primary">
                </div>
                <?php
                }
                ?>
            </form>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('base.php'); ?>