<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class Brand extends FormRequest
{
    /**
     * @param null $keys
     * @return array
     */
    public function all($keys = null)
    {
        return $this->validateFields(parent::all());
    }

    /**
     * @param array $inputs
     * @return array
     */
    public function validateFields(array $inputs)
    {
        $inputs['status']  = (!empty($this->request->all()['status']) ? $this->request->all()['status'] : 0);
        return $inputs;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:191',
            'status' => 'required',

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
