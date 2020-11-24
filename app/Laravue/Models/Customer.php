<?php

namespace App\Laravue\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [ 'id', 'name', 'legalname', 'primarycontact', 'companyemail', 'companyphone',
                            'secondaryc_name', 'secondaryc_phone', 'secondaryc_email', 'accounting_name', 'accounting_phone',
                            'accounting_email', 'fax', 'deliveryc', 'deliverye', 'deliveryp', 'deliveryday', 'salesrep', 
                            'accountmanager', 'address1', 'address2', 'city', 'county', 'state', 'zip', 'resale', 'licensenumber', 'companylic', 'licensetype',
                            'licensevalid', 'licenseexpire', 'licenseul', 'sellers_permit', 'website', 'ein', 'terms', 'status', 'servicezone', 'tags', 'notes'];
    //
    public function rContactPerson()
    {
        return $this->belongsTo(ContactPerson::class,'salesrep');
    }
    public function rLicenseType()
    {
        return $this->belongsTo(LicenseType::class,'terms');
    }
    public function rState()
    {
        return $this->belongsTo(State::class,'terms');
    }
    public function rTerm()
    {
        return $this->belongsTo(Term::class,'terms');
    }
    public function rDayOfWeek()
    {
        return $this->belongsTo(DayOfWeek::class,'terms');
    }
    public function rStatus()
    {
        return $this->belongsTo(Status::class,'terms');
    }
    public function rAccountManager()
    {
        return $this->belongsTo(ContactPerson::class,'accountmanager');
    }
}
