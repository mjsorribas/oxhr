<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?= $page_title;?></h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?= $this->request->webroot;?>">Home</a>
            </li>
        <?php foreach($bread_crumbs as $title => $link): ?>
            <?php if (!empty($link)):?>
                <li><?= $this->Html->link(__($title), $link)?></li>
            <?php else: ?>
                <li class="active"><strong><?= $title;?></strong></li>
            <?php endif; ?>
            <?php endforeach; ?>
        </ol>
    </div>
    <!--<div class="col-lg-2">

    </div>-->
</div>