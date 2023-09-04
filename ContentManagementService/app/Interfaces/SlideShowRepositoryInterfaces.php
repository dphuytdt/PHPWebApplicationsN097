<?php

namespace App\Interfaces;


interface SlideShowRepositoryInterfaces
{
    public function getAllSlideShows();

    public function create($data);

    public function getSlideShow($id);

    public function update($data, $id);

    public function delete($id);
}
