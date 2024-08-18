<?php

namespace App\Models; 

use CodeIgniter\Model; 

class UserRolesModel extends Model 
{
    protected $table = 'user_roles'; 
    protected $primaryKey = 'id'; 
    protected $allowedFields = ['user_id', 'role_id', 'created_at']; 
    protected $returnType = 'array'; 
}