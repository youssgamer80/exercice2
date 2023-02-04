<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Email
 *
 * @property int $id
 * @property string $nom
 * @property string $email
 * @property string $sujet
 * @property string $message
 * @property string $deleted_at
 *
 * @package App\Models
 */
class Email extends Model
{
	use SoftDeletes;
	protected $table = 'emails';
	public $timestamps = false;

	protected $fillable = [
		'nom',
        'email',
		'sujet',
		'message'
	];
}