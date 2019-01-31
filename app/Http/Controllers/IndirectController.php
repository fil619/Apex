<?php

namespace App\Http\Controllers;

use App\Indirect;
use Illuminate\Http\Request;

class IndirectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
         $posts = Indirect::get();
         return response()->json([
             'posts'    => $posts,
         ], 200);
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
     {
       $this->validate($request, [
           'description' => 'required',
       ]);

       $indirect = Indirect::create([
         'type'        => request('type'),
         'amount'      => request('amount'),
         'date'        => request('date'),
         'description' => request('description'),
       ]);

       return response()->json([
           'post'    => $indirect,
           'message' => 'Success'
       ], 200);
     }

    /**
     * Display the specified resource.
     *
     * @param  \App\Indirect  $indirect
     * @return \Illuminate\Http\Response
     */
    public function show(Indirect $indirect)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Indirect  $indirect
     * @return \Illuminate\Http\Response
     */
    public function edit(Indirect $indirect)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Indirect  $indirect
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Indirect $indirect)
    {
      $this->validate($request, [
          'description' => 'required',
      ]);

      $indirect->type = request('type');
      $indirect->amount = request('amount');
      $indirect->date = request('date');
      $indirect->description = request('description');


      $indirect->save();

      return response()->json([
          'message' => 'Post updated successfully!'
      ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Indirect  $indirect
     * @return \Illuminate\Http\Response
     */
    public function destroy(Indirect $indirect)
    {
      $indirect->delete();

    }
}
