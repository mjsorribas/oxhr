<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <?php  if($authUser): ?>
                <div class="dropdown profile-element">
                    <span>
                        <img alt="image" class="img-circle" src="<?= $this->request->webroot?>img/users/profile_small.jpg">
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear">
                                <span class="block m-t-xs">
                                    <strong class="font-bold">Kholin Serhii</strong>
                                </span>
                                <span class="text-muted text-xs block">Director of Technology<b class="caret"></b></span>
                            </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="contacts.html">Contacts</a></li>
                        <li><a href="mailbox.html">Mailbox</a></li>
                        <li class="divider"></li>
                        <li><a href="login.html">Logout</a></li>
                    </ul>
                </div>
                <?php else: ?>
                Нужно залогиниться
                <?php endif; ?>
                <div class="logo-element">
                    IN+
                </div>
            </li>
<?php
    $main_menu = [
        'Company Skills'    => [
            'icon'  => '<i class="fa fa-bar-chart-o"></i>',
            'label' => __('Company Skills'),
            'link'  => ['controller' => 'users-skills'],
            ],
        'Users' => [
            'icon'  => '<i class="fa fa-child"></i>',
            'label' => __('Employees'),
            'link'  => ['controller' => 'users', 'action' => 'index'],
        ]
    ];
?>
    <?php foreach($main_menu as $item):?>
        <li>
            <?= $this->Html->link($item['icon'].'&nbsp;'.__($item['label']), $item['link'], ['escape' => false]);?>
        </li>
    <?php endforeach; ?>
            <!--<li class="active">
                <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Graphs</span><span class="fa arrow"></span></a>
            </li>
            <li>
                <a href="layouts.html"><i class="fa fa-diamond"></i> <span class="nav-label">Layouts</span></a>
            </li>-->
        </ul>
    </div>
</nav>