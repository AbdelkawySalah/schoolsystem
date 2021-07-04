<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\Student\ReceiptStudentsRepositoryInterface; 

class ReceiptStudentsController extends Controller
{
    private $Receipt;
    public function __construct(ReceiptStudentsRepositoryInterface $Receipt)
    {
	       //Sections1 اصبح فيها كل اللي في ريبروستري 

        $this->Receipt=$Receipt;
    }
    public function index()
    {
        return $this->Receipt->index();
    }

    
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        return $this->Receipt->store($request);
    }

   
    public function show($id)
    {
        return $this->Receipt->show($id);

    }

   
    public function edit($id)
    {
        return $this->Receipt->edit($id);
    }

   
    public function update(Request $request)
    {
        return $this->Receipt->update($request);

    }

  
    public function destroy(Request $request)
    {
        //
        return $this->Receipt->destroy($request);

    }
}
