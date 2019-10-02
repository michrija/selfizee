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
            <td>
                <b>Bonjour,</b>
                <p><?= count($visiteur->photos) > 1 ? count($visiteur->photos)." photos" : "photo" ?> que vous avez déposé dans la galerie <?= $titreHeader ?> vient d'être valider.</p>
                <p>Vous pouvez vous connecter dans la galerie pour <?= count($visiteur->photos) > 1 ? count($visiteur->photos)." les " : "la " ?> consulter. </p>
                <p></p><br/>
	            <b>Equipe Selfizee,</b> </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>