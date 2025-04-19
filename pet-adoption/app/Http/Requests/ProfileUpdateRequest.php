<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'city' => ['nullable', 'string', 'max:20'],
            'state' => ['nullable', 'string', 'max:20'],
            'mobile_no'  => ['nullable', 'string', 'max:20'],
            'profile_picture'=> ['nullable', 'image', 'max:2048'],
        ];
    }

    // Handle profile picture upload
    public function handleProfilePictureUpload(User $user)
    {
        if ($this->hasFile('profile_picture')) {
            // Delete the old profile picture if one exists.
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            // Store new file in "profile_pictures" directory
            $path = $this->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }
    }
}
