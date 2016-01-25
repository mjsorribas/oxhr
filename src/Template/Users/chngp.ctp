<div class="users form">
    <h1><?= __('Изменение пароля');?></h1>

    <?php if (!empty($password)): ?>
    <?= $this->Form->create('', ['class' => 'pure-form pure-form-aligned']) ?>
    <fieldset>
        <?= $this->Form->input('pass', ['label'=>__("Ваш новый пароль").":", 'type'=>'text', 'value' => $password]) ?>
        <div class="pure-controls">
            <?= $this->Form->button(__('Сохранить'), array('class' => 'pure-button pure-button-primary')); ?>
        </div>
    </fieldset>
    <?php endif; ?>
</div>
