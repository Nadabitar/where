<?php
namespace App\Traits;

use App\Traits\GenralTraits as GenralTraits;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

/**
 * 
 */
trait ImageTraits
{
    use GenralTraits;
    public function uploadImage($image)
    {
        try{
            $imageUrl = Cloudinary()->upload($image)->getSecurePath();
            return $imageUrl;
        }
        catch(\Exception $e){
            return $this->returnError('201' , $e->getMessage() );
        }

    }

}

