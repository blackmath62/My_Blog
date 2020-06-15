<?php
namespace App\Entity;
class Error{
    
    public function setFlash($message,$type){
        $_SESSION['flash'] = array(
            'message'=> $message,
            'type'=> $type
        );
    }
    public function flash(){
        if(isset($_SESSION['flash'])){
            ?>
            <div class='alert alert-<?php echo $_SESSION['flash']['type'];
            ?>'>
            <a class='close'>X</a>
            <?php echo $_SESSION['flash']['message'];?>
            </div>
            <?php
            unset($_SESSION['flash']);
        }
    }
}