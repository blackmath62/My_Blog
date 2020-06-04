<?php

namespace App\Entity;

class View
{
    private $file;
    private $title;

    public function render($type ,$template, $data = [])
    {
        $this->file = './view/'.$type.'/'.$template.'.php';
        $content  = $this->renderFile($this->file, $data);
        $view = $this->renderFile('./view/frontend/htmlTemplate.php', [
            'title' => $this->title,
            'content' => $content
        ]);
        echo $view;
    }

    private function renderFile($file, $data)
    {
        if(file_exists($file)){
            extract($data);
            ob_start();
            require $file;
            return ob_get_clean();
        }
        header('Location: index.php');
    }
}