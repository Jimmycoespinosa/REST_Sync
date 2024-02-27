<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;//Elimina permanente = true
    protected $allowedFields = ['name', 'email'];//Campos permitidos: Si no está no se toca.

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        // Ejemplo de reglas incluidas en el modelo "Models\CustomRules\MyCustomRules" ->Requiere Config\Validation.php\ruleSets.
        //'id' => 'required|integer|is_valid_user,
        'name' => 'required|alpha_numeric_space|min_length[3]',
        'email' => 'required|valid_email|is_unique[users.email]'
    ];
    protected $validationMessages   = [
        'email' => [
            'is_unique'=> 'Lo sentimos. Tu correo ya está siendo usado por otro usuario'
        ]
    ];
    protected $skipValidation       = false;//Debe estar en false para que cumpla validaciones.
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];//['AgregaAlgoName'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];//['AgregaAlgoName'];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    //Gatillos: Cambios en datos antes de realizar el cambio por BD.    
    protected function AgregaAlgoName(array $data){
        $data['data']['name']=$data['data']['name']." Algo";
        return $data;
    }
}