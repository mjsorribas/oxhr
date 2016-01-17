<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Users Skill'), ['action' => 'edit', $usersSkill->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Users Skill'), ['action' => 'delete', $usersSkill->id], ['confirm' => __('Are you sure you want to delete # {0}?', $usersSkill->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users Skills'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Users Skill'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Skills'), ['controller' => 'Skills', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Skill'), ['controller' => 'Skills', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="usersSkills view large-9 medium-8 columns content">
    <h3><?= h($usersSkill->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $usersSkill->has('user') ? $this->Html->link($usersSkill->user->id, ['controller' => 'Users', 'action' => 'view', $usersSkill->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Skill') ?></th>
            <td><?= $usersSkill->has('skill') ? $this->Html->link($usersSkill->skill->name, ['controller' => 'Skills', 'action' => 'view', $usersSkill->skill->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Project Repo') ?></th>
            <td><?= h($usersSkill->project_repo) ?></td>
        </tr>
        <tr>
            <th><?= __('Prokect Link') ?></th>
            <td><?= h($usersSkill->prokect_link) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($usersSkill->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Level') ?></th>
            <td><?= $this->Number->format($usersSkill->level) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($usersSkill->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($usersSkill->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($usersSkill->description)); ?>
    </div>
</div>
