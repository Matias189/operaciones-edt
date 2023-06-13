<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Petition;
use App\Status;
Use Auth;
use Session;
Use Hash;

Use DB;


class UserController extends Controller
{
    public function account()
    {
        // Perfil departamentos

        return view('user.account');
    }

    public function password(){

        // Formularo cambiar contraseña departamentos

        return view('user.password');
    }

    
    public function changePassword(Request $request){

        // Cambiar contraseña departamentos

        $request->validate([
            'old_password'=>'required|min:6|max:15',
            'new_password'=>'required|min:6|max:15',
            'confirm_password'=>'required|same:new_password'
            ]);
    
            $current_user=auth()->user();
    
            if(Hash::check($request->old_password,$current_user->password)){
    
                $current_user->update([
                    'password'=>bcrypt($request->new_password)
                ]);
                
                Session::flash('successAlert', 'success');
                return redirect()->back();
    
            }else{
                Session::flash('errorAlert', 'error');
                return redirect()->back();
            }
    }



    public function adminAccount()
    {
        // Perfil Operaciones

        $petitions2= Petition::where('status_id','2')->count();
        $petitions3= Petition::where('status_id','3')->count();
        $petitions4= Petition::where('status_id','4')->count();
        $petitions5= Petition::where('status_id','5')->count();


        $estadosRequerimiento= DB::table('petitions')
            ->select('statuses.name as statusName')
            ->selectRaw('status_id, COUNT(*) AS numeroRequerimientos' )
            ->join('statuses','statuses.id', '=', 'petitions.status_id') 
            ->where('status_id', '<>', 1)
            ->groupBy('status_id')
            ->get();
        //dd($estadosRequerimiento);
        
        $data=[];

        foreach ($estadosRequerimiento as $petition){
            $data['label'][] = $petition->statusName;
            $data['data'][] = $petition->numeroRequerimientos;
        }
        
        
        $data['data']= json_encode($data);

        return view('admin.account', $data, compact('petitions2','petitions3','petitions4','petitions5'));
    }


    public function passwordAdmin()
    {

        // Cambiar contraseña Operaciones

        return view('admin.password');
    }

    
    public function changePasswordAdmin(Request $request){

        // Cambiar contraseña departamentos

        $request->validate([
            'old_password'=>'required|min:6|max:15',
            'new_password'=>'required|min:6|max:15',
            'confirm_password'=>'required|same:new_password'
            ]);
    
            $current_user=auth()->user();
    
            if(Hash::check($request->old_password,$current_user->password)){
    
                $current_user->update([
                    'password'=>bcrypt($request->new_password)
                ]);

                Session::flash('successAlert', 'success');
                return redirect()->back();
    
            }else{
                Session::flash('errorAlert', 'error');
                return redirect()->back();
            }
    }

    public function prueba()
    {

        // pruebas

        return view('admin.prueba');
    }
}
