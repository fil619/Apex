<?php

namespace App\Http\Controllers;

use App\DirectLedger;
use Illuminate\Http\Request;
use DB;

class DirectLedgerController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function index()
   {
       $dledger = DirectLedger::orderBy('ledger')->get();
       return response()->json([
           'dledger'    => $dledger,
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
      $ledger = $request->input('ledger');
      DB::table('direct_ledgers')->insert(
        ['ledger' => $ledger]
);
   }

  /**
   * Display the specified resource.
   *
   * @param  \App\IndirectLedger  $indirectLedger
   * @return \Illuminate\Http\Response
   */
  public function show(IndirectLedger $indirectLedger)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\IndirectLedger  $indirectLedger
   * @return \Illuminate\Http\Response
   */
  public function edit(IndirectLedger $indirectLedger)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\IndirectLedger  $indirectLedger
   * @return \Illuminate\Http\Response
   */
   public function update(Request $request, DirectLedger $directLedger)
   {
        $id =  request('Id');
        $directLedger = DirectLedger::find($id);
        $directLedger->ledger = request('ledger');
        $directLedger->save();

       return response()->json([
           'message' => 'Expense updated successfully!'
       ], 200);
   }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\IndirectLedger  $indirectLedger
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $directLedger = DirectLedger::find($id)->delete ();

  }
}
