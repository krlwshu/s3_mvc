<?php

namespace App\Models;

use CodeIgniter\Model;

class Test extends Model
{
	protected $table = 'app_temp_questions';

	protected $primaryKey = 'id';

	protected $allowedFields = ['question', 'question_type'];

}

?>