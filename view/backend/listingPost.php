<?php ob_start(); ?>
<div class="container">
    <section class="page-section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title text-center">Liste des posts</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="phone text-center">Utilisateur</th>
                                    <th class="text-center">Titre</th>
                                    <th class="phone text-center">Date création</th>
                                    <th class="phone text-center">Date Modification</th>
                                    <th class="phone text-center">Action <a href="index.php?action=newPost"><i class="fas fa-plus-square fa-2x"></i></a></th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                // todo renommer les fonctions
                                foreach ($frontendListPost as $PostList) {
                                    $title = $PostList->post_title;
                                    $datepost = $PostList->post_date;
                                    $postmessage = $PostList->post_content;
                                    $chapo = $PostList->post_chapo;
                                    $postnumber = $PostList->post_id;
                                    $postuser = $PostList->users_id;
                                    $modificationDate = $PostList->modification_date;
                                    $pseudo = $PostList->Pseudo;

                                ?>
                                    <tr class="center phone-special p-4" id="<?= $i ?>" data-target="#postId<?= $postnumber ?>" data-toggle="modal">
                                        <td class="phone text-center"><?= $pseudo ?></td>
                                        <td class="">
                                            <h5 class="text-primary"><?= $title ?></h5>
                                        </td>
                                        <td class="phone text-center"><?= $datepost ?></td>
                                        <td class="phone text-center"><?= $modificationDate ?></td>
                                        <td class="text-center"><a href="index.php?action=changePost&id=<?= $postnumber ?>" class="table-link">
                                                <span class="fa-stack ml-2 m-1">
                                                    <i class="fa fa-square fa-stack-2x"></i>
                                                    <i class="fa fa-pencil fa-stack-1x fa-inverse btn-warning rounded"></i>
                                                </span>
                                            </a>
                                            <a href="#delete<?= $postnumber ?>" rel="modal:open" class="table-link danger">
                                                <span class="fa-stack ml-2 m-1">
                                                    <i class="fa fa-square fa-stack-2x"></i>
                                                    <i class="fa fa-trash-o fa-stack-1x fa-inverse btn-danger rounded"></i>
                                                </span>
                                            </a>
                                        </td>
                                        <!-- Modal HTML embedded directly into document -->
                                        <div id="delete<?= $postnumber ?>" class="modal visible h-25 text-center">
                                            <p class="p-2">Veuillez confirmer la suppression</p>
                                            <div class="d-flex justify-content-center flex-column">
                                                <a href="#" class="btn btn-xl btn-success m-2" rel="modal:close">Non ! je ne veux pas supprimer ce post !</a>
                                                <a href="index.php?action=deletePost&id=<?= $postnumber ?>" class="btn btn-xl btn-danger m-2" rel="">Je suis sûr de vouloir le supprimer</a>
                                            </div>
                                        </div>
                                    </tr>
                                <?php 
                            $i = $i++;
                            } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="phone text-center">Utilisateur</th>
                                    <th class="text-center">Titre</th>
                                    <th class="phone text-center">Date création</th>
                                    <th class="phone text-center">Date Modification</th>
                                    <th class="phone text-center">Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
    </section>

</div>
<!-- /.card-body -->
<?php
$content = ob_get_clean();
require('view/frontend/htmlTemplate.php');
?>