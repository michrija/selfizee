<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Eliteadmin Responsive web app kit</title>
</head>
<body style="margin:0px; background: #f8f8f8; ">
<div width="100%" style="background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;">
  <div style="max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px">
  
    <div style="padding: 40px; background: #fff;">
      <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
        <tbody>
          <tr>
            <?php
                $titreHeader = $galerie->titre;
                if(empty($titreHeader)){
                    $titreHeader = $galerie->evenements[0]->nom;
                }
            ?>
            <td><b>Bonjour,</b>
              <p>Des nouvelles photos viennent d'être déposer dans votre galerie <b><? $titreHeader ?></b>. Veuillez cliquer sur ce lien pour les voir et les valider.<br/></p>
                <?php 
                echo $this->Html->link(
		                     "Modérer",
		                     ['controller' => 'Photos', 'action' => 'liste', $evenement->id, '?'=>['is_validate' => false]],
		                     ["style"=>"display: inline-block; padding: 11px 30px; margin: 20px 0px 30px; font-size: 15px; color: #fff; background: #00c0c8; border-radius: 60px; text-decoration:none;"]
		                );
                ?>
              <p></p><br/>
			  <b>Equipe Selfizee</b> </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>