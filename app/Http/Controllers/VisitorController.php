<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Visitor;
use RealRashid\SweetAlert\Facades\Alert;
class VisitorController extends Controller
{
    public function index()
    {
        $barangays = [
            'BALOGO', 'SAN RAMON', 'TOBOG', 'MAPORONG', 'SAN AGUSTIN',
            'BAGUMBAYAN', 'BAGSA', 'MATAMBO', 'MARAMBA', 'CAGMANABA',
            'BADIAN', 'NAGAS', 'TAPEL', 'SAN ANTONIO', 'BOGTONG',
            'CADAWAG', 'TOBGON', 'CAMAGONG', 'CALPI', 'PISTOLA',
            'GUMABAO', 'BANGIAWON', 'CALAGUIMIT', 'RAMAY', 'SAN VICENTE',
            'SAN PASCUAL', 'SAN MIGUEL', 'DEL ROSARIO', 'TABLON', 'TALISAY',
            'COLIAT', 'SAN JOSE', 'BADBAD', 'CASINAGAN', 'MAYAG',
            'BANAO', 'MOROPONROS', 'ILAOR SUR', 'MANGA', 'BUSAC',
            'BONGORAN', 'IRAYA NORTE', 'MAYAO', 'SABAN', 'ILAOR NORTE',
            'OBALIW-RINAS', 'SAN JUAN', 'SAN ISIDRO', 'TALONGOG', 'CALZADA',
            'RIZAL', 'IRAYA SUR', 'CENTRO', 'POBLACION'
        ];

        if (Session::has('pinEncrypt')) {
            return view('form', compact('barangays'));
        } else {
            return redirect()->route('landing');
        }
    }

    public function CheckPin(Request $request)
    {
        // Combine the PIN inputs
        $pin = implode('', [
            $request->input('pin_1'),
            $request->input('pin_2'),
            $request->input('pin_3'),
            $request->input('pin_4')
        ]);

        $pinStated = '1992';

        // Encrypt the input PIN
        if ($pin === $pinStated) {
            $pinEncrypt = encrypt($pin);

            // Store the encrypted PIN in the session
            Session::put('pinEncrypt', $pinEncrypt);

            // Store login time and expiration (current time + 4 hours)
            // Session::put('login_time', now());
            // Session::put('session_expires_at', now()->addMinutes(10));

            return redirect()->route('visitors.index');
        } else {
            return back()->withErrors(['pin' => 'Invalid PIN. Please try again.']);
        }
    }

    public function landing(){
        // dd(session()->all());
        if (!Session::has('pinEncrypt')) {
            return view('index');
        } else {
            return redirect()->route('visitors.index');
        }
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'barangay' => 'required|string|max:255',
            'purok' => 'required|integer|min:1|max:12',
            'purpose' => 'required|string|max:255',
            'other_purpose' => 'nullable|string|max:255',
        ]);

        // If the purpose is 'Others', use the other_purpose value
        $purpose = $request->purpose === 'Others' ? $request->other_purpose : $request->purpose;
        $name = $request->first_name . ' ' . $request->last_name;
        // Create a new attendance record
        Visitor::create([
            'name' => $name,
            'gender' => $validatedData['gender'],
            'barangay' => $validatedData['barangay'],
            'purok' => $validatedData['purok'],
            'purpose' => $purpose,
        ]);

        Alert::success('Success', 'Attendance recorded successfully.');
        return redirect()->route('visitors.index')->with('success', 'Attendance recorded successfully.');
    }

}