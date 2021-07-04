<?php
namespace App\Interfaces\Fees;
interface FeesTypeRepositoryInterface
{
   public function index();
   public function create();
   public function edit($id);
   // public function show($id);
   public function store($request);
   public function update($request);
   public function destroy($request);

}