<?php

namespace App\Models; 

use CodeIgniter\Model; 

class OrderModel extends Model 
{
    protected $table = 'orders'; 
    protected $primaryKey = 'id'; 
    protected $allowedFields = ['menu_id', 'table_number', 'is_complete', 'order_date', 'archived']; 
    protected $returnType = 'array'; 
}