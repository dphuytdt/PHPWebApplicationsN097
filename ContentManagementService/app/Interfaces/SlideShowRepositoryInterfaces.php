<?php

namespace App\Interfaces;


interface SlideShowRepositoryInterfaces
{
    public function index();

    public function create($request);

    public function show($id);

    public function update($request, $id);

    public function destroy($id);
}
