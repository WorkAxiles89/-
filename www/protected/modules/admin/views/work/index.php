<?php
$this->menu=array(
	array('label'=>'Список работ','url'=>array('index'), 'active'=>true),
	array('label'=>'Создать работу','url'=>array('create')),
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('work-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Менеджер работ</h1>

<p>
Вы можете просматривать, редактировать, удалять работы вашей фирмы.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'work-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
        'description',
		'img',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
