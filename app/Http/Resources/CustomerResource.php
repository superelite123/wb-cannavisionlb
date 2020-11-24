<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $original = parent::toArray($request);
        //contactPerson
        $original['rContactPerson'] = ['id' => -1, 'firstname' => '', 'lastname' => ''];
        if($this->rContactPerson != null)
        {
            $original['rContactPerson']['id'] = $this->rContactPerson->contact_id;
            $original['rContactPerson']['firstname'] = $this->rContactPerson->firstname;
            $original['rContactPerson']['lastname'] = $this->rContactPerson->lastname;
        }
        //rDayOfWeek
        $original['rDayOfWeek'] = ['id' => -1, 'name' => ''];
        if($this->rDayOfWeek != null)
        {
            $original['rDayOfWeek']['id'] = $this->rDayOfWeek->id;
            $original['rDayOfWeek']['name'] = $this->rDayOfWeek->day;
        }
        //rLicenseType
        $original['rLicenseType'] = ['id' => -1, 'name' => ''];
        if($this->rLicenseType != null)
        {
            $original['rLicenseType']['id'] = $this->rLicenseType->type_id;
            $original['rLicenseType']['name'] = $this->rLicenseType->name;
        }
        //rState
        $original['rState'] = ['id' => -1, 'name' => ''];
        if($this->rState != null)
        {
            $original['rState']['id'] = $this->rState->state_id;
            $original['rState']['name'] = $this->rState->abbr;
        }
        //rStatus
        $original['rStatus'] = ['id' => -1, 'name' => ''];
        if($this->rStatus != null)
        {
            $original['rStatus']['id'] = $this->rStatus->status_id;
            $original['rStatus']['name'] = $this->rStatus->status;
        }
        //rTerm
        $original['rTerm'] = ['id' => -1, 'name' => ''];
        if($this->rTerm != null)
        {
            $original['rTerm']['id'] = $this->rTerm->term_id;
            $original['rTerm']['name'] = $this->rTerm->term;
        }
        //rAccountManager
        $original['rAccountManager'] = ['id' => -1, 'name' => ''];
        if($this->rAccountManager != null)
        {
            $original['rAccountManager']['id'] = $this->rAccountManager->contact_id;
            $original['rAccountManager']['name'] = $this->rAccountManager->firstname.','.$this->rAccountManager->lastname;
        }
        $original['salesrep'] = (int)$original['salesrep'];
        $original['accountmanager'] = (int)$original['accountmanager'];
        $original['licensetype'] = (int)$original['licensetype'];
        
        return $original;
    }
}
