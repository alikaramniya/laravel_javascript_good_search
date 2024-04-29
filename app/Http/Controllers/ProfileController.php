<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function user()
    {
        return Profile::find(4)->load('user:id,name');
    }

    /**
     * Create method for show form
     *
     * @return \Illuminate\View
     */
    public function create(): View
    {
        return view('profile.create');
    }

    /**
     * Store method for add new profile
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId = 1;

        try {
        Profile::create([
            'last_name' => $request->last_name,
            'age' => $request->age,
            'user_id' => $userId,
            'image' => $this->uploadImage($request->file('image'))
        ]);}catch(\Exception $e) {
            Log::debug($e->getMessage());

            return $e->getMessage();
        }

        return response('true', 200);
    }

    private function uploadImage($file) {
        $path = $file->store('public/profile');
        return str_replace('public/','storage/',$path);
    }
}
