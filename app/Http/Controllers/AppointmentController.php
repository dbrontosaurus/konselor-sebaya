<?php

namespace App\Http\Controllers;

// DUA BARIS INI WAJIB ADA:
use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        // Ambil jadwal khusus mahasiswa yang sedang login, urutkan dari yang terbaru
        $appointments = Appointment::where('user_id', $request->user()->id)
                                   ->orderBy('created_at', 'desc')
                                   ->get();
        
        return view('appointments.index', compact('appointments'));
    }
    public function create()
    {
        return view('appointments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:online,offline',
            'scheduled_at' => 'required|date|after:today',
        ]);

        Appointment::create([
            'user_id' => $request->user()->id,
            'type' => $request->type,
            'scheduled_at' => $request->scheduled_at,
            'status' => 'pending', 
        ]);

        // 2. UBAH BARIS INI: Redirect ke halaman daftar jadwal, bukan back()
        return redirect()->route('appointments.index')->with('success', 'Jadwal konseling berhasil diajukan! Menunggu persetujuan.');
    }
}