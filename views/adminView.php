<?php $title = 'Mon Blog D\'écrivain - Articles, nouvelles - Accueil' ;?>

<?php ob_start(); ?>
    <a href="index.php?action=addPostView"><button class="btn btn-link">Ajouter post</button></a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Post Détails</th>
            <th class="text-center" style="width: 100px;">Archive</th>
            <th class="text-center" style="width: 190px;">Actions</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
        <?php foreach ($posts as $item) {
            echo '<tr>
                   <td class="text-center text-capitalize"><a href="index.php?action=viewPost&id='. $item['id'] .'">'. $item['title'] .'</a></td>
                   <td class="text-center">'. $item['archive'] .'</td>
                   <td>
                   <div class="d-flex justify-content-around">
                       <a href="index.php?action=editPost&id='. $item['id'] .'"><button class="btn btn-sm btn-outline-dark">Editer</button></a>
                       <a href="index.php?action=delPost&id='. $item['id'] .'"><button class="btn btn-sm btn-outline-danger btn-del">Supprimer</button></a>                   
                   </div>
                    </td>
                 </tr>';
        }?>

    </table>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>User details</th>
            <th class="text-center" style="width: 100px;">Role</th>
            <th class="text-center" style="width: 190px;">Actions</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
        <?php foreach ($users as $item) {
            echo '<tr>
                   <td class="text-center text-capitalize"><a href="index.php?action=viewPost&id='. $item['id'] .'">'. $item['username'] .'</a></td>
                   <td class="text-center">'. $item['role'] .'</td>
                   <td>
                   <div class="d-flex justify-content-around">
                       <a href="index.php?action=editUser&id='. $item['id'] .'"><button class="btn btn-sm btn-outline-dark">Editer</button></a>
                       <a href="index.php?action=deleteUser&id='. $item['id'] .'"><button class="btn btn-sm btn-outline-danger btn-del">Supprimer</button></a>                   
                   </div>
                    </td>
                 </tr>';
        }?>

    </table>
<?php $content = ob_get_clean(); ?>
<?php ob_start(); ?>
    <li class="breadcrumb-item"><a href="index.php?action=home">Accueil</a></li>
    <li class="breadcrumb-item active">Administration</li>
<?php $breadcrumb = ob_get_clean(); ?>
<?php require ('base.php');
