<?php

namespace App\Laravue\Models;

use Illuminate\Database\Eloquent\Model;

class ContactPerson extends Model
{
    protected $table = 'contactperson';
    protected $primaryKey = 'contact_id';
    protected $fillable = [ 'firstname','lastname','telephone','email','address1','address2','city','state',
                            'zip','contacttype','uppermanage','region'];
    protected $attributes = [
        'telephone' => ' ',
        'email' => ' ',
        'address1' => ' ',
        'address2' => ' ',
        'city' => ' ',
        'state' => ' ',
        'zip' => ' ',
        'contacttype' => ' ',
        'uppermanage' => ' ',
    ];
    public $timestamps = false;
    public function rState()
    {
        return $this->belongsTo(State::class, 'terms');
    }

    public function rContactType()
    {
        return $this->belongsTo(ContactType::class, 'contacttype');
    }
}
