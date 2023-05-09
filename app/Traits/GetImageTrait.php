<?php
namespace App\Traits;

trait GetImageTrait{

    public function getImageAttribute($value)
    {
        $img = asset('no.jpeg');
        if($value)
        {
            $path = public_path(parse_url($value)['path']);
            if(file_exists($path))
            $img = $value;
        }
        return  $img;   
    }


}