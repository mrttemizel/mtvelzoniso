<?php

namespace App\Http\Controllers\backend\basvurular;

use App\Http\Controllers\Controller;
use App\Models\Form;
use Illuminate\Http\Request;

class BasvurularController extends Controller
{
    public function degerlendirmeyi_bekleyenler()
    {
        $data = Form::all()->where('application_status', 1);
        return view('backend.basvurular.degerlendirme-bekleyenler', compact('data'));
    }

    public function on_kabul_almislar()
    {
        $data = Form::all()->where('application_status', 2);
        return view('backend.basvurular.on-kabul', compact('data'));
    }

    public function resmi_kabul_almislar()
    {
        $data = Form::all()->where('application_status', 3);
        return view('backend.basvurular.resmi_kabul_almislar', compact('data'));
    }

    public function tum_basvurular()
    {
        $data = Form::all();
        return view('backend.basvurular.tum-basvurular', compact('data'));
    }
}
