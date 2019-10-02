<?=   $this->Html->script('ConditionLojika/lojika.js', ['block' => true]); ?>
<?=   $this->Html->css('conditionLogique/lojika.css', ['block' => true]); ?>

<div id="demo" class="main-wrapper">
  <label class=""><input type="radio" name="example1" value="yes"><span></span> Oui</label>
  <label><input type="radio" name="example1" value="no"><span></span> Non</label>

  <div class="conditional" data-cond-option="example1" data-cond-value="yes">
    <label><input type="checkbox" name="example2"><span></span>Vous êtes sûr?</label>
    <label><input type="checkbox" name="example3"><span></span>Vraiment sûr?</label>
    
    <div class="conditional" data-cond-option="example2" data-cond-value="on">
      Ourahhhh!
    </div>
    <div class="conditional" data-cond-option="example3" data-cond-value="on">
      Soit pas arrogant!
    </div>
  </div>
  
  <div class="conditional" data-cond-option="example1" data-cond-value="no">
    <p>C'est de la honte. Voulez vous changer votre opinion?</p>
    
    <label><input type="radio" name="example4" value="yes"><span></span> Yes</label>
    <label><input type="radio" name="example4" value="no"><span></span> No</label>
    
    <div class="conditional" data-cond-option="example4" data-cond-value="yes">
      Super!
    </div>
  </div>
  
  <p>
    <label>Ou choisissez:</label>
    <select class="select" name="example5">
      <option>Séléctionner un!</option>
      <option value="yes">Oui!</option>
      <option value="no">Non!</option>
    </select>
  </p>
  <div class="conditional" data-cond-option="example5" data-cond-value="yes">
    ça marche sur la séléction!
  </div>
   <p>
    <label>Ou tapez:</label>
    <input type="text" name="example6" placeholder="Event-Selfizee-V2">
  </p>
  <div class="conditional" data-cond-option="example6" data-cond-value="yay">
    ça marche sur la saisie!
  </div>
</div>