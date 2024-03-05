<?php

namespace App\Repository\Patients;

use App\Interfaces\Patients\PatientRepositoryInterface;
use App\Models\Invoice;
use App\Models\Patient;
use App\Models\PatientAccount;
use App\Models\ReceiptAccount;
use App\Models\single_invoice;
use Illuminate\Support\Facades\Hash;

class PatientRepository implements PatientRepositoryInterface
{

    public function index()
    {
       $patients = Patient::all();
       return view('Dashboard.Patients.index',compact('patients'));
    }



    public function create()
    {
        return view('Dashboard.Patients.create');
    }

    public function store($request)
    {
        try {
            $patients = new Patient();
            $patients->email = $request->email;
            $patients->password = Hash::make($request->phone);
            $patients->Date_Birth = $request->Date_Birth;
            $patients->Phone = $request->Phone;
            $patients->Gender = $request->Gender;
            $patients->Blood_Group =$request->Blood_Group;
            $patients->save();

            $patients->name = $request->name;
            $patients->Address = $request->Address;
            $patients->save();
            session()->flash('add');
            return redirect()->back();

        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $Patient = Patient::findorfail($id);
        return view('Dashboard.Patients.edit',compact('Patient'));
    }

    public function show($id)
    {
        $Patient = patient::findorfail($id);
        $invoices = Invoice::where('patient_id', $id)->get();
        $receipt_accounts = ReceiptAccount::where('patient_id', $id)->get();
        $Patient_accounts = PatientAccount::where('patient_id', $id)->get();
        return view('Dashboard.Patients.show', compact('Patient', 'invoices', 'receipt_accounts', 'Patient_accounts'));
    }

    public function update($request)
    {
        $Patient = Patient::findorfail($request->id);
        $Patient->email = $request->email;
        $Patient->password = Hash::make($request->phone);
        $Patient->Date_Birth = $request->Date_Birth;
        $Patient->Phone = $request->Phone;
        $Patient->Gender = $request->Gender;
        $Patient->Blood_Group =$request->Blood_Group;
        $Patient->save();

        $Patient->name = $request->name;
        $Patient->Address = $request->Address;
        $Patient->save();
        session()->flash('edit');
        return redirect()->route('Patients.index');
    }

    public function destroy($request)
    {
        Patient ::destroy($request->id);
        session()->flash('delete');
        return redirect()->back();
    }
}
