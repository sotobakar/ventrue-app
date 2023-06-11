<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Organization\StoreOrganizationRequest;
use App\Http\Requests\Admin\Organization\UpdateOrganizationRequest;
use App\Models\Faculty;
use App\Models\Organization;
use App\Models\User;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\QueryBuilder\QueryBuilder;

class OrganizationController extends Controller
{
    private ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * List of organizations.
     * 
     */
    public function index(Request $request)
    {
        $organizations = QueryBuilder::for(Organization::class)
            ->allowedFilters(['name'])
            ->orderBy('name', 'asc')
            ->paginate(10)
            ->appends(request()->query());

        return view('admin.pages.organizations.index', [
            'organizations' => $organizations
        ]);
    }

    /**
     * Show organization creation form.
     * 
     */
    public function create(Request $request)
    {
        $levels = config('constants.ORGANIZATION.LEVEL');
        $faculties = Faculty::get();
        return view('admin.pages.organizations.create', [
            'levels' => $levels,
            'faculties' => $faculties
        ]);
    }

    /**
     * Create organization.
     * 
     */
    public function store(StoreOrganizationRequest $request)
    {
        // Obtain user input
        $validated = $request->validated();

        // Create User
        $user = User::create([
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);
        $user->assignRole('organization');

        // Save Image
        $imagePath = $this->imageService->storeAndReplace($validated['image'], 400, 400, 'organizations/images');

        // Create Organization
        $organization = Organization::create([
            'name' => $validated['name'],
            'image' => $imagePath,
            'level' => $validated['level'],
            'faculty_id' => $validated['faculty_id'] ?? null,
            'user_id' => $user->id,
            'description' => $validated['description']
        ]);

        // Return success response
        return redirect()->route('admin.organizations')->with('success', 'Organisasi ' . $organization->name . ' berhasil dibuat.');
    }

    /**
     * Show organization edit form.
     * 
     */
    public function edit(Organization $organization, Request $request)
    {
        $levels = config('constants.ORGANIZATION.LEVEL');
        $faculties = Faculty::get();
        return view('admin.pages.organizations.edit', [
            'levels' => $levels,
            'faculties' => $faculties,
            'organization' => $organization
        ]);
    }

    /**
     * Update organization
     * 
     */
    public function update(Organization $organization, UpdateOrganizationRequest $request)
    {
        $validated = $request->validated();

        $user = $organization->user;

        // Check email and password, change if they exist
        if (!is_null($validated['email'])) {
            $user->email = $validated['email'];
        }

        if (!is_null($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        // Check image, replace if image exist
        if (isset($validated['image'])) {
            $imagePath = $this->imageService->storeAndReplace($validated['image'], 400, 400, 'organizations/images', $organization->image);

            $validated['image'] = $imagePath;
        }

        // Check if org level changed to "University" then change faculty to null
        if ($validated['level'] == config('constants.ORGANIZATION.LEVEL.1')) {
            $validated['faculty_id'] = null;
        }

        // Update organization
        $organization->update($validated);

        return redirect()->route('admin.organizations')->with('success', 'Ormawa ' . $organization->name . ' berhasil diupdate.');
    }

    /**
     * Delete organization
     * 
     */
    public function delete(Organization $organization, Request $request)
    {
        // Delete profile image if exists
        if (!is_null($organization->image)) {
            if (Storage::disk('public')->exists($organization->image)) {
                Storage::disk('public')->delete($organization->image);
            }
        }

        // TODO: Delete event images if exists

        // TODO: Delete event materials if exists

        // TODO: Delete event approval files if exists

        // Delete organization user
        $organization->user->delete();

        // Return success response
        return redirect()->route('admin.organizations')->with('success', 'Ormawa ' . $organization->name . ' berhasil dihapus.');
    }
}
