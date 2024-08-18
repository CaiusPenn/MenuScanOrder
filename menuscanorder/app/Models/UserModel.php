<?php

namespace App\Models; 

use CodeIgniter\Model; 

class UserModel extends Model 
{
    protected $table = 'users'; 
    protected $primaryKey = 'id'; 
    protected $allowedFields = ['username', 'email', 'password_hash', 'num_tables', 'created_at']; 
    protected $returnType = 'array'; 
}