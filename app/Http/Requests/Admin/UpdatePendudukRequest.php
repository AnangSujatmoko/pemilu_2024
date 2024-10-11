<?php

namespace App\Http\Requests\Admin;

use App\Models\Penduduk;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePendudukRequest extends FormRequest
{
    protected $penduduk;

    public function __construct(Penduduk $penduduk)
    {
        $this->penduduk = $penduduk;
    }

    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            // 'nik' => [
            //     'required',
            //     'string',
            //     'max:16',
            //     'unique:penduduks,nik,' . $this->penduduk->id // Pastikan ini adalah ID penduduk
            // ],

            'name' => ['required', 'string', 'max:255'],
            'usia' => ['required', 'numeric', 'digits:2'],
            'alamat' => ['required', 'string', 'max:255'],
            // 'rt' => ['required', 'numeric', 'digits:3'],
            // 'rw' => ['required', 'numeric', 'digits:3'],
            // 'tps' => ['required', 'numeric', 'digits:3'],

            // 'email' => [
            //     'required',
            //     'email',
            //     'unique:penduduks,email,' . $this->penduduk->id // Pastikan ini adalah ID penduduk
            // ],
            // Tambahkan aturan validasi untuk kolom lain jika ada
        ];
    }
}
