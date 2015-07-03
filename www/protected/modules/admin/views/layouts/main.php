<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

    <link rel="stylesheet" type="text/css" href="/css/styles.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<?php Yii::app()->bootstrap->register(); ?>
</head>

<body>


<?php $this->widget('bootstrap.widgets.TbNavbar',array(
	'brand'=>'Админка',
	'brandUrl'=>'/admin',
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
				array('label'=>'Работы', 'url'=>array('/admin/work')),
                array('label'=>'Проекты', 'url'=>array('/admin/project')),
                array('label'=>'Акции', 'url'=>array('/admin/stock')),
                array('label'=>'Войти', 'url'=>array('/admin'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Выйти ('.Yii::app()->user->name.')', 'url'=>array('/admin/default/logout'), 'visible'=>!Yii::app()->user->isGuest)
            ),
        ),
    ),
)); ?>


<div class="container" id="page">
	
	<?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
    'items'=>$this->menu
	)); ?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Создано <a href="http://web.categoriya.com">Categoriya Web</a><br/>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
