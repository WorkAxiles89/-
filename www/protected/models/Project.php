<?php

/**
 * This is the model class for table "project".
 *
 * The followings are the available columns in table 'project':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $img
 * @property integer $cast
 */
class Project extends CActiveRecord
{
    public $icon;
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'project';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, description, cast', 'required'),
			array('cast', 'numerical', 'integerOnly'=>true),
			array('title, img', 'length', 'max'=>128),
            array('description', 'length', 'max'=>7000),
            array('icon', 'file',
				  'types'=>'jpg, gif, png',
				  'maxSize'=>1024 * 1024 * 5, // 5 MB
				  'allowEmpty'=>'true',
				  'tooLarge'=>'Файл весит больше 5 MB. Пожалуйста, загрузите файл меньшего размера.',
            ),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, description, img, cast', 'safe', 'on'=>'search'),
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
            'attachment'=>array(self::HAS_MANY, 'AttachmentProject', 'id_project'),
		);
	}
    
    protected function beforeDelete()
	{
		if(!parent::beforeDelete())
			return false;
            
        foreach ($this->attachment as $key => $value) {
            $model=AttachmentProject::model()->findByPk($value->id);        
            $model->delete();
        }
		
		$file = $_SERVER['DOCUMENT_ROOT'].
				Yii::app()->getBaseUrl().
				'/Image/Project/'.$this->img;
						
		$fileMini = $_SERVER['DOCUMENT_ROOT'].
					Yii::app()->getBaseUrl().
					'/Image/Project/mini-'.$this->img;
						
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
    
    protected function afterSave() {
        
        
        foreach ($_FILES['AttachmentProject']['name']['attachment'] as $key => $value) {
            $attach = new AttachmentProject;
            $attach->icon = CUploadedFile::getInstance($attach, "attachment[$key]");
            if (isset($attach->icon)) {
                $attach->id_project = $this->id;
                $attach->save();
            }
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
						'/Image/Project/'.$this->img;
				
				$fileMini = $_SERVER['DOCUMENT_ROOT'].
						Yii::app()->getBaseUrl().
						'/Image/Project/mini-'.$this->img;
						
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
						'/Image/Project/'.$fileName;
			$this->icon->saveAs($file);
					
			//Делаем ресайз только что загруженному изображению
			$Image = Image::factory("./Image/Project/".$fileName);
            
            if ($Image->width >= $Image->height) {
                $Image ->resize(375, 410, Image::WIDTH)->crop(375, 410, "top", "center");
                $Image ->save($_SERVER['DOCUMENT_ROOT'].
							Yii::app()->getBaseUrl().
							'/Image/Project/mini-'.$fileName);
            } else {
                $Image ->resize(235, 314, Image::HEIGHT)->crop(235, 314, "top", "center");
                $Image ->save($_SERVER['DOCUMENT_ROOT'].
							Yii::app()->getBaseUrl().
							'/Image/Project/mini-'.$fileName);
            }

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
			'title' => 'Заголовок',
			'description' => 'Описание',
			'img' => 'Главное фото',
			'cast' => 'Цена',
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('img',$this->img,true);
		$criteria->compare('cast',$this->cast);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Project the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
