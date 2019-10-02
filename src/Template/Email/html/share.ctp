<html>

<?php
if ($vision == 1) {

    $url                  = $this->Url->Build("/visions/visualisation/" . $id_mail_log . "/" . $_cadre_name, true);
    echo $this->Html->link(__('Pour visualiser en ligne, rendez vous ici'), $url);
}
if ($vision == 2) {
    $url                  = $this->Url->Build($img_url, true);
    echo "<img src='".$url."' />";
}
echo $content;
?>
<?php /*<p>---------------------------------<br/>
    <?php echo $description; ?>
    <?php echo $signature; ?>
</p>*/ ?>
</html>
