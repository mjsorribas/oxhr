<div class="users form">
    <h1><?= __('Швидка реєстрація');?></h1>
    <p><?= __('Зареєструвавшись на сайті ви назавжди збережете свої показники і зможете легко додавати нові!');?></p>
<?= $this->Form->create($user, ['class' => 'pure-form pure-form-aligned']) ?>
    <fieldset>
        <legend><?= __('Це швидко') ?></legend>
        <?= $this->Form->input('email', ['label'=>"Ваша поштова скринька", 'type'=>'email']) ?>
        <div class="pure-controls">
            <?= $this->Form->button(__('Вислати мені пароль'), array('class' => 'pure-button pure-button-primary')); ?>
        </div>
   </fieldset>
    <fieldset class="b_soc-signup">
        <legend><?= __('Або зареєструватися через соц.мережу') ?></legend>
        <a href="#!/signup-vk" class="soc-signup signup-vk"><?= __('через Вконтакті')?></a> |
        <a href="#!/signup-fb" class="soc-signup signup-fb"><?= __('через Facebook')?></a>
    </fieldset>
<?= $this->Form->end() ?>
</div>