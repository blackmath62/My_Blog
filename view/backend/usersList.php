<div class="container">
    <section class="page-section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title text-center">Liste des utilisateurs</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center"><span>Utilisateur</span></th>
                                    <th class="text-center"><span>date création</span></th>
                                    <th class="text-center"><span>droit</span></th>
                                    <th class="text-center"><span>Action</span></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                // On récupére la liste des droits dans un tableau
                                $j = 1;
                                while ($listLaw = $allLaw->fetch()) {
                                    $lawId[$j] = $listLaw['law_id'];
                                    $lawLabel[$j] = $listLaw['law_label'];
                                    $j++;
                                }
                                $lawnumber = $allLaw->rowCount(); // compter le nombre de ligne

                                foreach ($allUsers as $user) {
                                    $usersId = htmlspecialchars($user->users_id);
                                    $usersMail = htmlspecialchars($user->mail);
                                    $pseudo = htmlspecialchars($user->Pseudo);
                                    $usersdate = htmlspecialchars($user->create_date_users);
                                    $usersLawId = htmlspecialchars($user->law_id);
                                    ?>
                                    <tr>
                                        <td class="text-center">
                                            <a class="text-center"><?= $pseudo ?></a>
                                        </td>
                                        <td class="text-center">
                                            <?= $usersdate ?>
                                        </td>

                                        <td class="text-center">
                                            <div class="btn-group" role="group" aria-label="First group">
                                                <?php
                                                    // Pour chaque utilisateur afficher tous les droits disponible sous forme de bouton pour pouvoir changer de droit
                                                    for ($i = 1; $i <= $lawnumber; $i++) {
                                                        if ($lawId[$i] == $usersLawId) {
                                                            $lawColor = "primary";
                                                        } else {
                                                            $lawColor = "secondary";
                                                        }
                                                        ?>
                                                    <a type="button" href="index.php?action=changeLawUser&id=<?= $lawId[$i] ?>&userid=<?= $usersId ?>" class="btn btn-<?= $lawColor ?>"><?= $lawLabel[$i]; ?></a>
                                                <?php } ?>
                                            </div>
                                        </td>
                                        <td class="text-center">

                                            <a type="button" href="#delete<?= $usersId ?>" rel="modal:open" class="btn btn-danger">Supprimer le compte</a>
                                            <!-- Modal HTML embedded directly into document -->
                                <div id="delete<?= $usersId ?>" class="modal visible h-25 text-center">
                                    <p class="p-2">Veuillez confirmer la suppression de l'utilisateur</p>
                                    <div class="d-flex justify-content-center flex-column">
                                        <a href="#" class="btn btn-xl btn-success m-2" rel="modal:close">Non ! je ne veux pas supprimer l'utilisateur !</a>
                                        <a href="index.php?action=deleteUser&userid=<?= $usersId ?>" class="btn btn-xl btn-danger m-2" rel="">Je suis sûr de vouloir le supprimer</a>
                                    </div>
                                </div>
                                <!-- END Modal HTML embedded directly into document -->
                                            <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups"></div>

                                        </td>

                                    </tr>

                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-center"><span>Utilisateur</span></th>
                                    <th class="text-center"><span>date création</span></th>
                                    <th class="text-center"><span>droit</span></th>
                                    <th class="text-center"><span>Action</span></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
    </section>

</div>
<!-- /.card-body -->