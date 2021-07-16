<?php 
	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;
	use Illuminate\Database\Eloquent\Builder;
	use Illuminate\Database\Eloquent\Factories\HasFactory;

	class MsType extends Model
	{	
		protected $table = 'mstype';
		public $timestamps = false;
		protected $fillable = ['typecd','typenm','typeseq','description','parentid'];

		public function parent()
		{
			return $this->belongsTo(MsType::class, 'parentid');
		}

	}
 ?>