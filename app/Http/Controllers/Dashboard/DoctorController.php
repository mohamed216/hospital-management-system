<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDoctorsRequest;
use App\Interfaces\Doctors\DocterRepositoryInterface;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{

    private $Doctors;

    public function __construct(DocterRepositoryInterface $Doctors)
    {
        $this->Doctors = $Doctors;
    }



    public function index()
    {
        return $this->Doctors->index();
    }


    public function create()
    {
        return $this->Doctors->create();
    }


    public function store(StoreDoctorsRequest $request)
    {
        return $this->Doctors->store($request);
    }


    public function show(string $id)
    {
        //
    }


    public function edit($id)
    {
        return $this->Doctors->edit($id);
    }


    public function update(StoreDoctorsRequest $request)
    {
        return $this->Doctors->update($request);
    }


    public function destroy(StoreDoctorsRequest $request)
    {
        return $this->Doctors->destroy($request);
    }

    public function update_password(StoreDoctorsRequest $request)
    {
        $this->validate($request, [
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ]);

        return $this->Doctors->update_password($request);
    }

    public function update_status(StoreDoctorsRequest $request)
    {
        $this->validate($request, [
            'status' => 'required|in:0,1',
        ]);
        return $this->Doctors->update_status($request);
    }


}
