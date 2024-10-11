<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RelawanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // $id_relawan = request('id');
        return [
            'nama' => 'required|string|max:255',
            // 'no_hp' => 'required|string|max:15|unique:relawans,no_hp,' . $id_relawan,
            // 'kode_kel' => 'required|string|max:10',
            // 'kode_lingkungan' => 'required|string|max:10',
            // 'rt' => 'required|string|max:3',
            // 'rw' => 'required|string|max:3',
        ];
    }

    /**
     * Get custom messages for validation errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'nama.required' => 'Nama wajib diisi.',
            // 'no_hp.required' => 'Nomor HP wajib diisi.',
            // 'no_hp.unique' => 'Nomor HP sudah terdaftar.',
            // 'kode_kel.required' => 'Kode kelurahan wajib diisi.',
            // 'kode_lingkungan.required' => 'Kode lingkungan wajib diisi.',
            // 'rt.required' => 'RT wajib diisi.',
            // 'rw.required' => 'RW wajib diisi.',
        ];
    }
}
