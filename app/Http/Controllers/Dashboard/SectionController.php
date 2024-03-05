<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSectionRequest;
use App\Interfaces\Sections\SectionRepositoryInterface;
use Illuminate\Http\Request;

class SectionController extends Controller
{

    private $Sections;

    public function __construct(SectionRepositoryInterface $Sections)
    {
        $this->Sections = $Sections;
    }

    public function index()
    {
      return $this->Sections->index();
    }


    public function create()
    {
        //
    }


    public function store(StoreSectionRequest $request)
    {
        return $this->Sections->store($request);
    }


    public function show($id)
    {
        return $this->Sections->show($id);
    }


    public function edit(string $id)
    {
        //
    }

    public function update(StoreSectionRequest $request)
    {
        return $this->Sections->update($request);
    }


    public function destroy(StoreSectionRequest $request)
    {
        return $this->Sections->destroy($request);
    }
}
