<?php

namespace App\Interfaces;

// use App\Http\Requests\StorePostRequest;
// use App\Http\Requests\UpdatePostRequest;

interface NewsRepositoryInterfaces
{
    public function store(Request $request);

    public function destroy($id);

    public function update(Request $request, $id);

    public function show($id);

    public function index();
}