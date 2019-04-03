<?php $title = 'Mon Blog D\'écrivain - Articles, nouvelles - Accueil' ;?>

<?php ob_start(); ?>
<a href="index.php?action=home" class="breadcrumb-item">Accueil</a>
<li class="breadcrumb-item"><a href="index.php?action=listPosts">Catégorie</a></li>
<li class="breadcrumb-item active"><?= $categorie['libelle']; ?></li>
<?php $breadcrumb = ob_get_clean(); ?>
<?php ob_start(); ?>
<div class="col-md-9">
    <?php
    if ($_SESSION['role'] == 'Admin') { ?>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="card border-0 modal-custom">
                        <div class="card-header border-0 d-flex align-items-center justify-content-between modal-custom-title">
                            <h5 class="mt-2" style="color: #feefa8">CONFIRMATION</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="color: white;">&times;</span>
                            </button>
                        </div>
                        <div class="card-body modal-custom-content border-0">
                            <p>Êtes-vous sûr de vouloir supprimer le post <b><span id="post-to-del"></span></b> ?
                            </p>
                        </div>
                        <div class="card-footer modal-custom-footer border-0 d-flex justify-content-around">
                            <button class="btn btn-success" id="modalConfirm">Confirm</button>
                            <button class="btn btn-danger">Cancel</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (count($posts) > 0) {
        foreach ($posts as $post) {?>
            <?php
            if ($_SESSION['role'] == 'Admin') { ?>
                <!-- Button trigger modal -->
                <div class="d-flex justify-content-end mb-3">
                    <a href="index.php?action=editPost&id=<?= $post['id']; ?>" class="btn btn-sm btn-primary mr-2"><i
                            class="fas fa-edit" id="editPost"></i></a>
                    <a href="#" class="btn btn-sm btn-danger"><i
                            class="fas fa-trash-alt" id="delPost" data-toggle="modal" data-target="#exampleModal" data-id="<?= $post['id']; ?>" data-title="<?= $post['title']; ?>"></i></a>
                </div>
                <?php
            }
            ?>
            <div class="row d-flex justify-content-center">
                <div class="col-md-9 mb-2 post-test">
                    <img src="<?= $post['imgsrc']; ?>" alt="test" class="post-img">
                </div>
            </div>
            <div class="d-flex justify-content-center flex-column mb-5">
                <p class="text-center post-categorie">Catégorie :<a href="index.php?action=viewByCat&id=<?= $post['typeId']; ?>" class="ml-1"><?= $post['type']; ?></a></p>
                <a href="index.php?action=viewPost&id=<?= $post['id']; ?>"><h6 class="text-center mt-1"><?= strtoupper($post['title']); ?></h6></a>
                <p class="text-center post-inf mb-2">Posté par Admin le <?= $post['createdAt']; ?> - <span class="badge badge-primary"><i class="far fa-comment"> <?= $post['counter']; ?> </i></span></p>
            </div>
            <?php
        }
    } else { ?>
        <div class="row d-flex justify-content-center">
                <div class="col-md-9 mb-2 post-test">
                    <h5 class="text-center mt-5">Pas encore de contenu disponible</h5>
                    <a href="index.php?action=home"><p class="text-center mt-5">Retour à l'accueil</p></a>
                </div>
            </div>
    <?php
    }
    ?>
</div>

<div class="col-md-3 d-flex justify-content-start">
    <div class="col-md-12">
        <div class="last-post border">
            <div class="row last-header d-flex justify-content-center align-items-center p-2 m-0">
                <p class="text-center">Derniers Posts</p>
            </div>
            <ul class="list-unstyled last-content">
                <?php
                foreach ($lastPosts as $lastPost) { ?>
                    <li class="text-center"><a href="index.php?action=viewPost&id=<?= $lastPost['id']; ?>"><?= $lastPost['title']; ?></a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
        <div class="last-com border ">
            <div class="row last-header d-flex justify-content-center align-items-center p-2 m-0">
                <p>Derniers commentaires</p>
            </div>
            <ul class="list-unstyled last-content">
                <?php
                foreach ($commentaires as $lastCom) { ?>

                    <li class="text-center"><?= $lastCom['author']; ?> sur l'article <a href="index.php?action=viewPost&id=<?= $lastCom['postId']; ?>"><?= $lastCom['post']; ?></a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
        <div class="last-user border mb-1">
            <div class="row last-header d-flex justify-content-center align-items-center p-2 m-0">
                <p>Dernier utilisateur inscrit</p>
            </div>
            <ul class="list-unstyled last-content">
                <li class="text-center"><?= $lastUser['username']; ?></li>
            </ul>
        </div>
    </div>

</div>

<?php $content = ob_get_clean(); ?>
<?php ob_start(); ?>
<script>
    document.addEventListener('click', function(e) {
        if (e.target.id == 'delPost') {
            e.preventDefault();
            btn = e.target;
            console.log(btn.dataset.title);
            document.getElementById('post-to-del').innerText = btn.dataset.title;
            postIdToDel = btn.dataset.id;
            document.getElementById('modalConfirm').setAttribute('data-id', postIdToDel);
        }
    }, false);
    window.onload = function() {
        console.log('ready');
        document.getElementById('modalConfirm').addEventListener('click', function(e){
            document.getElementsByClassName('modal-custom-footer')[0].innerHTML = '<div class="d-flex justify-content-center flex-column">'+
                '<i class="fas fa-spinner fa-spin text-info text-center" style="font-size: 45px;">'+
                '</i>' +
                '<p class="text-center text-white mt-3">Suppression en cours...</p>' +
                '</div>';
            dataId = this.dataset.id;
            setTimeout(function() {
                window.location = 'index.php?action=delPost&id=' + dataId;
            }, 2000, dataId);
        }, false);
    }
</script>
<?php require('base.php'); ?>
