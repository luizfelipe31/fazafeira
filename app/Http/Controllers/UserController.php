<?php

namespace App\Http\Controllers;

use App\Http\Requests\User as UserRequest;
use App\Http\Requests\UserAdmin as UserAdmin;
use App\Sale;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request) {
        if(Auth::user()->admin==0){
            return redirect()->route('index');
        }

        $users = User::where('admin',1)->orderBy('name')->simplePaginate('10');

        return view('admin.user', [
            "title" => "Admin | Usuário",
            "users" => $users,
        ]);
    }


    public function home(Request $request)
    {
        $sales = Sale::where("user", Auth::user()->id)->orderBy('created_at','desc')->get();
        $user = User::where("id", Auth::user()->id)->first();

        return view('account', [
            "title" => "Minha Conta",
            "sales" => $sales,
            "user" => $user
        ]);
    }

    public function create()
    {
        if(Auth::user()->admin==0){
            return redirect()->route('index');
        }

        return view('admin.user-new', [
            "title" => "Admin | Usuários",
        ]);
    }

    public function store(UserAdmin $request) {

        if(Auth::user()->admin==0){
            return redirect()->route('index');
        }

        $userCreate = User::create($request->all());

        $userCreate->admin = 1;
        $userCreate->save();

        $request->session()->flash('success', 'Usuário cadastrado com sucesso!');
        return redirect()->route('admin.user.create');
    }

    public function edit($id, Request $request)
    {
        if (Auth::user()->admin == 0) {
            return redirect()->route('index');
        }

        $user = User::where("id", $id)->first();

        if(!$user){
            $request->session()->flash('danger', 'Esse usuário não existe!');
            return redirect()->route('admin.brand');
        }

        return view('admin.user-edit', [
            "title" => "Admin | Editar Usuário",
            "user" => $user
        ]);
    }
    /**
     * @param UserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(UserRequest $requestUser) {


        $userCreate = User::create($requestUser->all());

        $userCreate->status = 1;
        $userCreate->admin = 0;
        $userCreate->save();

        $requestUser->session()->flash('success', 'Cadastro realizado com sucesso, faça login e aproveite nossas ofertas!');
        return redirect()->route('login');

    }

    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->first();

        $user->fill($request->all());

        if(!$user->save()){
            $request->session()->flash('danger', 'Erro ao alterar seus dados!');
            return redirect()->route('user.home');
        }

        $request->session()->flash('success', 'Seus dados foram alterados com sucesso!');
        return redirect()->route('user.home');
    }

    public function updateAdmin(Request $request, $id)
    {
        if (Auth::user()->admin == 0) {
            return redirect()->route('index');
        }

        $user = User::where('id', $id)->first();

        $user->fill($request->all());

        if(!$user->save()){
            $request->session()->flash('danger', 'Erro ao alterar seus dados!');
            return redirect()->route('user.home');
        }

        $request->session()->flash('success', 'Seus dados foram alterados com sucesso!');
        return redirect()->route('admin.user.edit', ['user' => $id]);
    }

    /**
     * @param $id
     */
    public function destroy($id, Request $request)
    {
        if(Auth::user()->admin==0){
            return redirect()->route('index');
        }

        $user = User::where("id", $id)->first();

        if($id==1 && $user->admin==1 ){
            $request->session()->flash('danger', 'Este usuário não pode ser excluído!');
            return redirect()->route('admin.user');
        }

        if(!$user){
            $request->session()->flash('danger', 'Essa usuário não existe!');
            return redirect()->route('admin.user');
        }

        $user->delete();

        $request->session()->flash('success', 'Usuário excluído com sucesso!');
        return redirect()->route('admin.user');
    }
}
