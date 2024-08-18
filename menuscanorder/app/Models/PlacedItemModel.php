<?php

namespace App\Models; 

use CodeIgniter\Model; 

class PlacedItemModel extends Model 
{
    protected $table = 'placed_item'; 
    protected $primaryKey = 'id'; 
    protected $allowedFields = ['order_id', 'item_id']; 
    protected $returnType = 'array'; 
}