<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\Fees\FeesRepositoryInterface; 
use App\Http\Requests\StoreFeesRequest;
class FeesController extends Controller
{
    private $Fees;
    public function __construct(FeesRepositoryInterface $Fees)
    {
	       //Sections1 اصبح فيها كل اللي في ريبروستري 

        $this->Fees=$Fees;
    }
    public function index()
    {
        return $this->Fees->index();

    }

   
    public function create()
    {
        return $this->Fees->create();
    }

   
    public function store(StoreFeesRequest $request)
    {
        return $this->Fees->store($request);

    }

    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        return $this->Fees->edit($id);

    }

   
    public function update(StoreFeesRequest $request)
    {
        return $this->Fees->update($request);

    }

   
    public function destroy(Request $request)
    {
        return $this->Fees->destroy($request);

    }

   
}
