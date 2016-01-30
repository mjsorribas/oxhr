<div class="social-feed-box">
    <div class="ibox-content">
        <div class="pull-right social-action dropdown">
            <button data-toggle="dropdown" class="dropdown-toggle btn-white">
                <i class="fa fa-angle-down"></i>
            </button>
            <ul class="dropdown-menu m-t-xs">
                <li><a href="#">Config</a></li>
            </ul>
        </div>

        <h3><?= __('Скилы сотрудника')?></h3>

<?php
    if (!empty($user->skills)):
        foreach($user->skills as $item):
            echo $this->Form->button($item->name, ['type'=>'button', 'class' => 'btn btn-outline btn-primary']);
        endforeach;
    else:
        we('Empty');
    endif;
?>

    </div>
</div>
