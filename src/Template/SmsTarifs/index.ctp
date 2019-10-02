<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="">Prix </th>
                        <th class="">Nombres</th>
                        <th width="12%">Ations</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($res as $value): ?>
                    <tr id="<?= $value->id; ?>">
                        <td><?php echo  $this->Number->precision($value->prix, 2 ); ?> € </td>
                        <td><?= $value->nbr_sms; ?></td>
                        <td>
                            <a href=" <?= $this->Url->build(['controller' => 'SmsTarifs', 'action' => 'editer',$value->id]) ?>"><button class="btn  kl_btn_refresh">Editer</button></a>
                             <button class="btn  btn-danger delete" data-id="<?= $value->id;?>">X</button>
                               <a  class="url" style="display:none;" href="<?= $this->Url->build(['controller' => 'SmsTarifs', 'action' => 'delete', $value->id]) ?>"></a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="6">
                        <?= $this->Html->link('+ ajouter', array('controller' => 'SmsTarifs', 'action' => 'add'), ['class'=>"btn btn-danger"]); ?> 
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </tbody>
</table>

</div>
</div>
<?= $this->Html ->script('jquery/jquery.min.js') ?>
<script>
   jQuery(document).ready(function($) {
        $('.delete').click(function(event) {
            /* Act on the event */
            if (confirm('Etes vous sûr de vouloir supprimer ?')) {
                 var url=$('.url').attr('href');
                  var id=$(this).attr('data-id');
                 $.get(url, {id:id},function(data) {
                 /*optional stuff to do after success */
                 $('#'+id).remove();
             });
            }
           
          
        });
    });
</script>