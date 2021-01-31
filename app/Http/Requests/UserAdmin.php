<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class UserAdmin extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */


    public function all($keys = null)
    {
        return $this->validateFields(parent::all());
    }

    public function validateFields(array $inputs)
    {
        $inputs['status']  = (!empty($this->request->all()['status']) ? $this->request->all()['status'] : 0);
        $inputs['document'] = str_replace(['.', '-'], '', $this->request->all()['document']);
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
            'document' => (!empty($this->request->all()['id']) ? 'required|min:11|max:14|unique:users,document,' . $this->request->all()['id'] : 'required|min:11|max:14|unique:users,document'),
            // Access
            'email' => (!empty($this->request->all()['id']) ? 'required|email|unique:users,email,' . $this->request->all()['id'] : 'required|email|unique:users,email'),

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
