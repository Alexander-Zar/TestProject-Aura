<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\Question;
use App\Models\Category;

class TestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tests = Test::all();

        return response()->json($tests);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|unique:tests|max:255',
            'category' => 'required|max:30',
            'time_for_solving' => 'required|numeric',
            // "questions" => 'required',
            "questions.*.body" => 'required',
            "questions.*.type" => 'required',
            "questions.*.answers" => 'required',
            "questions.*.right_answer" => 'required',
        ]);

        $test = new Test;
        $test->name = $request->name;
        $test->time_for_solving = $request->time_for_solving;
        if ($request->image) {
            $newImageName = $request->file('image')->store("test_images", 'public');
            $test->image = "/storage/" . $newImageName;
        } else {
            $test->image = 'no image';
        }
        $test->save();

        $request->questions = json_decode($request->questions);
        foreach ($request->questions as $question) {
            $newQuestion = new Question;
            $newQuestion->body = $question->body;
            $newQuestion->type = $question->type;
            // $newQuestion->answers = json_encode($question['answers']);
            $newQuestion->answers = json_encode($question->answers);
            $newQuestion->right_answer = $question->right_answer;
            $newQuestion->test_id = $test->id;
            $newQuestion->save();
        };

        $request->category = json_decode($request->category);

        // return response()->json(var_dump($request->category, $request->questions));


        foreach ($request->category as $category) {
            $newCategory = new Category; //first or create
            $newCategory->name = $category;
            $newCategory->save();

            $test->categories()->attach($newCategory->id);
        }

        return response()->json(var_dump($test->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
