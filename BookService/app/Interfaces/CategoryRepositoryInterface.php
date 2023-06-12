<?php

namespace App\Interfaces;

interface CategoryRepositoryInterface 
{
    public function getAllCategory();

    
    public function getSelectedCategory();

    public function getAllCategoryForAdmin();
}