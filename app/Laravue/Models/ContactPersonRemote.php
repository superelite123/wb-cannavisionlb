<?php

namespace App\Laravue\Models;

use Illuminate\Database\Eloquent\Model;

class ContactPersonRemote extends ContactPerson
{
    protected $connection = 'mysql2';
    protected $table = 'contactperson';
    protected $primaryKey = 'contact_id';

}
