<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Users Skill'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Skills'), ['controller' => 'Skills', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Skill'), ['controller' => 'Skills', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="usersSkills index large-9 medium-8 columns content">
    <h3><?= __('Users Skills') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('skill_id') ?></th>
                <th><?= $this->Paginator->sort('level') ?></th>
                <th><?= $this->Paginator->sort('project_repo') ?></th>
                <th><?= $this->Paginator->sort('prokect_link') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usersSkills as $usersSkill): ?>
            <tr>
                <td><?= $this->Number->format($usersSkill->id) ?></td>
                <td><?= $usersSkill->has('user') ? $this->Html->link($usersSkill->user->id, ['controller' => 'Users', 'action' => 'view', $usersSkill->user->id]) : '' ?></td>
                <td><?= $usersSkill->has('skill') ? $this->Html->link($usersSkill->skill->name, ['controller' => 'Skills', 'action' => 'view', $usersSkill->skill->id]) : '' ?></td>
                <td><?= $this->Number->format($usersSkill->level) ?></td>
                <td><?= h($usersSkill->project_repo) ?></td>
                <td><?= h($usersSkill->prokect_link) ?></td>
                <td><?= h($usersSkill->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $usersSkill->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $usersSkill->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $usersSkill->id], ['confirm' => __('Are you sure you want to delete # {0}?', $usersSkill->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
