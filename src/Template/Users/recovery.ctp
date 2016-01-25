<div class="users form">
    <h1><?= __('Восстановление доступа');?></h1>

<?php if (!$result): ?>
    <?= $this->Form->create('', ['class' => 'pure-form pure-form-aligned']) ?>
    <fieldset>
        <p><?= __('Для восстановления доступа к сайту введите свой адрес почты onix-systems или Gmail!');?></p>
        <?= $this->Form->input('email', ['label'=>"Ваша электронная почта", 'type'=>'email']) ?>
        <div class="pure-controls">
            <?= $this->Form->button(__('Сохранить'), array('class' => 'pure-button pure-button-primary')); ?>
        </div>
   </fieldset>
    <?= $this->Form->end() ?>
<?php else: ?>
    <p>
        <?= __('Инструкции для восстановления пароля была отправленна вам на электронную почту. Пройдите по ссылке в письме, что-бы задать новый пароль.')?>
    </p>
    <?php endif; ?>
</div>