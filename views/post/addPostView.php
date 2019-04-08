<?php $title = 'Mon Blog D\'écrivain - Login'; ?>
<?php ob_start(); ?>
    <a href="#" class="breadcrumb-item">Accueil</a>
    <li class="breadcrumb-item active">Ajouter un post</li>
<?php $breadcrumb = ob_get_clean(); ?>
<?php ob_start(); ?>
    <div class="col-12">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <div class="form-register mb-3">
                    <form action="index.php?action=addPost" method="post">
                        <div class="form-group form-inline">
                            <label for="title" class="col-form-label col-md-4 text-left">Titre</label>
                            <input type="text" class="form-control col-md-7" placeholder="Titre" name="title">
                        </div>
                        <div class="form-group form-inline">
                            <label for="email" class="col-form-label col-md-4 text-left">Message</label>
                            <textarea class="form-control col-md-7" placeholder="Votre message" name="content"></textarea>
                        </div>
                        <div class="form-group form-inline">
                            <label for="type" class="col-form-label col-md-4 text-left">Type</label>
                            <select class="form-control col-md-7" name="type">
                                <?php
                                foreach ($types as $type) { ?>
                                    <option value="<?= $type['id'];?>"><?= $type['libelle']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group form-inline">
                            <label for="imgsrc" class="col-form-label col-md-4 text-left">Image src</label>
                            <input type="text" class="form-control col-md-7" placeholder="picture url" name="imgsrc">
                        </div>
                        <div class="d-flex justify-content-center">
                            <input type="submit" class="btn btn-sm btn-primary" value="Ajouter">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $content = ob_get_clean(); ?>
<?php require('base.php');
