<?php

use Illuminate\Support\Facades\Storage;

function uploadPhoto($photo, $folder)
{
    $photoName = time(). random_int(0, 1000) . '.' . $photo->getClientOriginalExtension();
    Storage::putFileAs('public/' . $folder, $photo, $photoName);
    return $photoName;
}