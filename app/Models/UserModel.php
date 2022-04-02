<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class UserModel extends Model{
    protected $table = 'sys_users';
    
    protected $allowedFields = [
        'name',
        'email',
        'password',
        'role',
        'date_created',
        'avatar'
    ];
}