<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\Fees\FeesTypeRepositoryInterface; 
use App\Http\Requests\StoreFeesTypeRequest;

class FeesTypeController extends Controller
{
    private $FeesType;
    public function __construct(FeesTypeRepositoryInterface $FeesType)
    {
	       //Sections1 اصبح فيها كل اللي في ريبروستري 

        $this->FeesType=$FeesType;
    }
    public function index()
    {
        return $this->FeesType->index();

    }

   
    public function create()
    {
        //
    }


    public function store(StoreFeesTypeRequest $request)
    {
        return $this->FeesType->store($request);

    }

    public function update(StoreFeesTypeRequest $request)
    {
        return $this->FeesType->update($request);

    }

    public function destroy(Request $request)
    {
        return $this->FeesType->destroy($request);

    }

    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        //
    }

   
   
    
    
}
