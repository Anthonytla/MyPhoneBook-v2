<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('man')->only('destroy');
        $this->middleware('user')->except('show', 'index', 'search');
        $this->middleware('auth');
    }

    public function search(Request $request)
    {
        $companies = Company::select('*');
        /*if ($request->search_name || $request->search_city || $request->search_mail)
            $companies = $companies->orWhere('name', $request->search_name)
                ->orWhere('city', $request->search_city)->orWhere('email', $request->search_mail);*/
        if ($request->search_name)
            $companies = $companies->where('name', $request->search_name);
        if ($request->search_city)
            $companies = $companies->where('city', $request->search_city);
        if ($request->search_mail)
            $companies = $companies->where('email', $request->search_mail);

        return view('company.index', ['companies' => $companies->paginate(2)->withQueryString()]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('company.index', ['companies' => Company::paginate(2), 'collaborators' => Company::with('collaborators')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
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
            'name' => 'required|unique:companies',
            'street' => 'required', 'code' => 'required|max:5|regex:/^[0-9]+$/i',
            'city' => 'required', 'phone' => 'regex:/^\+336[0-9]{8}$/i',
            'email' => 'required|unique:companies|email'
        ]);
        $name = $request->input('name');
        $street = $request->input("street");
        $code = $request->input('code');
        $city = $request->input('city');
        $phone = $request->input('phone');
        $mail = $request->input('email');
        $company = Company::create([
            'name' => $name,
            'street' => $street,
            'code' => $code,
            'city' => $city,
            'phone' => $phone,
            'email' => $mail
        ]);
        return redirect('company')->with('success', 'Company created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('company.show', ['company' => Company::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('company.edit', ['company' => Company::find($id)]);
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
        $company = Company::find($id);
        $validated = $request->validate([
            'name' => "exclude_if:name,$company->name|required|unique:companies",
            'street' => 'required', 'code' => 'required|max:5|regex:/^[0-9]+$/i',
            'city' => 'required', 'phone' => 'regex:/^\+336[0-9]{8}$/i',
            'email' => "exclude_if:email,$company->email|required|unique:companies|email"
        ]);
        $company->update($request->all());
        return redirect(route('company_index'))->with('success', 'Company updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        $company->delete();
        return redirect(route('company_index'))->with('success', 'Company deleted successfully');
    }
}
