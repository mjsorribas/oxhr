<?php if (!empty($skillsGrouping)):?>
<div class="usersSkills index large-9 medium-8 columns content">
    <?php foreach ($skillsGrouping as $skill => $item): ?>
    <div class="btn btn-outline btn-success one-skill-button" 
        data-developers="" data-skill-description="">
        <?= $skill?> <sapn title="Developers:"><?= count($item['developers'])?></sapn>, <sapn title="Examples:"><?= count($item['info'])?></sapn>
    </div>
    <?php endforeach; ?>
</div>
<?php else: ?>
<div class="alert alert-warning">
    <?= __('No one skill was found');?> <?= $this->Html->link(__('Add your skills'), ['controller'=>'users', 'action'=>'skills-edit'], ['class'=>'alert-link']);?>
</div>
<?php endif; ?>
 