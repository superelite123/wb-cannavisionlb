<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactPersonResource extends JsonResource
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
        //rState
        $original['rState'] = ['id' => -1, 'name' => ''];
        if($this->rState != null)
        {
            $original['rState']['id'] = $this->rState->state_id;
            $original['rState']['name'] = $this->rState->abbr;
        }
        //rContactType
        $original['rContactType'] = ['id' => -1, 'name' => ''];
        if($this->rContactType != null)
        {
            $original['rContactType']['id'] = $this->rContactType->ct_id;
            $original['rContactType']['name'] = $this->rContactType->type;
        }
        if($this->uppermanage == 0)
        {
            $original['rUpperManage'] = 'No';
        }
        if($this->uppermanage == 1)
        {
            $original['rUpperManage'] = 'Yes';
        }
        
        return $original;
    }
}
