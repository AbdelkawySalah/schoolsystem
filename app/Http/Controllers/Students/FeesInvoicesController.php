<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\Fees\FeeinvoicesRepositoryInterface; 

class FeesInvoicesController extends Controller
{
    private $FeesInvoices;
    public function __construct(FeeinvoicesRepositoryInterface $FeesInvoices)
    {
	       //Sections1 اصبح فيها كل اللي في ريبروستري 

        $this->FeesInvoices=$FeesInvoices;
    }
    public function index()
    {
        return $this->FeesInvoices->index();

    }
    
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        return $this->FeesInvoices->store($request);

    }

    
    public function show($id)
    {
        return $this->FeesInvoices->show($id);

    }

   
    public function edit($id)
    {
        return $this->FeesInvoices->edit($id);

    }

    
    public function update(Request $request)
    {
        return $this->FeesInvoices->update($request);
    }

    
    public function destroy(Request $request)
    {
        return $this->FeesInvoices->destroy($request);

    }
}
