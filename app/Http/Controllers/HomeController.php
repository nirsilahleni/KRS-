<?php

namespace App\Http\Controllers;

use App\Models\Krs\Balita;
use Illuminate\Http\Request;
use App\Models\Master\Kecamatan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Master\Kelurahan;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        //Widget
        $kk = DB::table('kepala_keluarga')->count();
        $balita = DB::table('balita')->count();
        $kader = DB::table('kader')->count();
        $monitoring = DB::table('pendampingan_balita')
                            ->select(DB::raw('COUNT(*) as count'))
                            ->union(DB::table('pendampingan_ibu_hamil')->select(DB::raw('COUNT(*)')))
                            ->get()
                            ->sum('count');

        //Grafik Jumlah Balita
        $kecamatan = Kecamatan::all();
        $jumlah_balita = Balita::select(DB::raw('COUNT(balita.id) as jumlah_balita'))
                                    ->join('kepala_keluarga','balita.id', '=', 'kepala_keluarga.id')
                                    ->join('ref_kelurahan','kepala_keluarga.id', '=', 'ref_kelurahan.id')
                                    ->where('ref_kelurahan.kecamatan_id', '1')
                                    ->groupBy('ref_kelurahan.nama_kelurahan')
                                    ->pluck('jumlah_balita');
        $nama_kelurahan = Kelurahan::select('nama_kelurahan')->where('kecamatan_id', '1')->pluck('nama_kelurahan');
        $total_balita = Balita::select(DB::raw('COUNT(balita.id) as count'))
                                    ->join('kepala_keluarga', 'balita.id', '=', 'kepala_keluarga.id')
                                    ->join('ref_kelurahan', 'kepala_keluarga.id', '=', 'ref_kelurahan.id')
                                    ->where('ref_kelurahan.kecamatan_id', '1')
                                    ->count();

        //Grafik Jenis Kelamin
        $laki_laki = Balita::select(DB::raw('COUNT(balita.id) as count'))
                                    ->join('kepala_keluarga', 'balita.id', '=', 'kepala_keluarga.id')
                                    ->join('ref_kelurahan', 'kepala_keluarga.id', '=', 'ref_kelurahan.id')
                                    ->where('ref_kelurahan.kecamatan_id', '1')
                                    ->where('balita.jenis_kelamin', 'L')
                                    ->count();
        $perempuan = Balita::select(DB::raw('COUNT(balita.id) as count'))
                                    ->join('kepala_keluarga', 'balita.id', '=', 'kepala_keluarga.id')
                                    ->join('ref_kelurahan', 'kepala_keluarga.id', '=', 'ref_kelurahan.id')
                                    ->where('ref_kelurahan.kecamatan_id', '1')
                                    ->where('balita.jenis_kelamin', 'P')
                                    ->count();

        if ($total_balita == 0 || $laki_laki == 0 || $perempuan == 0) {
            $persen_laki = 0;
            $persen_perempuan = 0;
            $total_jk = [$persen_laki, $persen_perempuan];
        }else{
            $persen_laki = ($laki_laki / $total_balita) * 100;
            $persen_perempuan = ($perempuan / $total_balita) * 100;

            $total_jk = [$persen_laki, $persen_perempuan];
        }

        return view('pages.admin.dashboard', compact('kk','balita','kader','monitoring','kecamatan','jumlah_balita','nama_kelurahan','total_balita','laki_laki','perempuan','total_jk'));
        // return view('pages.admin.dashboard', compact('kk','balita','kader','monitoring','kecamatan','total_balita','laki_laki','perempuan','total_jk'));
    }



    public function profil()
    {
        $user = Auth::user();

        if ($user->email !== "admin@arkatama.test") {

            return view('pages.admin.kader', ['user' => $user]);
        }

        return view('pages.admin.profile', ['user' => $user]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::user()->id,
            // 'password' => 'required|string|min:5|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        // $user->password = bcrypt($request->password);
        $user->save();
        $user = auth()->user();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profile_images', 'public');
            $user->image = $imagePath;
        }
        return redirect()->route('profil')->with('success', 'Profil berhasil diperbarui!');
    }
}