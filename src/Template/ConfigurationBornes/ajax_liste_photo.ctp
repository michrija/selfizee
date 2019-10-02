<?php
	$i = 1;
	$init = true;
	$buffer = '';
	if(!empty($photos)){
		foreach($photos as $photo_item){
			if($init){
				$buffer .= '<div class="row sf-bloc-ligne">';
				$init = false;
			}
			
			if($i == 3){
				$buffer .= '</div><div class="row sf-bloc-ligne">';
				$i = 1;
			}
			
			$buffer .= '<a href="#" class="sf-bg col-sm-6" data-tp="image" data-href="'.$photo_item->file_path.'">'.
				'<figure>'.
					'<img src="'.$photo_item->file_thumbnail_path.'">'.
				'</figure>'.
			'</a>';
			
			$i++;
		}
		$buffer .= '</div>';
	}else{
		$buffer = '<strong class="text-warning"><small>Aucune photo liée à ce tag.</small></strong>';
	}
	echo $buffer;
?>