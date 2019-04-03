<?php $title = 'Mon Blog D\'écrivain - Login'; ?>
<?php ob_start(); ?>
    <a href="#" class="breadcrumb-item">Accueil</a>
    <li class="breadcrumb-item active">Register</li>
<?php $breadcrumb = ob_get_clean(); ?>
<?php ob_start(); ?>
    <div class="col-12">
        <?php
        if (isset($addflash)) { ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><?= $addflash; ?></strong>
            </div>
        <?php
        }
        ?>
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <div class="form-register mb-3">
                    <form action="index.php?action=register" method="post">
                        <div class="form-group form-inline">
                            <label for="username" class="col-form-label col-md-4 text-left">Identifiant</label>
                            <input type="text" class="form-control col-md-7" placeholder="Identifiant.." name="username">
                            <i class="col-1 far fa-check-square validated hide"></i>
                            <span class="col-12 mt-2 text-danger text-center form- mx-3 error hide">Votre nom d'utilisateur doit comporter au minimum 3 lettres.</span>
                        </div>

                        <div class="form-group form-inline">
                            <label for="email" class="col-form-label col-md-4 text-left">E-mail</label>
                            <input type="text" class="form-control col-md-7" placeholder="Addresse E-mail" name="email" id="email">
                            <i class="col-1 far fa-check-square validated hide"></i>
                            <span class="col-12 mt-2 text-danger text-center form- mx-3 error hide">Votre adresse e-mail n'est pas valide</span>
                        </div>
                        <div class="form-group form-inline">
                            <label for="password" class="col-form-label col-md-4 text-left">Mot de passe</label>
                            <input type="password" class="form-control" placeholder="Mot de passe.." name="password">
                            <span class="col-12 mt-2 text-danger text-center form- mx-3 error hide">Votre nom d'utilisateur doit comporter au minimum 3 lettres.</span>
                        </div>
                        <div class="form-group form-inline">
                            <label for="password2" class="col-form-label col-md-4 text-left">Mot de passe</label>
                            <input type="password" class="form-control col-md-7" placeholder="Retappez votre mot de passe.." name="password2">
                            <i class="col-1 far fa-check-square validated hide"></i>
                            <span class="col-12 mt-2 text-danger text-center form- mx-3 error hide">Votre nom d'utilisateur doit comporter au minimum 3 lettres.</span>
                        </div>
                        <div class="d-flex justify-content-center">
                            <input type="submit" class="btn btn-sm btn-primary" value="S'inscrire">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $content = ob_get_clean(); ?>
<?php ob_start(); ?>
<script>
    let formValid;
    document.getElementsByName('username')[0].addEventListener('focusout', function() {
        validate(this);
    }, false);
    let email = document.getElementById('email').addEventListener('focusout', function() {
        mailValidation(this);
    },false);

    function validate(input) {
        let formGroup = input.parentNode;
        if (input.value.length < 3) {
            console.log('not good');
            $(formGroup.querySelector('span')).show(200);
            let icon = formGroup.querySelector('i');
            icon.className = 'col-1 fas fa-exclamation-triangle error-icon';
            formValid = false;
        }  else {
            let icon = formGroup.querySelector('i');
            icon.className = 'col-1 far fa-check-square validated';
            $(formGroup.querySelector('span')).hide(200);
        }
    }
    function mailValidation(input) {
        let formGroup = input.parentNode;
        let regx = /^[A-Za-z0-9]{0,}[.]{0,1}[A-Z-a-z0-9]{0,}@[a-zA-Z0-9]{0,9}[.][a-zA-Z]{2,5}/;
        let value = input.value;
        if (regx.test(value)) {
            validationDisplay(formGroup);
        } else {
            errorDisplay(formGroup);
            formValid = false;
        }
    }
    function errorDisplay(parent) {
        $(parent.querySelector('span')).show(200);
        let icon = parent.querySelector('i');
        icon.className = 'col-1 fas fa-exclamation-triangle error-icon';
    }
    function validationDisplay(parent) {
        $(parent.querySelector('span')).hide(200);
        let icon = parent.querySelector('i');
        icon.className = 'col-1 far fa-check-square validated';
    }
</script>
<?php $script = ob_get_clean(); ?>
<?php require ('base.php');
