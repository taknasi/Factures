<?php

namespace App\Http\Controllers;

use App\Http\Requests\SectionRequest;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::with(['user' => function ($q) {
            $q->select('name', 'id');
        }])->orderBy('id', 'Desc')->get();
        return view('sections.sections', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SectionRequest $request)
    {
        $section = Section::create([
            'section_nom' => $request->section_nom,
            'description' => $request->description,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->route('sections.index')->with(['success' => 'Ajou avec seccess']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(SectionRequest $request)
    {
      
        $section = Section::find($request->id);
        if ($section) {
            $section->update([
                'section_nom' => $request->section_nom,
                'description' => $request->description,
                'user_id' => Auth::user()->id
            ]);
            return redirect()->route('sections.index')->with(['success' => 'Modif avec seccess']);
        } else
            return redirect()->route('sections.index')->with(['error' => 'erreur dans modif']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $section = Section::find($request->id)->delete();
        return redirect()->route('sections.index')->with(['success' => 'delete avec seccess']);
    }
}
