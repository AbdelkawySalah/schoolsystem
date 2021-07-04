<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Interfaces\Student\StudentpromotionRepositoryInterface; 

class PromotionController extends Controller
{
    private $promotion;
    public function __construct(StudentpromotionRepositoryInterface $promotion)
    {
	       //Sections1 اصبح فيها كل اللي في ريبروستري 

        $this->promotion=$promotion;
    }

    public function index()
    {
        return $this->promotion->index();
    }

    
    public function create()
    {
        return $this->promotion->create();

    }

    
    public function store(Request $request)
    {
        return $this->promotion->store($request);
    }

    
    public function show($id)
    {
        return $this->promotion->show();
    }

    public function edit($id)
    {
        return $this->promotion->edit($id);
    }

    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy(Request $request)
    {
        return $this->promotion->destroy($request);

    }
}
