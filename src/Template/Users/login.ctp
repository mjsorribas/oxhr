<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>

            <h1 class="logo-name">NX</h1>

        </div>
        <h3>Welcome to ONIX</h3>
        <p></p>
        <p>Login in. To see it in action.</p>

        <div role="form" lpformnum="1" _lpchecked="1">
            <?= $this->Flash->render('auth') ?>
            <?= $this->Form->create('', ['class' => 'm-t']) ?>
            <?= $this->Form->input('username', ['label'=>false, 'id'=>'username', 'placeholder' => 'Username', 'required'=>"", 'autocomplete'=>"off"]) ?>
            <?= $this->Form->input('password', ['label'=>false, 'placeholder' => "Password", 'required'=>"", 'autocomplete'=>"off" ]) ?>
            <?= $this->Form->button(__('Login'), ['class'=>'btn btn-primary block full-width m-b']); ?>

            <?= $this->Html->link('<small>'.__('Восстановить пароль').'</small>', ['controller'=>'users', 'action'=>'recovery'], ['escape'=>false])?>
            <p class="text-muted text-center"><small>Do not have an account?
                    <?= $this->Html->link(__('Request an access'), 'mailto:xain@onix-systems.com')?></small></p>

            <?= $this->Form->end() ?>
            <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 <br>
                    <?= $this->Html->link('@xainse', 'https://twitter.com/xainse', ['target' => '_blank']);?> &copy; 2015&mdash;<?= date('Y');?></small> </p>
        </div>

</div>
</div>
<script>
    $(function(){
        $("#username").focus();
    });
</script>
</body>
</html>