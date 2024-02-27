<?php

namespace App\Models\CustomRules;

class MyCustomRules
{
    public function is_valid_user(int $id):bool
    {
        $model = new UserModel();
        $cliente = $model->find($id);
        return ($cliente == null)? false : true;
    }
}