<?php

/**
 * This is the model class for table "work".
 *
 * The followings are the available columns in table 'work':
 * @property integer $id
 * @property string $title
 * @property string $img
 */
class Work extends CActiveRecord
{
	public $icon; // атрибут для хранения загружаемой картинки статьи
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'work';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, description', 'required'),
			array('title, img, description', 'length', 'max'=>128),
			array('icon', 'file',
				  'types'=>'jpg, gif, png',
				  'maxSize'=>1024 * 1024 * 5, // 5 MB
				  'allowEmpty'=>'true',
				  'tooLarge'=>'Файл весит больше 5 MB. Пожалуйста, загрузите файл меньшего размера.',
				),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, img', 'safe', 'on'=>'search'),
		);
	}
	
	protected function beforeDelete()
	{
		if(!parent::beforeDelete())
			return false;
            
        foreach ($this->attachment as $key => $value) {
            $model=AttachmentWork::model()->findByPk($value->id);        
            $model->delete();
        }
		
		$file = $_SERVER['DOCUMENT_ROOT'].
				Yii::app()->getBaseUrl().
				'/Image/Work/'.$this->img;
						
		$fileMini = $_SERVER['DOCUMENT_ROOT'].
					Yii::app()->getBaseUrl().
					'/Image/Work/mini-'.$this->img;
						
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
		
		if(($this->scenario=='insert' || $this->scenario=='update') &&
            ($this->icon = CUploadedFile::getInstance($this,'icon')))
		{
			// Если обновляем запись, то удаляем прошлую фотографию
			if ($this->scenario=='update')
			{
				$file = $_SERVER['DOCUMENT_ROOT'].
						Yii::app()->getBaseUrl().
						'/Image/Work/'.$this->img;
				
				$fileMini = $_SERVER['DOCUMENT_ROOT'].
						Yii::app()->getBaseUrl().
						'/Image/Work/mini-'.$this->img;
						
				if (file_exists($file) and $this->img != '')
				{
					unlink($file);
				}
				if (file_exists($fileMini) and $this->img != '')
				{
					unlink($fileMini);
				}
			}
			
			$fileName = mktime(date("i")).'.jpg';
			$this->img = $fileName;
			
			$file = $_SERVER['DOCUMENT_ROOT'].
						Yii::app()->getBaseUrl().
						'/Image/Work/'.$fileName;
			$this->icon->saveAs($file);
					
			//Делаем ресайз только что загруженному изображению
			$Image = Image::factory("./Image/Work/".$fileName);
					
			$Image ->resize(360, 225, Image::WIDTH)->crop(360, 225, "top", "center");
			$Image ->save($_SERVER['DOCUMENT_ROOT'].
							Yii::app()->getBaseUrl().
							'/Image/Work/mini-'.$fileName);
		}
		
		return true;
	}
    
    protected function afterSave() {
        
        
        foreach ($_FILES['AttachmentWork']['name']['attachment'] as $key => $value) {
            $attach = new AttachmentWork;
            $attach->icon = CUploadedFile::getInstance($attach, "attachment[$key]");
            if (isset($attach->icon)) {
                $attach->id_work = $this->id;
                $attach->save();
            }
        }
        
        return true;
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
        return array(
            'attachment'=>array(self::HAS_MANY, 'AttachmentWork', 'id_work'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Заголовок',
			'img' => 'Картинка',
            'description' => 'Описание',
			'icon' => 'Картинка',
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
		$criteria->compare('title',$this->title,true);
        $criteria->compare('description',$this->title,true);
		$criteria->compare('img',$this->img,true);
		$criteria->order = 'id DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
				'pageSize' => 20
			),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Work the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
