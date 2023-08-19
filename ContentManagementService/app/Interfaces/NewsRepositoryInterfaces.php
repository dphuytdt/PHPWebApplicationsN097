<?php

namespace App\Interfaces;

interface NewsRepositoryInterfaces
{
    public function store(array $data);

    public function destroy($id);

    public function update($request, $id);

    public function show($id);

    public function index();

    public function latest();

    public function userIndex();

    public function newRecent();
}
