<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParcelsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name_sender"       => ['string', 'required', 'max:255'],
            "phone_sender"      => ['string', 'required'],
            "name_recipient"    => ['string', 'required', 'max:255'],
            "phone_recipient"   => ['string', 'required', 'max:255'],
            "width"             => ['integer', 'min:0', 'required'],
            "height"            => ['integer', 'min:0', 'required'],
            "depth"             => ['integer', 'min:0', 'required'],
            "id_deliveries"     => ['integer', 'min:0', 'required'],
            "description"       => ['string']
        ];
    }
}
