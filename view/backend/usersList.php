<?php ob_start(); ?>
<section class="page-section">
    <h1 class="text-center w-responsive mx-auto mb-5">Liste des utilisateurs </h1>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box clearfix">
                    <div class="table-responsive">
                        <table class="table user-list">
                            <thead class="border rounded bg-primary text-white">
                                <tr>
                                    <th class="text-center"><span>Utilisateur</span></th>
                                    <th class="text-center"><span>date création</span></th>
                                    <th class="text-center"><span>droit</span></th>
                                    <th class="text-center"><span>Action</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                /*$lawvaleur = array('lawIdValue','lawLabelValue' );*/
                                // On récupére la liste des droits dans un tableau
                                $j = 1;
                                while ($listLaw = $allLaw->fetch()) {
                                    $lawId[$j] = $listLaw['law_id'];
                                    $lawLabel[$j] = $listLaw['law_label'];
                                    $j++;
                                }
                                $lawnumber = $allLaw->rowCount(); // compter le nombre de ligne

                                while ($listUsers = $allUsers->fetch()) {
                                    $usersId = $listUsers['users_id'];
                                    $usersMail = $listUsers['mail'];
                                    $usersdate = $listUsers['create_date_users'];
                                    $userslaw = $listUsers['law_label'];
                                    $usersLawId = $listUsers['law_id'];
                                    ?>
                                    <tr>
                                        <td class="text-center">
                                            <a class="text-center"><?= $usersMail ?></a>
                                        </td>
                                        <td class="text-center">
                                            <?= $usersdate ?>
                                        </td>

                                        <td class="text-center">
                                            <div class="btn-group" role="group" aria-label="First group">
                                                <?php
                                                // Pour chaque utilisateur afficher tous les droits disponible sous forme de bouton pour pouvoir changer de droit
                                                    for ($i=1; $i <= $lawnumber; $i++) {
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
                                            <a href="index.php?action=deleteUser&id=<?= $usersId ?>" class="table-link danger">
                                                <span class="fa-stack">
                                                    <i class="fa fa-square fa-stack-2x"></i>
                                                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                                                </span>
                                            </a>
                                            <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups"></div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <ul class="pagination pull-right">
                        <li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#"><i class="fa fa-chevron-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
require('view/frontend/htmlTemplate.php');
?>