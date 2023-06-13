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

Use Auth;
use Session;

class PetitionController extends Controller
{
    
    public function index()
    {
        //$petitions = Petition::orderBy('id', 'desc')->get();
        $petitions = Petition::all();   
        $category=Category::pluck('name','id');
        $priority=Priority::pluck('name','id');
        $status=Status::pluck('name','id');
        
        return view('operaciones.index', compact('petitions','category','priority','status')); 

    }

    
    public function create()
    {
        // Llamar a todas las categorías y departamentos al formulario

        $categorys = Category::all();    
        $departments = Department::all(); 

        return view('operaciones.create', compact('categorys','departments'));
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

        $petitions->name = $request->get('name'); 
        $petitions->email = $request->get('email'); 
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
        $petitions->department_id = $request->get('department_id');
        $petitions->note = 'Requerimiento ingresado por Operaciones'; 
        
        $petitions->status_id = 2; 

        if ($request->hasFile('file')){
            $file=$request->file('file');
            $file->move(public_path().'/Files/', $file->getClientOriginalName()); 
            $petitions->file=$file->getClientOriginalName();
        }

        $petitions->save();
        
        Session::flash('petitionAlert', 'petitionStore');
        return redirect('/operaciones');

    }
    

    
    public function show($id)
    {
    
        $petition=Petition::find($id);
        $category=Category::pluck('name','id');
        $priority=Priority::pluck('name','id');
        $status=Status::pluck('name','id');
        $department=Department::pluck('name','id');

        return view('operaciones.show', compact('petition','category','priority','status','department'));
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        // Rechazar requerimiento

        $petition=Petition::find($id);

        $petition->rejectionreason = $request->get('rejectionreason'); 
        $petition->status_id = 4;

        $petition->save();

        Session::flash('rejectAlert', 'reject');
        return redirect('/operaciones');
    }


    public function approve(Request $request, $id)
    {
        // Aprobar requerimiento
        
        $petition=Petition::find($id);
        $petition->status_id = 3;
        $petition->rejectionreason = null;

        $petition->save();

        Session::flash('approveAlert', 'approve');
        return redirect('/operaciones');

    }

    public function resolution(Request $request, $id)
    {
        // Completar requerimiento

        $petition=Petition::find($id);

        if ($request->hasFile('evidence')){
            $evidence=$request->file('evidence');
            $evidence->move(public_path().'/Evidence/', $evidence->getClientOriginalName()); 
            $petition->evidence=$evidence->getClientOriginalName();
        }

        $petition->executiondate = $request->get('executiondate'); 
        $petition->resolution = $request->get('resolution'); 
        $petition->status_id = 5;

        $petition->save();

        Session::flash('completeAlert', 'complete');
        return redirect('/operaciones');
    }

    
    public function destroy($id)
    {
        //
    }
}
