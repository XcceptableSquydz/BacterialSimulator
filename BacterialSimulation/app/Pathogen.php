<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pathogen extends Model
{
	protected $fillable = [
   		'pathogen_name', 'desc_link', 'image', 'formula', 'infectious_dose'
   	];
   	public $timestamps = false;
   	protected $table = 'pathogen';
}
