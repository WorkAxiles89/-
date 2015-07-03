<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'stock-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="help-block">Поля обязательные для заполнения <span class="required">*</span></p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textArea($model,'description',array('class'=>'span5','maxlength'=>7000)); ?>
    
    <br>
	<?php echo $form->fileFieldRow($model, 'icon'); ?>
	<br><br>
    
    <br><br>
	<?php //Если картинка для данного товара загружена, предложить её удалить, отметив чекбокс 
		if(isset($model->img) and $model->img != '' and file_exists($_SERVER['DOCUMENT_ROOT'].Yii::app()->getBaseUrl().'/Image/Stock/'.$model->img)){
				echo CHtml::image(Yii::app()->getBaseUrl(true).'/Image/Stock/mini-'.$model->img, $model->title,
					array(
						'id' => 'preview'
						)
					);
			} 
			else
			{
				echo CHtml::image(Yii::app()->getBaseUrl(true).'/Image/No_work.jpg','Нет картинки',
				array(
					'width'=>302,
					'class'=>200
					)
				);
			}
			
	?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
