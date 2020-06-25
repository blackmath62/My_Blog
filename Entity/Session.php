<?php
namespace App\Entity;

class Session{  
     
    public function setFlash($message,$type = 'primary'){
        $_SESSION['flash'] = array(
            'message'=> $message,
            'type'   => $type
        );
    }
    public function flash(){
        if(isset($_SESSION['flash'])){
            ?>
            <div class="card alert alert-<?=$_SESSION['flash']['type'];?> alert-dismissible fade show fixed-bottom " id='monAlert' style="width: 18rem;left: 84%; bottom: 70%;display:none;">
                <div class="card-body">
                    <p class="card-text center"><strong><?php echo $_SESSION['flash']['message'];?></strong></p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <?php
            unset($_SESSION['flash']);
        }
    }
}
?>
                