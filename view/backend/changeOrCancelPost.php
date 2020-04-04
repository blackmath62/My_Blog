<?php ob_start(); ?>
<div class="container">
    <section class="page-section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title text-center">DataTable with default features</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="phone text-center">Utilisateur</th>
                                    <th class="text-center">Titre et Chapo</th>
                                    <th class="phone text-center">Date création</th>
                                    <th class="phone text-center">Date Modification</th>
                                    <th class="phone text-center">Action <a href="index.php?action=newPost"><i class="fas fa-plus-square fa-2x"></i></a></th>

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
                                    <tr class="center" id="<?= $i ?>" data-target="#postId<?= $postnumber ?>" data-toggle="modal">
                                        <td class="phone text-center"><?= $postuser ?></td>
                                        <td class="">
                                            <h5 class="text-primary">Titre: <?= $title ?></h5></br> Chapo: <?= $chapo ?>
                                        </td>
                                        <td class="phone text-center"><?= $datepost ?></td>
                                        <td class="phone text-center"><?= $modificationDate ?></td>
                                        <td class="phone text-center"><a href="index.php?action=changePost&id=<?= $postnumber ?>" class="table-link">
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

                                <div class="modal fade" id="postId<?= $postnumber ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header justify-content-center btn-primary">
                                                <h5 class="modal-title center" id="exampleModalLabel"><?= $title ?></h5>
                                            </div>
                                            <div class="modal-body center"><?= $chapo ?></div>
                                            <div class="modal-body center">Date du post : <?= $datepost ?></div>
                                            <div class="modal-body center">Date modification post : <?= $modificationDate ?></div>
                                            <div class="modal-body center">par : <?= $postuser ?></div>
                                            <div class="modal-body center"><a href="index.php?action=changePost&id=<?= $postnumber ?>" class="table-link">
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
                                                </a></div>
                                            <div class="modal-footer center">
                                                <button class="btn btn-primary" type="button" data-dismiss="modal">Fermer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                    <th class="phone text-center">Utilisateur</th>
                                    <th class="text-center">Titre et Chapo</th>
                                    <th class="phone text-center">Date création</th>
                                    <th class="phone text-center">Date Modification</th>
                                    <th class="phone text-center">Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
    </section>




    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">DataTable with default features</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Rendering engine</th>
                                    <th>Browser</th>
                                    <th>Platform(s)</th>
                                    <th>Engine version</th>
                                    <th>CSS grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Trident</td>
                                    <td>Internet Explorer 7</td>
                                    <td>Win XP SP2+</td>
                                    <td>7</td>
                                    <td>A</td>
                                </tr>
                                <tr>
                                    <td>Trident</td>
                                    <td>AOL browser (AOL desktop)</td>
                                    <td>Win XP</td>
                                    <td>6</td>
                                    <td>A</td>
                                </tr>
                                <tr>
                                    <td>Gecko</td>
                                    <td>Firefox 1.0</td>
                                    <td>Win 98+ / OSX.2+</td>
                                    <td>1.7</td>
                                    <td>A</td>
                                </tr>
                                <tr>
                                    <td>Gecko</td>
                                    <td>Firefox 1.5</td>
                                    <td>Win 98+ / OSX.2+</td>
                                    <td>1.8</td>
                                    <td>A</td>
                                </tr>
                                <tr>
                                    <td>Webkit</td>
                                    <td>Safari 1.2</td>
                                    <td>OSX.3</td>
                                    <td>125.5</td>
                                    <td>A</td>

                                <tr>
                                    <td>Other browsers</td>
                                    <td>All others</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>U</td>
                                </tr>
                                <tr>
                                    <td>Gecko</td>
                                    <td>Firefox 1.0</td>
                                    <td>Win 98+ / OSX.2+</td>
                                    <td>1.7</td>
                                    <td>A</td>
                                </tr>
                                <tr>
                                    <td>Gecko</td>
                                    <td>Firefox 1.5</td>
                                    <td>Win 98+ / OSX.2+</td>
                                    <td>1.8</td>
                                    <td>A</td>
                                </tr>
                                <tr>
                                    <td>Webkit</td>
                                    <td>Safari 1.2</td>
                                    <td>OSX.3</td>
                                    <td>125.5</td>
                                    <td>A</td>

                                <tr>
                                    <td>Other browsers</td>
                                    <td>All others</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>U</td>
                                </tr>
                                <tr>
                                    <td>Gecko</td>
                                    <td>Firefox 1.0</td>
                                    <td>Win 98+ / OSX.2+</td>
                                    <td>1.7</td>
                                    <td>A</td>
                                </tr>
                                <tr>
                                    <td>Gecko</td>
                                    <td>Firefox 1.5</td>
                                    <td>Win 98+ / OSX.2+</td>
                                    <td>1.8</td>
                                    <td>A</td>
                                </tr>
                                <tr>
                                    <td>Webkit</td>
                                    <td>Safari 1.2</td>
                                    <td>OSX.3</td>
                                    <td>125.5</td>
                                    <td>A</td>

                                <tr>
                                    <td>Other browsers</td>
                                    <td>All others</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>U</td>
                                </tr>
                                <tr>
                                    <td>Gecko</td>
                                    <td>Firefox 1.0</td>
                                    <td>Win 98+ / OSX.2+</td>
                                    <td>1.7</td>
                                    <td>A</td>
                                </tr>
                                <tr>
                                    <td>Gecko</td>
                                    <td>Firefox 1.5</td>
                                    <td>Win 98+ / OSX.2+</td>
                                    <td>1.8</td>
                                    <td>A</td>
                                </tr>
                                <tr>
                                    <td>Webkit</td>
                                    <td>Safari 1.2</td>
                                    <td>OSX.3</td>
                                    <td>125.5</td>
                                    <td>A</td>

                                <tr>
                                    <td>Other browsers</td>
                                    <td>All others</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>U</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Rendering engine</th>
                                    <th>Browser</th>
                                    <th>Platform(s)</th>
                                    <th>Engine version</th>
                                    <th>CSS grade</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>

</div>
<!-- /.card-body -->
<?php
$content = ob_get_clean();
require('view/frontend/htmlTemplate.php');
?>