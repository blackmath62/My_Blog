<div class="container">
    <section class="page-section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title text-center">Liste des commentaires</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive-lg">
                        <table id="example1" class="table table-bordered table-striped ">
                            <thead>
                                <tr>
                                <th class="phone text-center">Id</th>    
                                <th class="phone text-center">Utilisateur</th>
                                    <th class="text-center">Contenu</th>
                                    <th class="phone text-center">Date création</th>
                                    <th class="phone text-center">Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                // todo voir pour récupérer le mail au lieu de l'ID = $commentUser = $chapoPostList->users_id()
                                foreach ($allComment as $commentList) {
                                    $title = $commentList->comment_title;
                                    $dateComment = $commentList->comment_date;
                                    $commentMessage = $commentList->comment_content;
                                    $commentNumber = $commentList->comment_id;
                                    $commentUser = $commentList->users_id;
                                    $treatmentDate = $commentList->treatment_date;
                                    $status = $commentList->validation_label;
                                    $statusId = $commentList->validate_id;
                                    $pseudo = $commentList->Pseudo;

                                ?>
                                    <tr class="center phone-special p-4" id="<?= $i ?>" data-target="#postId<?= $commentNumber ?>" data-toggle="modal">
                                    <td class="phone text-center"><?= $commentNumber ?></td>    
                                    <td class="phone text-center"><?= $pseudo ?></td>
                                        <td class="">
                                            <h5 class="text-primary"><?= $title ?></h5>
                                            <p><?= $commentMessage ?></p>
                                        </td>
                                        <td class="phone text-center"><?= $dateComment ?></td>
                                        <td class="text-center d-flex">
                                        <div class="d-flex flex-column">
                                        <p class="phone text-center"><?= $status . "</br> le " . $treatmentDate ?></p>
                                        <div class="d-flex flex-row justify-content-center">    
                                        <a href="index.php?action=changeStatusComment&id=<?= $commentNumber ?>&modification=2" class="table-link">
                                                <span class="fa-stack ml-2 m-1">
                                                    <i class="fa fa-square fa-stack-2x"></i>
                                                    <i class="fa fa-check-circle fa-stack-1x fa-inverse btn-success rounded"></i>
                                                </span>
                                            </a>
                                            <a href="index.php?action=changeStatusComment&id=<?= $commentNumber ?>&modification=3" class="table-link">
                                                <span class="fa-stack ml-2 m-1">
                                                    <i class="fa fa-square fa-stack-2x"></i>
                                                    <i class="fa fa-times-circle fa-stack-1x fa-inverse btn-danger rounded"></i>
                                                </span>
                                            </a>
                                            <a href="index.php?action=changeStatusComment&id=<?= $commentNumber ?>&modification=1" class="table-link">
                                                <span class="fa-stack ml-2 m-1">
                                                    <i class="fa fa-square fa-stack-2x"></i>
                                                    <i class="fa fa-clock-o fa-stack-1x fa-inverse btn-primary rounded"></i>
                                                </span>
                                            </a>
                                        </div>
                                        </div>
                                        </td>
                                    </tr> 
                                <?php $i = $i++; } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="phone text-center">Id</th>  
                                    <th class="phone text-center">Utilisateur</th>
                                    <th class="text-center">Contenu</th>
                                    <th class="phone text-center">Date création</th>
                                    <th class="phone text-center">Statut</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
    </section>

</div>
<!-- /.card-body -->