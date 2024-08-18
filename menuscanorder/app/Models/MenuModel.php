<?php

namespace App\Models; 

use CodeIgniter\Model; 

class MenuModel extends Model 
{
    protected $table = 'menus'; 
    protected $primaryKey = 'id'; 
    protected $allowedFields = ['user_id', 'menu_name', 'description', 'created_at']; 
    protected $returnType = 'array'; 
}