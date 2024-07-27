<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Library;
use App\Models\Log;
use Carbon\Carbon;

class LibraryController extends Controller
{
    public function index()
    {
        $libraries = Library::all();
        // dd($libraries);
        return view('library.index', ['libraries' => $libraries]);
    }

    //書籍貸し出しフォームを表示する
    public function borrowingForm($id)
    {
        $library = Library::find($id);

        return view('library.borrow', [
            'library' => $library,
            'user' => Auth::user(),
        ]);
    }

    //貸出しフォームの情報をもとに、貸出し処理を行う
    public function borrow(Request $request)
    {
        // dd($request);
        $library = Library::find($request->id);

        $library->user_id = Auth::id();
        $library->save();

        $log = new Log();
        $log->library_id = $library->id;
        $log->user_id = $library->user_id;
        $log->rent_date = Carbon::now();
        $log->return_date = null;
        $log->return_due_date = $request->return_due_date;
        $log->save();

        return redirect("/library/index");

    }

    //返却ボタンを押した際に書籍の返却処理
    public function returnBook(Request $request)
    {
        $library = Library::find($request->id);
        $library->user_id = 0;
        $library->save();

        $sql = Log::query();
        $sql->where('user_id', Auth::id());
        $sql->where('library_id', $request->id);
        $sql->where('user_id', Auth::id());
        $sql->orderBy("rent_date", "desc");
        $log = $sql->first();
        $log->return_date = Carbon::now();
        $log->save();

        return redirect("/library/index");

    }   

    //書籍貸し出しフォームを表示する
    public function history()
    {
        $logs = Log::where('user_id', Auth::id())->get();

        return view('library.borrowHistory', [
            'logs' => $logs,
            'user' => Auth::user(),
        ]);
    }
}
