<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\Fees\ProcessingFeeRepositoryInterface; 


class ProcessingFeeController extends Controller
{
   
    private $Processing;
    public function __construct(ProcessingFeeRepositoryInterface $Processing)
    {
	       //Sections1 اصبح فيها كل اللي في ريبروستري 

        $this->Processing=$Processing;
    }
    public function index()
    {
        return $this->Processing->index();
    }

   
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        return $this->Processing->store($request);
    }

    
    public function show($id)
    {
        return $this->Processing->show($id);

    }

    
    public function edit($id)
    {
        return $this->Processing->edit($id);

    }

    
    public function update(Request $request)
    {
        return $this->Processing->update($request);
    }

    
    public function destroy(Request $request)
    {
        return $this->Processing->destroy($request);

    }
}
