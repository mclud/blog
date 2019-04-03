<?php $title = 'Mon Blog D\'écrivain - Login'; ?>
<?php ob_start(); ?>
    <a href="#" class="breadcrumb-item">Accueil</a>
    <li class="breadcrumb-item active">Mon compte</li>
<?php $breadcrumb = ob_get_clean(); ?>
<?php ob_start(); ?>
<?php
if (isset($addflash)) {
    if ($addflash) {
        echo '<div class="col-12 text-center alert-success p-2 mb-2">Modifications appliquées avec succès</div>';
    } else {
        echo '<div class="col-12 text-center alert-danger p-2 mb-2">Mot de passe incorrect</div>';
    }
}
?>
    <div class="col-12">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs justify-content-center">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#home">Informations</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#menu1">Mes commentaires (<?= $totalComs; ?>)</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#menu2">Modifier paramètres</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane mt-5 container active" id="home" style="min-height: 400px;">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-6">
                        <div class="form-register mb-3">
                            <form action="index.php?action=register" method="post">
                                <div class="form-group form-inline">
                                    <label for="username" class="col-form-label col-md-4 text-left">Identifiant</label>
                                    <p><?= $rep['username']; ?></p>
                                </div>
                                <div class="form-group form-inline">
                                    <label for="email" class="col-form-label col-md-4 text-left">E-mail</label>
                                    <p><?= $rep['email']; ?></p>
                                </div>
                                <div class="form-group form-inline">
                                    <label for="email" class="col-form-label col-md-4 text-left">Nombre de commentaire laissé</label>
                                    <p><?= $totalComs; ?></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane mt-5 container fade" id="menu1" style="min-height: 400px;">
                <?php if ($totalComs == 0) { ?>
                    <p class="">Pas de commentaire ..</p>
               <?php } else {
                    foreach ($coms as $com) {  ?>
                        <p><a href="index.php?action=postView&id=<?= $com['id']; ?>">Content : <?= $com['content']; ?></a></p>
                    <?php }
                }?>
            </div>
            <div class="tab-pane mt-5 container fade" id="menu2" style="min-height: 400px;">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-6">
                        <div class="form-register mb-3">
                            <form action="index.php?action=changeSettings" method="post">
                                <div class="form-group form-inline">
                                    <label for="password" class="col-form-label col-md-4 text-left">Password</label>
                                    <input type="password" name="password" required="required">
                                </div>

                                <div class="form-group form-inline">
                                    <label for="email" class="col-form-label col-md-4 text-left">E-mail</label>
                                    <input type="text" value="<?= $rep['email']; ?>" name="email">
                                </div>
                                <div class="form-group form-inline">
                                    <label for="newpassword" class="col-form-label col-md-4 text-left">Nouveau mot de passe</label>
                                    <input type="password" name="newpassword">
                                </div>
                                <div class="form-group form-inline">
                                    <label for="newpassword2" class="col-form-label col-md-4 text-left">Nouveau mot de passe</label>
                                    <input type="password" name="newpassword2">
                                </div>
                                <div class="d-flex justify-content-center">
                                    <input type="submit" value="Modifier mes paramètres" class="btn btn-sm btn-outline-danger">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php $content = ob_get_clean(); ?>
<?php require ('base.php');
