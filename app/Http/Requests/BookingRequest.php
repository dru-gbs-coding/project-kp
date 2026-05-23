<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'layanan_id' => 'required|exists:layanan,layanan_id',
            'tanggal_pengiriman' => 'required|date|after:today',
            'asal' => 'required|string|max:150',
            'tujuan' => 'required|string|max:150',
            'detail_barang' => 'nullable|string',
            'berat_barang' => 'nullable|numeric|min:0.1',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'layanan_id.required' => 'Layanan harus dipilih.',
            'layanan_id.exists' => 'Layanan tidak ditemukan.',
            'tanggal_pengiriman.required' => 'Tanggal pengiriman harus diisi.',
            'tanggal_pengiriman.date' => 'Tanggal pengiriman harus berformat tanggal yang valid.',
            'tanggal_pengiriman.after' => 'Tanggal pengiriman harus lebih besar dari hari ini.',
            'asal.required' => 'Asal pengiriman harus diisi.',
            'asal.max' => 'Asal pengiriman maksimal 150 karakter.',
            'tujuan.required' => 'Tujuan pengiriman harus diisi.',
            'tujuan.max' => 'Tujuan pengiriman maksimal 150 karakter.',
            'berat_barang.numeric' => 'Berat barang harus berupa angka.',
            'berat_barang.min' => 'Berat barang minimal 0.1 kg.',
        ];
    }
}
