<?php

namespace Bitfumes\Multiauth\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Bitfumes\Multiauth\Model\Admin;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Category;
use App\Religion;
use App\Board;
use App\Course;
use App\Student;
class AdminController extends Controller
{
    use AuthorizesRequests;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('role:super', ['only'=>'show']);
        $this->adminModel = config('multiauth.models.admin');
    }

    public function index()
    {
        $countCategory=Category::all()->count();
        $countReligion=Religion::all()->count();
        $countBoard=Board::all()->count();
        $countCourse=Course::all()->count();
        $countStudent=Student::all()->count();
        $smsBalance="Searching..";
        return view('multiauth::admin.home',compact('countCategory','countReligion','countBoard','countCourse','smsBalance','countStudent'));
    }


    public function show()
    {
        $admins = Admin::where('id', '!=', auth()->id())->get();

        return view('multiauth::admin.show', compact('admins'));
    }

    public function showChangePasswordForm()
    {
        return view('multiauth::admin.passwords.change');
    }

    public function changePassword(Request $request)
    {
        $data = $request->validate([
            'oldPassword'   => 'required',
            'password'      => 'required|confirmed',
        ]);
        auth()->user()->update(['password' => bcrypt($data['password'])]);

        return redirect(route('admin.home'))->with('message', 'Your password is changed successfully');
    }
}
