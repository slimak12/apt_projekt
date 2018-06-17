<?php

namespace App\Http\Controllers;

use App\Contest;
use App\ContestResult;
use App\ContestUser;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $contests = Contest::where('id','>', 0)->with('owner')->with('photo')->withCount('users')->get();
        //dd($contests);
        return view('contest', compact('contests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('contest_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $path = \Storage::disk('public')->putFile('photos', $request->file('photo'));

        $photo = new Photo();
        $photo->path = "/storage/".$path;
        $photo->cover = 1;
        $photo->alt = 'a';
        $photo->save();


        $contest = new Contest();
        $contest->active = 1;
        $contest->name = $request->name;
        $contest->desc = $request->desc;
        $contest->owner_id = Auth::id();
        $contest->photo_id = $photo->id;
        $contest->save();
        return redirect()->route('contest.show', $contest->id);

    }

    public function add_to_contest($contest_id){
        $contest_user = new ContestUser();
        $contest_user->user_id = Auth::id();
        $contest_user->contest_id = $contest_id;
        $contest_user->save();
        return redirect()->route('contest.show', $contest_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function show(Contest $contest)
    {

       $contest = $contest->load('owner')->load('photo')->load('users.user')->load('users.result');
//        dd($contest);
        return view('contest_show', compact('contest'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function edit(Contest $contest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contest $contest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contest $contest)
    {
        //
    }

    public function accept_user($contest_id, $user_id){
        $contest_user = ContestUser::where('user_id', $user_id)->where('contest_id', $contest_id)->first();
        $contest_user->accepted = !$contest_user->accepted;
        $contest_user->save();
        return redirect()->route('contest.show', $contest_id);
    }


    public function update_result(Request $request){

        $contest_user = ContestUser::where('user_id', $request->user_id)->where('contest_id', $request->contest_id)->first();

        $contest_result = ContestResult::where('contest_user_id', $contest_user->id)->first();
        if(empty($contest_result)){
            $contest_result = new ContestResult();
            $contest_result->contest_user_id =  $contest_user->id;
        }

        if(!empty($request->score_result)){
            $contest_result->score_result = $request->score_result;
        }
        if( !empty($request->annotation)){
            //dd( $request->annotation);
            $contest_result->annotation = $request->annotation;
        }

        $contest_result->unit = 's';
        $contest_result->save();
        return redirect()->route('contest.show', $request->contest_id);
    }
}
