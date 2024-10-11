<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StorePendudukRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nik' => ['required', 'numeric', 'digits:16'],  // NIK harus berupa angka dan tepat 16 digit
            'name' => ['required', 'string', 'max:255'],
            'usia' => ['required', 'numeric', 'digits:2'],
            'alamat' => ['required', 'string', 'max:255'],
            // 'rt' => ['required', 'numeric', 'digits:3'],
            // 'rw' => ['required', 'numeric', 'digits:3'],
            // 'tps' => ['required', 'numeric', 'digits:3'],

            // 'email' => ['required', 'email', 'unique:penduduks,email'],  // Email harus unik di tabel 'penduduks'
            // 'password' => ['required', 'min:5', 'confirmed'],  // Password minimal 5 karakter dan harus dikonfirmasi
        ];
    }
}
