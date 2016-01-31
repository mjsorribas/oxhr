<?php foreach ($skillsGrouping as $skill => $item): ?>
<div style="border: 1px solid #999; display: inline-block; padding: 4px; margin: 0 5px 5px 0;">
    <strong><?= $skill?></strong><br>
    <sapn>Developers: (<?= count($item['developers'])?>)</sapn><br>
    <sapn>Examples: (<?= count($item['info'])?>)</sapn>

</div>
<?php endforeach; ?>

<?php /*
<div class="usersSkills index large-9 medium-8 columns content">
    <h3><?= __('Users Skills') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th width="50"><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('skill_id') ?></th>
                <th width="50"><?= $this->Paginator->sort('level') ?></th>
                <th width="60%"><?= $this->Paginator->sort('description') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usersSkills as $usersSkill): ?>
            <tr>
                <td><?= $this->Number->format($usersSkill->id) ?></td>
                <td><?= $usersSkill->has('user') ? $this->Html->link($usersSkill->user->first_name.' '.$usersSkill->user->last_name, ['controller' => 'Users', 'action' => 'view', $usersSkill->user->id]) : '' ?></td>
                <td><?= $usersSkill->has('skill') ? $this->Html->link($usersSkill->skill->name, ['controller' => 'Skills', 'action' => 'view', $usersSkill->skill->id]) : '' ?></td>
                <td><?= $this->Number->format($usersSkill->level) ?></td>
                <td>
                    <?= !empty($usersSkill->description)?h($usersSkill->description):'&mdash;' ?> <br >
                    <span style="font-size: 12px; color: #999;">
                    <?= !empty($usersSkill->project_repo)?$this->Html->link(__('Репозиторий'), $usersSkill->project_repo):__('Нет репозиторий') ?> |
                    <?= !empty($usersSkill->project_link)?$this->Html->link(__('Проект'), $usersSkill->project_link):__('Нет ссылки на проект') ?>
                    </span>
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
*/?>