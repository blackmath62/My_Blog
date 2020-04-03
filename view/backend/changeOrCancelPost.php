<?php ob_start(); ?>
<div class="container ">
    <section class="page-section">
        <div class="card ">
            <div class="card-header m-0 p-0">
                <h2 class="card-title center btn-primary m-0 p-0">Modification et suppression de post</h2>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="center">Titre</th>
                            <th class="center">Utilisateur</th>
                            <th class="center">Chapo</th>
                            <th class="center">Date création</th>
                            <th class="center">Date Modification</th>
                            <th class="center">Action</th>
                        </tr>
                    </thead>
                    <?php
                    // todo voir pour récupérer le mail au lieu de l'ID = $postuser = $chapoPostList->users_id()
                    foreach ($allPostChapo as $chapoPostList) {
                        $title = $chapoPostList->post_title();
                        $datepost = $chapoPostList->post_date();
                        $postmessage = $chapoPostList->post_content();
                        $chapo = $chapoPostList->post_chapo();
                        $postnumber = $chapoPostList->post_id();
                        $postuser = $chapoPostList->users_id();
                        $modificationDate = $chapoPostList->modification_date();
                    ?>
                        <tbody>
                            <tr>
                                <td class="center"><?= $title ?></td>
                                <td class="center"><?= $postuser ?></td>
                                <td class="center"><?= $chapo ?></td>
                                <td class="center"><?= $datepost ?></td>
                                <td class="center"><?= $modificationDate ?></td>
                                <td class="center"><a href="index.php?action=changePost&id=<?= $postnumber ?>" class="table-link">
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
                                    </a></td>
                            </tr>
                        </tbody>
                        <!-- Modal HTML embedded directly into document -->
                        <div id="delete<?= $postnumber ?>" class="modal visible h-25 text-center">
                            <p class="p-2">Veuillez confirmer la suppression</p>
                            <div class="d-flex justify-content-center flex-column">
                                <a href="#" class="btn btn-xl btn-success m-2" rel="modal:close">Non ! je ne veux pas supprimer ce post !</a>
                                <a href="index.php?action=deletePost&id=<?= $postnumber ?>" class="btn btn-xl btn-danger m-2" rel="">Je suis sûr de vouloir le supprimer</a>
                            </div>
                        </div>
                    <?php } ?>
                    <tfoot>
                        <tr>
                            <th class="center">Titre</th>
                            <th class="center">Utilisateur</th>
                            <th class="center">Chapo</th>
                            <th class="center">Date création</th>
                            <th class="center">Date Modification</th>
                            <th class="center">Action</th>
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