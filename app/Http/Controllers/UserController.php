<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller{

    public function __invoke(Request $request){

        $filter = $request->input('filter');
    
        $user = User::where('name','like',"%$filter%")->orWhere('email','like',"$$filter$")->get();

        return  response()->json($user,200);

    }

    public function find(int $id){

        return  response()->json(User::find($id),200);

    }


    public function store(Request $request){

        //Função para validar os valores do request
        $validator = Validator::make($request->all(),
        [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'password_verify' => 'required',
        ],
        [
            'name.required' => 'Preencha o campo Nome.',
            'email.required' => 'Preencha o campo Email.',
            'password.required' => 'Preencha o campo Senha.',
            'password_verify.required' => 'Preencha o campo Confirmar Senha.',
            'email' => 'Preencha um e-mail válido.',
            'unique' => 'Email já cadastrado.',
        ]);

        //Validação dos daodos, se tiver algum dado errado ele reotrna.
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if($request->password_verify != $request->password){
            return response()->json(['errors' => ['password'=>'Senhas diferentes.']], 422);
        }

        // Pega a senha digitada e passa para md5.
        $request->merge(['password' => md5($request->password)]);
        
        User::create($request->all());

        return  response()->json(['msg' => 'Usuário cadastrado com sucesso.'],201);

    }

    public function update(Request $request, int $id){

         //Função para validar os valores do request
         $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        //Validação dos daodos, se tiver algum dado errado ele reotrna.
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if($request->password_verify != $request->password){
            return response()->json(['errors' => ['password'=>'Senhas diferentes.']], 422);
        }

        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;

        if($request->has('password')){
            $user->password = md5($request->password);
        }
        
        try{
            $user->save();
        }catch(Exception $e){
            return response()->json(['errors' => ['Erro' => $e->getMessage()]], 422);
        }

        return  response()->json(['msg' => 'Usuário atualizado com sucesso.'],200);

    }

    public function delete(int $id){

        User::findOrFail($id)->delete();

        return  response()->json(['msg' => 'Usuário excluído com sucesso.'],200);

    }

}
