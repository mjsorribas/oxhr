<div class="col-lg-4">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5><?= $page_title?></h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-wrench"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#">Config option 1</a>
                    </li>
                    <li><a href="#">Config option 2</a>
                    </li>
                </ul>
                <a class="close-link">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-sm-12">
                    <?php if (!$result): ?>
                        <?= $this->Form->create('', ['class' => 'pure-form pure-form-aligned']) ?>
                        <fieldset>
                            <p><?= __('Для восстановления доступа к сайту введите свой адрес почты onix-systems или Gmail!');?></p>
                            <?= $this->Form->input('email', ['label'=>"Ваша электронная почта", 'type'=>'email']) ?>
                            <div>
                                <?= $this->Form->button(__('Сохранить'), array('class' => 'btn btn-sm btn-primary pull-right m-t-n-xs')); ?>
                            </div>
                        </fieldset>
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