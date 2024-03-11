<?php

namespace App\Http\Controllers\backend\sections;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionsController extends Controller
{
    public  function index()
    {
        $data = Section::query()
            ->orderBy('section_name', 'asc')
            ->get();

        return view('backend.section.index',compact('data'));
    }

    public  function store(Request $request)
    {
        $data = new Section();
        $request->validate([
            'section_name' => 'required|unique:sections',
        ]);

        $data->section_name = $request->input('section_name');
        $query = $data->save();
        if (!$query) {
            return back()->with('error', 'Bölüm eklenirken bir hata oluştu!');
        } else {
            return back()->with('success', 'Bölüm ekleme başarılı.');
        }
    }

    public function delete($id)
    {
        $data = Section::find($id);

        $query = $data->delete();
        if (!$query) {
            return back()->with('error', 'Bölüm Silinirken bir hata oluştu!');
        } else {
            return back()->with('success', 'Bölüm silme işlemi başarılı.');
        }
    }
}
