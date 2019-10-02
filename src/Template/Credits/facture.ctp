 <?php $this->extend('pdf_layout') ?>
 <?php $data = $this->request->session()->read('data_sms')?>
	
<div class="to-mg-top-xs invoice-content">
	<table class="table border-0 to-mg-top">
		<tbody>
			<tr style="background-color: #c5d9f1;" id="border-top-table border-left border-bottom-table">
				<td class="" width="48%" ><b>Description</b></td>
				<td class="text-center" width="12%" ><b>Quantité</b></td>
				<td class="text-center" width="18%" ><b>Prix Unit.</b></td>
				<td class="text-right" width="18%" ><b>Total HT</b></td>
			</tr>
			<tr id="no-border-bottom border-left" class="tr-inner">
				<td></td>
				<td><?= $data['nbr_sms']?></td>
				<td><?= $data['price']?></td>
				<td><?= $data['priceTtc']?></td>
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
				<td>TOTAL HT </td>
				<td style="border-bottom: 1px solid #000 !important"><span><?= $data['price']?></span></td>
			</tr>
			<tr class="text-right" id="no-border">
				<td colspan="2"></td>
				<td>TVA </td>
				<td style="border-bottom: 1px solid #000 !important"><span><?= $data['price']*0.2?></span></td>
			</tr>
			<tr class="text-right" id="no-border">
				<td colspan="2"></td>
				<td>TVA </td>
				<td style="border-bottom: 1px solid #000 !important"><span><?= $data['priceTtc']?></span></td>
			</tr>
		</tbody>
	</table>
</div>
