<?php
require_once 'app/controllers/api.controller.php';
require_once 'app/helpers/auth.api.helper.php';
require_once 'app/models/user.model.php';


class UserApiController extends ApiController {
    private $model;
    private $authHelper;

    function __construct() {
        parent::__construct();
        $this->authHelper = new AuthHelper();
        $this->model = new UserModel();
    }

    function getToken($params = null) {
        $basic = $this->authHelper->getAuthHeaders(); //me da el header authorization
        
        if(empty($basic)) {
            $this->view->response('Authentication header was not sent' ,401);
            return;
        }

        $basic = explode(" ", $basic);

        if($basic[0] !="Basic") {
            $this->view->response('The authentication header is incorrect', 401);
            return;
        }

        $userpass = base64_decode($basic[1]); //user
        $userpass = explode(":", $userpass); //pass, separo user y contra con :

        $user = $userpass[0];
        $pass = $userpass[1];

        $userinfo = $this->model->getUser($user);

        if ($userinfo) {
            if (password_verify($pass, $userinfo['password'])) { //pass y user correcto
                $token = $this->authHelper->createToken($userinfo);
                $this->view->response($token);
            } else {
                $this->view->response('Wrong password', 401);
            }
        } else {
            $this->view->response('Wrong User', 401);
        }
    }
}

    
