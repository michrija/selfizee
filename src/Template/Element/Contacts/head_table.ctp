
<?php
$valueDirection = 'desc';
if(strtolower($customDirection ) == 'desc'){
    $valueDirection = 'asc';
}
?>
<tr id="entete_table">
    <th scope="col"> <input type="checkbox" id="id_chekAll" /></th>
    <th scope="col"><?= $this->Paginator->sort('photo_id','Photo') ?></th>
    <th width="10px" scope="col"><?= $this->Paginator->sort('email','E-mail') ?></th>
    <th scope="col"><?= $this->Paginator->sort('telephone','Tel') ?></th>
    <th scope="col"><?= $this->Paginator->sort('Photos.date_prise_photo','Date photo') ?></th>
    
    <th scope="col"><a href="<?=  $this->Paginator->generateUrl(['customSort' => 'emailEnvoye','customDirection'=>$valueDirection]); ?>">E-mail envoyé</a> <?php //$this->Paginator->sort('ContactEmailsEnvois.id','E-mail envoyé') ?>  </th>
    <th scope="col"> <a href="<?=  $this->Paginator->generateUrl(['customSort' => 'emailDelivre','customDirection'=>$valueDirection]); ?>">E-mail délivré</a></th>
    <th scope="col"> <a href="<?=  $this->Paginator->generateUrl(['customSort' => 'emailOuvert','customDirection'=>$valueDirection]); ?>">E-mail ouvert</a></th>
    <th scope="col"> <a href="<?=  $this->Paginator->generateUrl(['customSort' => 'emailClique','customDirection'=>$valueDirection]); ?>">E-mail cliqué</a></th>
    <th scope="col"><a href="<?=  $this->Paginator->generateUrl(['customSort' => 'smsEnvoye','customDirection'=>$valueDirection]); ?>">Sms envoyé</a></th>
    <th scope="col"> <a href="<?=  $this->Paginator->generateUrl(['customSort' => 'smsOuvert','customDirection'=>$valueDirection]); ?>">Sms ouvert</a></th>
    <!--<th scope="col"><?= $this->Paginator->sort('Photos.PhotoDownloads','Photo téléchargée') ?> <a href="#">Photo téléchargée</a></th>-->
    <th scope="col"> <a href="<?=  $this->Paginator->generateUrl(['customSort' => 'download','customDirection'=>$valueDirection]); ?>">Photo téléchargée</a></th>
    <th scope="col" class="actions"><?= __('Actions') ?></th>
</tr>

<?php 
//echo $this->Paginator->generateUrl(['customSort' => 'emailEnvoye','direction'=>'asc']); 
// Use the defaults.
//echo $this->Paginator->limitControl();

// Define which limit options you want.
//echo $this->Paginator->limitControl([25 => 25, 50 => 50]);

// Custom limits and set the selected option
//echo $this->Paginator->limitControl([25 => 25, 50 => 50], $user->perPage);

?>