<?php
/**
 * AjaxController.php
 *
 * @author Sklyarov Alexey <sufir@lightsoft.ru>
 * @package Controller
 * @date 21.03.2014 17:39:46
 * @copyright LightSoft 2014
 */

/**
 * AjaxController
 *
 * Description of AjaxController
 *
 * @author Sklyarov Alexey <sufir@lightsoft.ru>
 * @package Controller
 */
class AjaxController extends CController {

    /*public function init() {
        return parent::init();
    }*/

    public function response($response, $message = NULL) {
        if (!is_array($response)) {
            $response = array(
                'result' => $response
            );

            if ($message) {
                $response['message'] = strval($message);
            }
        }
        
        echo json_encode($response);
        Yii::app()->end();
    }

}