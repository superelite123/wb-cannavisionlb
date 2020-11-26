<?php

namespace App\Laravue\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerRemote extends Customer
{
    protected $connection = 'mysql2';
    protected $primaryKey = 'client_id';
    public $timestamps = false;
    protected $fillable = [ 'client_id', 'clientname', 'legalname', 'primarycontact', 'companyemail', 'companyphone',
                            'secondaryc_name', 'secondaryc_phone', 'secondaryc_email', 'accounting_name', 'accounting_phone',
                            'accounting_email', 'fax', 'deliveryc', 'deliverye', 'deliveryp', 'deliveryday', 'salesrep', 
                            'accountmanager', 'address1', 'address2', 'city', 'county', 'state', 'zip', 'resale', 'licensenumber', 'companylic', 'licensetype',
                            'licensevalid', 'licenseexpire', 'licenseul', 'sellers_permit', 'website', 'ein', 'terms', 'status', 'servicezone', 'tags', 'notes'];
}
