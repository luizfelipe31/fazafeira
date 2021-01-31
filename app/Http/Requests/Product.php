<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class Product extends FormRequest
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
        $inputs['price'] = str_replace(['.', ','], ['','.'], $this->request->all()['price']);
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
            'brand' => 'required',
            'price' => 'required',
            'user' => 'required',
            'stock' => 'required',
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
