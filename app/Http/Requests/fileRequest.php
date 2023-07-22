<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class fileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        $shareType = $this->input('shareType');
        $rules=[
            'shareType' => 'required|in:1,2',
            'files' => 'required|array|min:1',
            'files.*' => 'file|mimes:pdf,doc,docx,jpeg,png',
        ];

       
        if ($shareType == '1') {
            $rules = array_merge(  $rules, [
                'senderEmail' => 'required|email',
                'receiverEmail' => 'required|email',
            ]);
        } 

        return  $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'image.required' => 'Choisissez un fichier à uploader !',
            'image.max' => 'Le fichier est trop volumineux !',
            'mail_from.required' => 'Votre E-mail est obligatoire !',
            'mail_from.email' => 'L\'E-mail renseignée est invalide !',
            'mail_to.required'  => 'L\'E-mail du destinataire est obligatoire !',
            'mail_to.email' => 'L\'E-mail renseignée est invalide !'
        ];
    }
}
