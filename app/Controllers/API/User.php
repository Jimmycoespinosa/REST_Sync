<?php

namespace App\Controllers\API;
use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class User extends ResourceController
{
    //JE- MANEJO DE SESIONES
    public $session=null;//Es mejor práctica definirlo en BaseController.

    public function __construct(){
        $this->model = $this->setModel(new UserModel());
    }

    public function index(){
        $users = $this->model->findAll();
        return $this->respond($users);
    }

    // http://localhost/REST_Sync/api/user/create -> POSTMAN -> POST, Body: raw, JSON.
    // {
    //     "name": "Gustavo Uribe",
    //     "email": "gusuribe@gmail.com",
    // }
    public function create(){
        try{
            $user = $this->request->getJSON();
            if($this->model->insert($user)){
                $user->Id = $this->model->insertID();
                return $this->respondCreated($user);
            }else{
                return $this->failValidationError($this->model->validation->listErrors());
            }
        }catch(\Exception $err){
            return $this->failServerError('Error en el servidor.');
        }
    }

    // http://localhost/REST_Sync/api/user/create -> POSTMAN -> GET, Body: none.
    public function search($id = null){
        try{
            if($id == null){
                return $this->failValidationError('No se recibió un identificador válido.');
            }
            $user = $this->model->find($id);
            if($user == null){
                return $this->failNotFound('No se encontró el usuario.');
            }
            return $this->respond($user);
        }
        catch(\Exception $err){
            return $this->failServerError('Error en el servidor.');
        }
    }

    // http://localhost/REST_Sync/api/user/update/6 -> POSTMAN -> PUT, Body: raw, JSON.
    // {
    //     "name": "Andrea Espinosa",
    //     "email": "andrea@hotmail.com"
    // }
    public function update($id = null){
        try{
            if($id == null){
                return $this->failValidationError('No se recibió un identificador válido.');
            }
            $validUser = $this->model->find($id);
            if($validUser == null){
                return $this->failNotFound('No se encontró el usuario.');
            }

            $user = $this->request->getJSON();
            if($this->model->update($id, $user)){
                $user->Id = $id;
                return $this->respondUpdated($user);
            }else{
                return $this->failValidationError($this->model->validation->listErrors());
            };
        }
        catch(\Exception $err){
            return $this->failServerError('Error en el servidor.');
        }
    }

    // http://localhost/REST_Sync/api/user/delete/20 -> POSTMAN -> DELETE, Body: none, JSON.
    public function delete($id = null){
        try{
            if($id == null){
                return $this->failValidationError('No se recibió un identificador válido.');
            }
            $validUser = $this->model->find($id);
            if($validUser == null){
                return $this->failNotFound('No se encontró el usuario.');
            }

            if($this->model->delete($id)){
                return $this->respondDeleted($validUser);
            }else{
                return $this->failServerError('No fue posible eliminar el registro.');
            };
        }
        catch(\Exception $err){
            return $this->failServerError('Error en el servidor.');
        }
    }
}
