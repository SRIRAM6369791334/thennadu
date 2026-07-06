<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuccessStory;
use Illuminate\Support\Facades\File;

class SuccessStoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stories = SuccessStory::all();
        return view('pages.success-stories', compact('stories'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'male_name' => 'required',
            'female_name' => 'required',
            'married_date' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:width=640,height=640',
        ]);

        $story = new SuccessStory();
        $story->male_name = $request->input('male_name');
        $story->female_name = $request->input('female_name');
        $story->married_date = $request->input('married_date');
        $story->description = $request->input('description');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('images/success_stories/', $filename);
            $story->image = $filename;
        }

        $story->save();

        return redirect('/success-stories')->with('success', 'Success Story Added Successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $story = SuccessStory::find($id);
        return view('pages.success-story-edit', compact('story'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'male_name' => 'required',
            'female_name' => 'required',
            'married_date' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:width=640,height=640',
        ]);

        $story = SuccessStory::find($id);
        $story->male_name = $request->input('male_name');
        $story->female_name = $request->input('female_name');
        $story->married_date = $request->input('married_date');
        $story->description = $request->input('description');

        if ($request->hasFile('image')) {
            $destination = 'images/success_stories/' . $story->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('images/success_stories/', $filename);
            $story->image = $filename;
        }

        $story->save();

        return redirect('/success-stories')->with('success', 'Success Story Updated Successfully');
    }

    public function destroy($id)
    {
        $story = SuccessStory::find($id);
        if ($story->image) {
            $destination = 'images/success_stories/' . $story->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
        }
        $story->delete();
        return redirect('/success-stories')->with('success', 'Success Story Deleted Successfully');
    }
}
