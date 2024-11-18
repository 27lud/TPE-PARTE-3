<?php
require_once 'app/controllers/api.controller.php';
require_once 'app/models/bikes.api.model.php';
require_once 'app/helpers/auth.api.helper.php';


class BikesApiController extends ApiController {
    private $model;
    private $authHelper;
    

    public function __construct() {
        parent::__construct();
        $this->model = new BikesModel();
        $this->authHelper = new AuthHelper();
        
    }

    public function getBikes() {
    
        $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1; //pagina
        $per_page = !empty($_GET['per_page']) ? (int)$_GET['per_page'] : 5; //cantidad de elementos por pagina
        $start_index = ($page - 1) * $per_page;
    
        $limit = intval($per_page);
        $offset = intval($start_index);
    
        if (isset($_GET['order'])) {

            if (($_GET['order'] == "asc") || ($_GET['order'] == "ASC")) {
                $bikes = $this->model->Upward();

            } elseif (($_GET['order'] == "desc") || ($_GET['order'] == "DESC")) {
                $bikes = $this->model->Falling();
            }
            
        } else {
            
            $bikes = $this->model->getBikes($limit, $offset);
        }
    
        $this->view->response($bikes, 200);
    }
    
    public function getBike($params = null) {
        
        $id = $params[':ID']; // obtengo el id del arreglo de params
        $bike = $this->model->getBike($id);

        if ($bike) {
            $this->view->response($bike, 200);
        }
        else {
            $this->view->response("The bike with the id $id doesn´t exist", 404);
        }
    }

    public function insertBike($params = null) {
        $user = $this->authHelper->currentUser();
        if(!$user) {
            $this->view->response('Unauthorized', 401);
            return;
            
        }
        $bike = $this->getData();

        if (empty($bike->marca) || empty($bike->anio) || empty($bike->color) ||empty($bike->id_tipos_fk)) {
            $this->view->response("Fill the data", 400);
        } else {
            $id = $this->model->insertBike($bike->marca, $bike->anio, $bike->color, $bike->id_tipos_fk);
            $bike = $this->model->getBike($id);
            $this->view->response($bike, 201);
        }
    }

    public function updateBike ($params = null) {
        $user = $this->authHelper->currentUser();
        if(!$user) {
            $this->view->response('Unauthorized', 401);
            return;
            
        }
        $id = $params [':ID'];
        $bike = $this->model->getBike($id);
        $newBike = $this->getData();
        
        if($bike) {
            $this->model->updateBike($newBike->marca, $newBike->anio, $newBike->color,$newBike->id_tipos_fk, $id);
            $this->view->response("The bike was successfully modified.", 200);
        }
        else {
            $this->view->response("The bike with the id $id that you want to modify doesn´t exist", 404);
        }
    }

    public function deleteBike($params = null) {
        $user = $this->authHelper->currentUser();
        if(!$user) {
            $this->view->response('Unauthorized',401);
            return;
            
        }

        $id = $params[':ID'];

        $bike = $this->model->getBike($id);
        if ($bike) {
            $this->model->deleteBike($id);
            $this->view->response("The bike was successfully deleted", 200);
            $this->view->response($bike, 200);
        } 
        else { 
            $this->view->response("The bike with the id $id that you want to delete doesn´t exist", 404);
        }
    }
    public function getFilteredBikes() {
        $color = isset($_GET['color']) ? $_GET['color'] : null;
        $anio = isset($_GET['anio']) ? $_GET['anio'] : null;
        $marca = isset($_GET['marca']) ? $_GET['marca'] : null;

        if (empty($color) && empty($anio) && empty($marca)) {
            $bikes = $this->model->getBikes(10, 0); 
        } else {
            $bikes = $this->model->getFilteredBikes($color, $anio, $marca);
        }
        if (empty($bikes)) {
            $this->view->response(['message' => 'No bikes found with the specified filters.'], 404);
            return;
        }
        
        $this->view->response($bikes, 200);
    }
}