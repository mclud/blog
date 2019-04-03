<?php $title = 'Mon Blog D\'écrivain - Login'; ?>
<?php ob_start(); ?>
<a href="#" class="breadcrumb-item">Accueil</a>
<li class="breadcrumb-item active">Login</li>
<?php $breadcrumb = ob_get_clean(); ?>

<?php ob_start(); ?>
<?php
if (isset($addflash)) { ?>
    <div class="col-12">
        <div class="alert-danger text-center p-2 m-2"><?= $addflash; ?></div>'
    </div>
<?php
}
?>
<div class="col-12">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <div class="form-login mb-4">
                <form action="index.php?action=log" method="post">
                    <div class="form-group form-inline">
                        <label for="user" class="col-form-label col-md-4 text-left">Identifiant</label>
                        <input type="text" class="form-control col-md-7" placeholder="Identifiant.." name="user">
                    </div>
                    <div class="form-group form-inline">
                        <label for="pwd" class="col-form-label col-md-4 text-left">Mot de passe</label>
                        <input type="password" class="form-control col-md-7" placeholder="Mot de passe.." name="pwd">
                    </div>
                    <div class="d-flex justify-content-center">
                        <input type="submit" class="btn btn-sm btn-primary" value="Se connecter">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('base.php'); ?>
