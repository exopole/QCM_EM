<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class Post extends Model
{

	protected $fillable=[
		'title',
		'status',
		'abstract',
		'content',
		'user_id',
		'date',
	];

	protected $dates = [
	        'date',
	        'updated_at',
	        'deleted_at'
	    ];

 /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // permet d'organiser les posts selon leur date de parution en mode décroissant
        static::addGlobalScope('date', function (Builder $builder) {
            $builder->orderBy('date', 'DESC');
        });
    }

	public function comments(){
		return $this->belongsToMany('App\Comment');
	}

	public function user(){
		return $this->belongsTo('App\User');
	}

	public function setToPublished(){
		$this->attributes['status'] = "published";
	}
	public function setToUnpublished(){
		$this->attributes['status'] = "unpublished";
	}

	public function getDateAttribute()
    {
        return Carbon::parse($this->attributes['date'])->format('d m Y');
    }

}
