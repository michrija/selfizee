<?php 
    foreach($photos as $key => $photo){
        echo $this->element('one_photo',['photo'=>$photo, 'key'=>$key,'galery' => $galery,'rsConfiguration' => $rsConfiguration,'queue' => $queue]);    
    }
?>