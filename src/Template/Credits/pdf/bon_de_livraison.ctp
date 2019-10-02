<?php $this->assign('title', 'Bon de livraison') ?>

<?php if ($test): ?>
    <?php $this->extend('pdf/pdf_layout') ?>
<?php else: ?>
    <?php $this->extend('pdf_layout') ?>
<?php endif ?>

<div class="row-fluid head">
    <div class="row">
        <div class="col-xs-6">
            <b><?= $delivery['head_1'] ?></b>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-8"></div>
        <div class="col-xs-4">
            <?= $delivery['head_2'] ?>
        </div>
    </div>
</div>
 <div class="row ">

<div class="row-fluid ">
    <div class="row-fluid mb3">
        Commercial: <?= $delivery['commercial'] ?> <br>
    </div>
</div>

<div class="row-fluid mb2">
    <table class="table table-hover table-bordered ">
        <thead class="bg-light">
            <tr>
                <th class="text-center">Numéro</th>
                <th class="text-center">Date</th>
                <th class="text-center">Code client</th>
                <th class="text-center">Mode de paiement</th>
                <th class="text-center">N° de Tva intracom</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center"><?= $delivery['delivery_number'] ?></td>
                <td class="text-center"><?= $delivery['date']->format('d/m/Y') ?></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>

<div class="row-fluid">
    <table class="table table-hover table-bordered">
        <thead class="bg-light">
            <tr>
                <th width="90%" class="text-center" colspan="2">Description</th>
                <th width="10%" class="text-center">Qté</th>
            </tr>
        </thead>
        <?php $details = $delivery['details']; ?>
        <tbody>
            <?php foreach ($details as $key => $detail): ?>

                <tr>
                    <td colspan="2" class="b-r"><b><?= $detail['project_name'] ?></b></td>
                    <td class="b-r"></td>
                </tr>

                <?php foreach ($detail['title'] as $key => $title): ?>

                    <tr>
                        <td colspan="2" class="b-r pl-30"><?= $title ?></td>
                        <td class="b-r"></td>
                    </tr>

                    <?php $descriptions = $detail['description'][$key]; ?>
                    <?php $qty = @$detail['qty'][$key]; ?>

                    <?php foreach ($descriptions as $key => $description): ?>
                        <tr>
                            <td class="b-r pl-60" colspan="2" ><?= nl2br($description) ?></td>
                            <td class="n-b"><?= @$qty[$key] ?></td>
                        </tr>
                    <?php endforeach ?>

                <?php endforeach ?>

            <?php endforeach ?>
        </tbody>
    </table>
</div>

<footer>
    <p class="text-center mt-2"><?= $delivery['footer'] ?></p>
</footer>
