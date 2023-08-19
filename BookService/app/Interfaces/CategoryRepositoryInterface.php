<?php

namespace App\Interfaces;

interface CategoryRepositoryInterface
{
    public function getAllCategory();


    public function getSelectedCategory();

    public function getAllCategoryForAdmin();

    public function createCategory(array $data);

    public function updateCategory($data, $id);
}
