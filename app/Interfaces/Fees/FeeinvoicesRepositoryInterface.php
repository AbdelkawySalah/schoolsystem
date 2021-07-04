<?php
namespace App\Interfaces\Fees;
interface FeeinvoicesRepositoryInterface
{
   public function index();
   public function show($id);
   public function edit($id);
   // public function show($id);
   public function store($request);
   public function update($request);
   public function destroy($request);

}