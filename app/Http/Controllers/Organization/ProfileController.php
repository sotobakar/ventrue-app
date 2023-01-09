<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    /**
     * Profile page.
     * 
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $levels = ['Fakultas', 'Universitas'];
        $faculties = Faculty::get();

        return view('organization.pages.profile.index', [
            'user' => $user,
            'faculties' => $faculties,
            'levels' => $levels
        ]);
    }

    /**
     * Update profile.
     * 
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'image' => ['sometimes', 'image', 'max:10240'],
            'description' => ['sometimes', 'string'],
            'level' => ['sometimes'],
            'faculty_id' => ['sometimes', 'exists:faculties,id'],
        ]);

        $user = $request->user();

        // If image exists then resize and save.
        if (isset($validated['image'])) {
            /** @var \Illuminate\Http\UploadedFile */
            $file = $validated['image'];

            // Resize Image
            $resized_image = Image::make($file->getPathName())
                ->orientate()
                ->fit(400, 400, function ($constraint) {
                    $constraint->aspectRatio();
                })->encode();

            // Rename file
            $now = \Carbon\Carbon::now()->toDateTimeString();
            $file_name = md5($resized_image->__toString() . $now);
            $path = "organizations/images/{$file_name}.{$file->getClientOriginalExtension()}";

            // Save to storage/public/organizations/images folder
            $resized_image->save(Storage::disk('public')->path($path));

            // Delete previous image
            if (!is_null($user->organization->image)) {
                if (Storage::disk('public')->exists($user->organization->image)) {
                    Storage::disk('public')->delete($user->organization->image);
                }
            }

            // Set validated input to path
            $validated['image'] = $path;
        }

        $user->organization()->update($validated);

        return back()->with('success', 'Berhasil update data profil.');
    }
}
