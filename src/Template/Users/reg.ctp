<!-- src/Template/Users/reg.ctp -->
<h2 class="content-subhead"><?= __('Стати частиною команди');?></h2>
<div class="users form">
    <?= $this->Form->create($user, array('class' => 'pure-form pure-form-aligned')) ?>
    <fieldset>
        <legend><?= __('Зареєструватися!') ?></legend>
        <?= $this->Form->input('name', array('label' => __('Ім*я користувача') . ':')) ?>
        <?= $this->Form->input('email', array('label' => __('Ел. пошта') . ':')) ?>
        <?= $this->Form->input('password', array('label' => __('Пароль') . ':')) ?>
    <div class="pure-controls">
    <?= $this->Form->button(__('Зберегти'), array('type' => 'submit', 'class'=>'pure-button pure-button-primary'));?>
    </div>
    </fieldset>
    <?= $this->Form->end() ?>
</div>