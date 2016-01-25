<?php
    $passInputID = 'pass-input-id';
?>

<div class="users form">
    <h1><?= __('Изменение пароля');?></h1>

    <?php if (!empty($password)): ?>
    <?= $this->Form->create('', ['class' => 'pure-form pure-form-aligned']) ?>
    <fieldset>
        <?= $this->Form->input('password', ['label'=>__("Ваш новый пароль")." ".__('(или введите свой пароль)'). ":", 'type'=>'text', 'id'=>$passInputID, 'value' => $password]) ?>
        <div class="pure-controls">
            <?= $this->Form->button(__('Сохранить'), array('class' => 'pure-button pure-button-primary')); ?>
        </div>
    </fieldset>
    <?php endif; ?>
</div>
<script>
$(function(){
    $('#<?= $passInputID?>').select().focus();
});
</script>