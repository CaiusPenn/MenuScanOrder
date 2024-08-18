<?php

namespace App\Models; 

use CodeIgniter\Model; 

class ItemModel extends Model 
{
    protected $table = 'item'; 
    protected $primaryKey = 'id'; 
    protected $allowedFields = ['category_id', 'menu_id', 'item_name', 'category_name', 'description', 'price']; 
    protected $returnType = 'array'; 
}