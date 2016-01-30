<div class="ibox">
    <div class="ibox-content">
        <h3><?= __('Contacts');?></h3>

        <?php  $contacts = ['phone', 'email', 'gmail', 'skype', 'social_fb']; ?>
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th><?= __('Тип');?></th>
                <th><?= __('Контакт');?></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $i = 1;
            foreach($contacts as $type):?>
                <?php if (!empty($user->$type)): ?>
                <tr>
                    <td><?= $i++;?></td>
                    <td><?= __($type);?></td>
                    <td><?= $user->$type;?></td>
                </tr>
                <?php endif; ?>
            <?php endforeach;?>
            </tbody>
        </table>

        <p class="small font-bold">
            <span><i class="fa fa-circle text-navy"></i> Online status</span>
        </p>

    </div>
</div>