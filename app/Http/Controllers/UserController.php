<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserChargue;
use App\Models\Domain;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function validateAuth(Request $request)
    {
        $data = $request->all();
        $message = "Credenciales invalidas";
        if($data){
            $data = (object) $data;
            $user = User::where([
                "identification" => $data->identification,
                "password" => MD5($data->password)
            ])->first();
            if($user){
                session([
                    'id_user' => $user->id,
                    'id_user_type' => $user->id_domain_user_type,
                    'admin' => true
                ]);
                return redirect()->route('user/list');
            }
        }else{
            $message = "Ocurrio un error, intente nuevamente";
        }
        
        session()->flash('message_login', $message);
        return view("auth.login");
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect("/");
    }

    public function all()
    {
        $users = User::where('id_domain_user_type', 3)->get();
        return view('user.list', compact('users'));
    }

    public function create(Request $request)
    {
        DB::beginTransaction();
        $data = $request->all();
        $chargues = Domain::where('id_father', 4)->get();
        $message = "";
        $save_all = false;
        try {
            if($data){
                $model = new User;
                $model->fill($data);
                $model->id_domain_user_type = 3;
                $save = $model->save();
                if($save){
                    foreach ($data['chargues'] as $item) {
                        $chargue = new UserChargue;
                        $chargue->id_user = $model->id;
                        $chargue->id_domain_chargue = $item;
                        $save_chargue = $chargue->save();
                        if($save_chargue){
                            $save_all = true;
                        }else{
                            DB::rollback();
                            break;
                        }
                    }

                    if($save_all){
                        DB::commit();
                        $message = "Usuario guardado correctamente";
                        session()->flash('message_success_user_create', $message);
                    }else{
                        $message = "Ocurrio un error, intente nuevamente";
                        session()->flash('message_error_user_create', $message);
                    } 
                    return redirect()->route('user/list');
                }else{
                    $message = "Ocurrio un error, intente nuevamente";
                    DB::rollback();
                }
            }
        } catch (\Throwable $th) {
            DB::rollback();
        }

        session()->flash('message_error_user_create', $message);
        return view('user.create', compact('chargues'));
    }

    public function edit(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $user = User::find($id);
            $chargues = Domain::where('id_father', 4)->get();
            $data = $request->all();
            $message = "Ocurrio un error, intente nuevamente";
            $update_all = false;
            if($data){
                foreach ($user->chargues as $item) {
                    $item->delete();
                }
                $user->fill($data);
                $update = $user->update();
                if($update){
                    foreach ($data['chargues'] as $item) {
                        $chargue = new UserChargue;
                        $chargue->id_user = $user->id;
                        $chargue->id_domain_chargue = $item;
                        $save_chargue = $chargue->save();
                        if($save_chargue){
                            $update_all = true;
                        }else{
                            DB::rollback();
                            break;
                        }
                    }

                    if($update_all){
                        DB::commit();
                        $message = "Usuario actualizado correctamente";
                        session()->flash('message_success_user_edit', $message);
                    }else{
                        DB::rollback();
                        session()->flash('message_error_user_edit', $message);
                    } 
                    return redirect()->route('user/list');
                }else{
                    DB::rollback();
                }
            }
        } catch (\Throwable $th) {
            session()->flash('message_error_user_edit', $message);
            DB::rollback();
        }
        
        session()->flash('message_error_user_edit', $message);
        return view('user.edit', compact(['user', 'chargues']));
    }

    public function delete($id)
    {
        $user = User::find($id);
        $message = "Ocurrió un error";
        $error = true;
        if($user){
            foreach ($user->chargues as $item) {
                $item->delete();
            }
            $delete = $user->delete();
            if($delete) {
                $message = "Usuario eliminado correctamente";
                $error = false;
            }
        }else{
            $message = "Este usuario no existe";
        }

        return response()->json([
            "message" => $message
        ]);
    }

    public function getListCollaborators($id)
    {
        $list = User::where('id_domain_user_type', '<>', 2)
                    ->where('id', '<>', $id)
                    ->get();
        
        return response()->json($list);
    }

    public function saveColaborator($id_user, $id_user_collaborator)
    {
        $message = "";
        $error = true;
        $user = User::find($id_user);
        $user->id_user_collaborator = $id_user_collaborator;
        $update = $user->update();
        if($update){
            $message = "Colaborador asignado correctamente";
            $error = false;
        }
        
        return response()->json([
            "error" => $error,
            "message" => $message
        ]);
    }
}
