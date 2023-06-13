<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Department;
use App\Petition;  
use App\Priority;
use App\Status;
use App\User;
use Carbon\Carbon;

use Auth;
use Session;


class FormController extends Controller
{
    
    public function index()
    {
        $petitions = Petition::where('department_id',Auth::user()->department_id)->get();    
        $category=Category::pluck('name','id');
        $priority=Priority::pluck('name','id');
        $status=Status::pluck('name','id');
        $department=Department::pluck('name','id');
        
        return view('departamento.index', compact('petitions','category','priority','status')); 
    }

    
    public function create()
    {
        // Llamar categorías al formulario

        $categorys = Category::all();    
        return view('departamento.create', compact('categorys'));
    }

    
    public function store(Request $request)
    {

        $request->validate([
            'category_id' => 'required',
            'description'=> 'required | max:255',
            'fixedlocation'=> 'max:150',
            'startinglocation'=> 'max:150',
            'endlocation'=> 'max:150'
        ]);

        $petitions= new Petition();

        $petitions->name = Auth::user()->name; // tomar nombre
        $petitions->email = Auth::user()->email; // tomar email

        $petitions->phone = $request->get('phone');  
        $petitions->category_id = $request->get('category_id');  
        $petitions->date = Carbon::now();
        $petitions->description = $request->get('description');   
        $petitions->scheduledate = $request->get('scheduledate');
        $petitions->time = $request->get('time');
        $petitions->fixedlocation = $request->get('fixedlocation');
        $petitions->startinglocation = $request->get('startinglocation');
        $petitions->endlocation = $request->get('endlocation');

        $petitions->latitude = $request->get('latitude');
        $petitions->longitude = $request->get('longitude');

        $petitions->department_id = Auth::user()->department_id; // tomar departamento
          
        $petitions->status_id = 1; 

        if ($request->hasFile('file')){
            $file=$request->file('file');
            $file->move(public_path().'/Files/', $file->getClientOriginalName()); 
            $petitions->file=$file->getClientOriginalName();
        }

        $petitions->save();
        
        Session::flash('formAlert', 'formStore');
        return redirect('/departamento');
    }

    
    public function show($id)
    {
        $petition=Petition::find($id);
        $category=Category::pluck('name','id');
        $priority=Priority::pluck('name','id');
        $status=Status::pluck('name','id');
        $department=Department::pluck('name','id');

        return view('departamento.show', compact('petition','category','priority','status','department'));
    }

    
    public function edit($id)
    {
        $petition=Petition::find($id);
        $categorys = Category::all(); 
        return view('departamento.edit', compact('petition','categorys'));
    }

    
    public function update(Request $request, $id)
    {
        // Update para editar solicitud

        $petition=Petition::find($id);

        $petition->phone = $request->get('phone');  
        $petition->category_id = $request->get('category_id');  
        $petition->description = $request->get('description');   
        $petition->scheduledate = $request->get('scheduledate');
        $petition->time = $request->get('time');
        $petition->fixedlocation = $request->get('fixedlocation');
        $petition->startinglocation = $request->get('startinglocation');
        $petition->endlocation = $request->get('endlocation');

        $petition->latitude = $request->get('latitude');
        $petition->longitude = $request->get('longitude');

        if ($request->hasFile('file')){
            $file=$request->file('file');
            $file->move(public_path().'/Files/', $file->getClientOriginalName()); 
            $petition->file=$file->getClientOriginalName();
        }

        $petition->save();
        
        return redirect('/departamento');
    }
    


    public function sendForm(Request $request, $id)
    {
        // Enviar solicitud

        $petition=Petition::find($id);

        $petition->status_id = 2;

        $petition->save();

        Session::flash('sendAlert', 'send');
        return redirect('/departamento');
    }

    
    public function destroy($id)
    {
        //
    }
}
