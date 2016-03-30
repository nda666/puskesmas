<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RawatJalanFormRequest extends Request
{
   /**
    * Determine if the user is authorized to make this request.
    *
    * @return bool
    */
   public function authorize()
   {
      return true;
   }

   /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */
   public function rules()
   {
      return [
         'pasien_id'   => 'required|exists:pasien,id',
         'kepesertaan' => 'required|in:BPJS / Umum,Lain - Lain,ASKES,BUMIL,ASPRAS'
      ];
   }
}
