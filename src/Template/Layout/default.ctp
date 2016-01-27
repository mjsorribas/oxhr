<?= $this->Html->doctype('html')?>
<html>
    <head>
        <?= $this->Html->charset() ?>
        <?= $this->Html->meta(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1.0'])?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title><?= $this->fetch('title') ?></title>
        <?= $this->Html->meta('icon') ?>
        <?= $this->Html->css(['bootstrap.min', 'font-awesome.min', 'style.common']) ?>

    </head>
<body class="pace-done">
<div class="pace  pace-inactive">
    <div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
        <div class="pace-progress-inner"></div>
    </div>
    <div class="pace-activity"></div>
</div>

<div id="wrapper">
    <?= $this->element('common/left-sidebar-menu');?>
    <div id="page-wrapper" class="gray-bg dashbard-1" style="min-height: 100%;">
        <?= $this->element('common/top-line-menu'); ?>
        <?= $this->element('common/breadcrumbs', ['page_title'=>$page_title]); ?>


        <div class="wrapper wrapper-content animated fadeInRight">
            <?= $this->fetch('content');?>
        </div>

    </div>
</div>
</body>
</html>
