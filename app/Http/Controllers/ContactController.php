<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Requests\Contact as ContactRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index() {

        return view('contact-us', [
            "title" => "Fale Conosco"
        ]);
    }

    /**
     * @param ContactRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ContactRequest $request) {

        Contact::create($request->all());

        $request->session()->flash('success', 'Sua mensagem foi enviada com sucesso, em breve entraremos em contato!');
        return redirect()->route('contact');
    }

    public function menssage(){

        if(Auth::user()->admin==0){
            return redirect()->route('index');
        }

        $contacts = Contact::orderBy('created_at','desc')->simplePaginate('10');

        return view('admin.menssage-contact', [
            "title" => "Admin | Mensagens",
            "contacts" => $contacts
        ]);
    }
}
