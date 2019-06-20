<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\History;
use Illuminate\Http\Request;
use DB;
use Session;

class HistoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $histories = History::where('send_by', 'LIKE', "%$keyword%")
                ->orWhere('sms_content', 'LIKE', "%$keyword%")
                ->orWhere('send_to', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $histories = History::latest()->paginate($perPage);
        }

        return view('histories.index', compact('histories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('histories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        History::create($requestData);

        return redirect('histories')->with('flash_message', 'History added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $history = History::findOrFail($id);

        return view('histories.show', compact('history'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $history = History::findOrFail($id);

        return view('histories.edit', compact('history'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $history = History::findOrFail($id);
        $history->update($requestData);

        return redirect('histories')->with('flash_message', 'History updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function truncatehistoriesTable()
    {
        DB::table('histories')->truncate();
        Session::flash('success', 'History successfully deleted.');
        return redirect()->route('history.index');
    }


    public function destroy($id)
    {
        History::destroy($id);

        return redirect('histories')->with('flash_message', 'History deleted!');
    }
}
