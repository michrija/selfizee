 <?php $this->extend('pdf_layout') ?>
 <?php $data = $this->request->session()->read('data_sms')?>
<div class="to-mg-top-xs invoice-content">
	<table class="table border-0 to-mg-top">
		<tbody>
			<tr style="background-color: #ed195f;" id="border-top-table border-left border-bottom-table">
				<td class="" width="48%" ><b>Description</b></td>
				<td class="text-right" width="18%" ><b>Total HT</b></td>
			</tr>
			<tr id="no-border-bottom border-left" class="tr-inner">
				<td> Pack <?= $data['nbr_sms']?>  sms prémium</td>
				<td><?= $data['price']?> €</td>
			</tr>
		</tbody>

	</table>
	<table class="table border-0" style="border-color: #FFF;margin-top: -10px;margin-bottom: 40px">
		<tbody>
			<tr class="text-right" id="no-border-top">
				<th width="48%"></th>
				<th width="15%"></th>
				<th width="15%"></th>
				<th width="18%"></th>
			</tr>
		   	<tr class="text-right" id="no-border">
				<td colspan="2"></td>
				<td>Montant HT </td>
				<td style="border-bottom: 1px solid #000 !important"><span><?= $data['price']?> €</span></td>
			</tr>
			<tr class="text-right" id="no-border">
				<td colspan="2"></td>
				<td>TVA </td>
				<td style="border-bottom: 1px solid #000 !important"><span><?= $data['price']*0.2?> €</span></td>
			</tr>
			<tr class="text-right" id="no-border">
				<td colspan="2"></td>
				<td>Montant Total  </td>
				<td style="border-bottom: 1px solid #000 !important"><span><?= $data['price']*1.2?> €</span></td>
			</tr>
		</tbody>
	</table>
</div>
