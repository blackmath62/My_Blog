<?php
namespace App\Entity;

class Session{  
     
    public function setFlash($message,$type = 'danger'){
        $_SESSION['flash'] = array(
            'message'=> $message,
            'type'   => $type
        );
    }
    public function flash(){
        if(isset($_SESSION['flash'])){
            ?>
            <div class="alert alert-<?=$_SESSION['flash']['type'];?> alert-dismissible fade show fixed-bottom" role="alert">
                <strong><?php echo $_SESSION['flash']['message'];?></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php
            unset($_SESSION['flash']);
        }
    }
}
                