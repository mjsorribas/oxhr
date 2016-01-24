<div class="users form">
    <h1><?= __('Восстановление доступа');?></h1>
    <p><?= __('Для восстановления доступа к сайту введите свой адрес почты onix-systems или Gmail!');?></p>
<?= $this->Form->create('', ['class' => 'pure-form pure-form-aligned']) ?>
    <fieldset>

        <?= $this->Form->input('email', ['label'=>"Ваша электронная почта", 'type'=>'email']) ?>
        <div class="pure-controls">
            <?= $this->Form->button(__('Сохранить'), array('class' => 'pure-button pure-button-primary')); ?>
        </div>
   </fieldset>
    <!--<fieldset class="b_soc-signup">
        <legend><?/*= __('Або зареєструватися через соц.мережу') */?></legend>
        <a href="#!/signup-vk" class="soc-signup signup-vk"><?/*= __('через Вконтакті')*/?></a> |
        <a href="#!/signup-fb" class="soc-signup signup-fb"><?/*= __('через Facebook')*/?></a>
    </fieldset>-->
<?= $this->Form->end() ?>
</div>