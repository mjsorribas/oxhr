<?php
    $passInputID = 'pass-input-id';
?>
<div class="passwordBox animated fadeInDown">
    <div class="row">

        <div class="col-md-12">
            <div class="ibox-content">

                <h2 class="font-bold"><?= __('Восстановление доступа');?></h2>
                <p><?= __('Введите свой новый пароль и нажмите "Сохранить"');?></p>
                <div class="row">

                    <div class="col-lg-12">

                        <?php if (empty($result)): ?>
                            <?= $this->Form->create('', []) ?>
                            <?= $this->Form->input('password', ['label'=>false, 'type'=>'text', 'id'=>$passInputID, 'value' => $password, 'required'=>"", 'autocomplete'=>"off"]) ?>
                            <?= $this->Form->button(__('Сохранить новый пароль'), array('class' => 'btn btn-primary block full-width m-b')); ?>
                            <?= $this->Form->end() ?>
                        <?php else: ?>
                            <div class="alert alert-success">
                                <?= __('Инструкции для восстановления пароля была отправленна вам на электронную почту. Пройдите по ссылке в письме, что-бы задать новый пароль.')?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6">
            Onix-Systems
        </div>
        <div class="col-md-6 text-right">
            <small>&copy; 2015&mdash;<?= date('Y');?></small>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('#<?= $passInputID?>').select().focus();
    });
</script>
