<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $page_title?> | Login</title>
    <?= $this->Html->css(['bootstrap.min', 'font-awesome.min', 'animate', 'style.common']) ?>
</head>
<body class="gray-bg">
<?= $this->Html->script(['jquery.min.2.1.4', 'bootstrap.min']);?>
<?= $this->fetch('script');?>
<?= $this->fetch('content');?>
</body>
</html>