<?php
namespace App\Interfaces\Student;
interface StudentpromotionRepositoryInterface
{
   public function index();
   public function store($request);
   public function create();
   public function destroy($request);
   public function edit($id);
   public function show();

  
}