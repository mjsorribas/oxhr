<div class="passwordBox animated fadeInDown">
    <div class="row">

        <div class="col-md-12">
            <div class="ibox-content">

                <h2 class="font-bold"><?= __('Восстановление доступа');?></h2>

                <div class="row">

                    <div class="col-lg-12">

                        <?php if (!$result): ?>
                            <?= $this->Form->create('', []) ?>
                            <p><?= __('Для восстановления доступа к сайту введите свой адрес почты onix-systems или Gmail!');?></p>
                            <?= $this->Form->input('email', ['label'=>false, 'id'=>'email_input', 'type'=>'email', 'placeholder'=>"Email address", 'required'=>""]) ?>
                            <?= $this->Form->button(__('Выслать инструкции'), array('class' => 'btn btn-primary block full-width m-b')); ?>
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
        $("#email_input").focus();
    });
</script>