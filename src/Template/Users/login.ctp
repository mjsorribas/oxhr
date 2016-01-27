<div class="col-lg-7">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Login Form</h5>
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
                <div class="col-sm-6 b-r">
                    <div role="form" lpformnum="1" _lpchecked="1">
                        <?= $this->Flash->render('auth') ?>
                        <?= $this->Form->create() ?>
                        <legend><?= __('Please enter your username and password') ?></legend>
                        <?= $this->Form->input('username', ['placeholder' => 'Username']) ?>
                        <?= $this->Form->input('password') ?>
                        <div>
                        <?= $this->Form->button(__('Login'), ['class'=>'btn btn-sm btn-primary pull-right m-t-n-xs']); ?>
                        </div>
                        <?= $this->Form->end() ?>
                        <div class="additional-link">
                            <?= $this->Html->link(__('Восстановить пароль'), ['controller'=>'users', 'action'=>'recovery'])?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>