<?php

namespace App\Http\Controllers;

use App\Models\Collaborator;
use App\Models\Company;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CollaboratorController extends Controller
{
    public function __construct()
    {
        $this->middleware('man')->only('destroy');
        $this->middleware('user')->except('index', 'search');
        $this->middleware('auth');
    }

    public function search(Request $request)
    {
        $collaborators = Collaborator::select("*");
        try {
            $company_id = Company::where('name', $request->search_cname)->firstOrFail()->id;
        } catch (ModelNotFoundException $e) {
            $company_id = 0;
        }
        if ($request->search_lname) {
            $collaborators = $collaborators->where('lastname', $request->search_lname);
        }
        if ($request->search_fname) {
            $collaborators = $collaborators->where('firstname', $request->search_fname);
        }
        if ($request->search_cname) {
            $collaborators = $collaborators->where('comapny_id', $company_id);
        }
        if ($request->phone) {
            $collaborators = $collaborators->where('col_phone', $request->search_phone);
        }
        if ($request->search_mail) {
            $collaborators = $collaborators->where('email', $request->search_mail);
        }
        
        return view('collaborator.index', ['collaborators' => $collaborators->paginate(2)->withQueryString()]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('collaborator.index', ['collaborators' => Collaborator::paginate(2)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('collaborator.create', ['companies' => Company::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'lastname' => 'required', 'firstname' => 'required', 'street' => 'required',
            'code' => 'required|max:5|regex:/^[0-9]+$/i', 'city' => 'required',
            'phone' => 'unique:collaborators,col_phone|regex:/^\+336[0-9]{8}$/i',
            'email' => 'unique:collaborators,col_email|email', 'company_name' => 'required'
        ]);

        $company_id = Company::where(['name' => $request->company_name])
            ->get()[0]->id;
        Collaborator::create([
            'civility' => $request->civility, 'lastname' => $request->lastname,
            'firstname' => $request->firstname, 'col_street' => $request->street,
            'col_code' => $request->code, 'col_city' => $request->city,
            'col_phone' => $request->phone, 'col_email' => $request->email,
            'company_id' => $company_id,
        ]);

        return redirect(route('collaborator_index'))->with('success', 'Collaborator created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $collaborator = Collaborator::find($id);
        $company = Company::find($collaborator->company_id);
        return view('collaborator.edit', [
            'collaborator' => Collaborator::find($id), 'company' => $company,
            'companies' => Company::all()->where('name', '!=', $company->name)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $collaborator = Collaborator::find($id);
        
        $validated = $request->validate([
            'lastname' => "required", 'firstname' => 'required',
            'col_street' => 'required', 'col_code' => 'required|max:5|regex:/^[0-9]+$/i',
            'col_city' => 'required', 'col_phone' => "exclude_if:col_phone,$collaborator->col_phone|unique:collaborators|regex:/^\+336[0-9]{8}$/i",
            'col_email' => "exclude_if:col_email,$collaborator->col_email|required|unique:collaborators|email",
            'company_id' => 'required',
        ]);
        $collaborator->update($request->all());
        return redirect(route('collaborator_index'))->with('success', 'Collaborator updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $toDelete = Collaborator::find($id);
        $toDelete->delete();
        return redirect(route('collaborator_index'))->with('success', 'Collaborator deleted successfully');
    }
}
