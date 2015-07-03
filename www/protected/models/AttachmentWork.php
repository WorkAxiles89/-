<?php

/**
 * This is the model class for table "attachment_project".
 *
 * The followings are the available columns in table 'attachment_project':
 * @property integer $id
 * @property integer $id_project
 * @property integer $img
 */
class AttachmentWork extends CActiveRecord
{
    public $icon;
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'attachment_work';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_work', 'required'),
			array('id_work, img', 'numerical', 'integerOnly'=>true),
            array('icon', 'file',
				  'types'=>'jpg, gif, png',
				  'maxSize'=>1024 * 1024 * 5, // 5 MB
				  'allowEmpty'=>'true',
				  'tooLarge'=>'Файл весит больше 5 MB. Пожалуйста, загрузите файл меньшего размера.',
            ),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_work, img', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}
    
    protected function beforeDelete()
	{
		if(!parent::beforeDelete())
			return false;
		
		$file = $_SERVER['DOCUMENT_ROOT'].
				Yii::app()->getBaseUrl().
				'/Image/AttachmentWork/'.$this->img;
						
		$fileMini = $_SERVER['DOCUMENT_ROOT'].
					Yii::app()->getBaseUrl().
					'/Image/AttachmentWork/mini-'.$this->img;
						
		if (file_exists($file) and $this->img != '')
		{
			unlink($file);
		}
		if (file_exists($fileMini) and $this->img != '')
		{
			unlink($fileMini);
		}
		
		return true;
	}
    
    protected function beforeSave()
	{
		if(!parent::beforeSave())
			return false;
            
		if(($this->scenario=='insert') && isset($this->icon))
		{		
			$fileName = mktime(date("i")).rand(1,100).rand(1,100).'.jpg';
			$this->img = $fileName;
			
			$file = $_SERVER['DOCUMENT_ROOT'].
						Yii::app()->getBaseUrl().
						'/Image/AttachmentWork/'.$fileName;
            
			$this->icon->saveAs($file);
					
			//Делаем ресайз только что загруженному изображению
			$Image = Image::factory("./Image/AttachmentWork/".$fileName);
            
            $Image ->resize(375, 210, Image::WIDTH)->crop(375, 210);
            $Image ->save($_SERVER['DOCUMENT_ROOT'].
					Yii::app()->getBaseUrl().
                    '/Image/AttachmentWork/mini-'.$fileName);

		}
		
		return true;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_work' => 'Id Work',
			'img' => 'Img',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('id_work',$this->id_work);
		$criteria->compare('img',$this->img);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AttachmentProject the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
