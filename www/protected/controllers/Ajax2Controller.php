<?php



class Ajax2Controller extends AjaxController {

    
    public function actionDeleteAttach() {
       
        if (!isset($_POST['id'])) {
            $this->response('error');
        }
        $id = $_POST['id'];
        
        $model=AttachmentProject::model()->findByPk($id);
		if($model===null)
			$this->response('error');
        
       $model->delete();
       
       $this->response('success');
	}
    
    public function actionSendEmail() {
       
        if (!isset($_POST['email']) or !isset($_POST['text'])) {
            $this->response('error');
        }
        $email = $_POST['email'];
        $text = iconv('utf8', 'cp1251', $_POST['text']);
        
        $headers  = "Content-type: text/html; charset=windows-1251 \r\n"; 
        $headers .= "From: Пользователь<".$email.">\r\n"; 
        $headers .= "To: dimkysh@mail.ru\r\n"; 
        $subject = "Обратная связь!";     
                            
		mail('dimkysh@mail.ru', $subject, $text, $headers); 
       
       $this->response('success');
	}
    
    public function actionDeleteAttachWork() {
       
        if (!isset($_POST['id'])) {
            $this->response('error');
        }
        $id = $_POST['id'];
        
        $model=AttachmentWork::model()->findByPk($id);
		if($model===null)
			$this->response('error');
        
       $model->delete();
       
       $this->response('success');
	}

  

}