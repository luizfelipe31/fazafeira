<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;


class Contact extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:191',
            'email' => 'required|email|min:3|max:191',
            'subject' => 'required|min:3|max:191',
            'message' => 'required',

        ];
    }

    /**
     * @return \Illuminate\Session\Store|\Symfony\Component\HttpFoundation\Session\SessionInterface
     */
    public function session()
    {
        if (! $this->hasSession()) {
            throw new RuntimeException('Session store not set on request.');
        }

        return $this->session;
    }
}
