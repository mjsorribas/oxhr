<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Positions'), ['controller' => 'Positions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Position'), ['controller' => 'Positions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Skills'), ['controller' => 'Skills', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Skill'), ['controller' => 'Skills', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Specializations'), ['controller' => 'Specializations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Specialization'), ['controller' => 'Specializations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
            echo $this->Form->input('username');
            echo $this->Form->input('password');
            echo $this->Form->input('first_name');
            echo $this->Form->input('last_name');
            echo $this->Form->input('email');
            echo $this->Form->input('gmail');
            echo $this->Form->input('skype');
            echo $this->Form->input('birthday');
            echo $this->Form->input('ssh_key');
            echo $this->Form->input('table_num');
            echo $this->Form->input('positions._ids', ['options' => $positions]);
            echo $this->Form->input('skills._ids', ['options' => $skills]);
            echo $this->Form->input('specializations._ids', ['options' => $specializations]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
