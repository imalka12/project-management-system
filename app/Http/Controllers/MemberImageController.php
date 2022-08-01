<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMemberImageRequest;
use App\Models\MemberImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MemberImageController extends Controller
{
    public function saveProfileImage(CreateMemberImageRequest $request)
    {
        $data = $request->validated();

        $filePath = $request->file('profile_image')->store('public/profile_images');

        $data['image'] = basename($filePath);

        $image = MemberImage::create($data);

        return $image;
    }

    public function deleteProfileImage(MemberImage $image)
    {
        $imageDeleted = Storage::delete('public/profile_images/' . $image->image);
        //$imageDeleted returns boolean value
        if ($imageDeleted) {
            $image->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Image deleted successfully..',
            ]);
        }
        else{
            return response()->json([
                'status' => 'error',
                'message' => 'There is an error',
            ]);
        }
        
    }
}
