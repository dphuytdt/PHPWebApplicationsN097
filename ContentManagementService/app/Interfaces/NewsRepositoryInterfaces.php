<?php

namespace App\Interfaces;

interface NewsRepositoryInterfaces
{
    public function store(array $data);

    public function destroy($id);

    public function update(array $data, $id);

    public function show($id);

    public function index();

    public function latest();

    public function userIndex();

    public function newRecent();

    public function userLatest();

    public function tags();
}
