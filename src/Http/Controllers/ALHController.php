<?php
/*
*       ____                        __                    _
*      / __ \  ___  _   __  ___    / /  ____    ____ _   (_)   _  __
*     / / / / / _ \| | / / / _ \  / /  / __ \  / __ `/  / /   | |/_/
*    / /_/ / /  __/| |/ / /  __/ / /  / /_/ / / /_/ /  / /   _>  <
*   /_____/  \___/ |___/  \___/ /_/   \____/  \__, /  /_/   /_/|_|
*                                         /____/
*  ___________________________________________________________________
* | Author:     Develogix Agency e.U. - Raphael Planer
* | E-Mail:     office@develogix.at
* | Project:    test-alh
* | Filename:   Controller.php
* | Created:    23.03.2023 (15:59:48)
* | Copyright (C) 2023 Develogix Agency e.U. All Rights Reserved
* | Website:    https://develogix.at
*/

namespace DevRaeph\ALH\Http\Controllers;

use DevRaeph\ALH\Models\AlhLog;
use Illuminate\Http\Request;

class ALHController extends Controller
{
    public function index(Request $request)
    {
        $term = null;
        if (isset($request->search) && ($request->search != '' && $request->search != null)) {
            $term = $request->search;
            $allLogs = AlhLog::where('message', 'like', '%'.$request->search.'%')->orderByDesc('id')->paginate(10);
        } else {
            $allLogs = AlhLog::orderByDesc('id')->paginate(10);
        }

        return view('alh::alh.index', ['logs' => $allLogs, 'term' => $term]);
    }

    public function show(Request $request)
    {
        //
    }
}
