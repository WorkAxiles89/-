<?php
$this->menu=array(
	array('label'=>'Список акций','url'=>array('index')),
	array('label'=>'Создать акцию','url'=>array('create'), 'active' => true),
);
?>

<h1>Создать акцию</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>