<?= $this->Html->script('Credits/dashbord.js', ['block' => true]); ?>
<script src="https://js.stripe.com/v3/"></script>
<input type="hidden" class="sessionId" value="<?= $session->id  ?>">
