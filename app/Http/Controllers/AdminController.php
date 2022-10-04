<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //change password page
    public function changePasswordPage()
    {
        return view('admin.account.change');
    }
    //change password
    public function changePassword(Request $request)
    {
        $this->passwordValidationCheck($request);

        $currentUserid = Auth::user()->id;
        $user = User::select('password')->where('id', $currentUserid)->first();
        $dbHashValue = $user->password; //hash value
        $data = [
            'password' => Hash::make($request->newPassword),
        ];
        if (Hash::check($request->oldPassword, $dbHashValue)) {
            User::where('id', $currentUserid)->update($data);

            return back()->with(['changeSuccess' => 'Password Changed. . . ']);
        }
        return back()->with(['notMatch' => 'Old password doest not match. Try again']);

    }
    // direct admin detail page
    public function detail()
    {
        return view('admin.account.details');
    }
    //direct admin profile pgae
    public function edit()
    {
        return view('admin.account.edit');
    }
    //admin change role page
    public function chagneRolePage($id)
    {
        $user = User::where('id', $id)->first();
        return view('admin.account.roleChange', compact('user'));
    }
    public function chagneRole(Request $request, $id)
    {
        $data = [
            'role' => $request->role,
        ];
        User::where('id', $id)->update($data);
        return redirect()->route('admin#list')->with(['success' => 'update success']);
    }

    public function update(Request $request, $id)
    {
        $this->accountValidationCheck($request);
        $data = $this->getUserDate($request);

        if ($request->hasFile('image')) {
            $dbImage = User::where('id', $id)->first();
            $dbImage = $dbImage->image;

            if ($dbImage != null) {
                Storage::delete('public/' . $dbImage);
            }
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }

        User::where('id', $id)->update($data);
        return \redirect()->route('admin#details')->with(['success' => ' Update Success']);
    }
    //direct admin listpage
    function list() {
        $admins = User::when(request('Key'), function ($query) {
            $searchKey = request('Key');
            $query->orWhere('name', 'like', '%' . $searchKey . '%')
                ->orWhere('email', 'like', '%' . $searchKey . '%')
                ->orWhere('address', 'like', '%' . $searchKey . '%')
                ->orWhere('phone', 'like', '%' . $searchKey . '%')
                ->orWhere('gender', 'like', '%' . $searchKey . '%');
        })->paginate(3);
        $admins->appends(request()->all());
        return view('admin.account.list', compact('admins'));
    }
    public function ajaxChangeRole(Request $request)
    {

        // logger($request->all());
        User::where('id', $request->adminId)->update([
            'role' => $request->currentRole,
        ]);
    }

    private function accountValidationCheck($request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'address' => 'required',
        ])->validate();
    }
    // get user data
    private function getUserDate($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
        ];
    }
    private function passwordValidationCheck($request)
    {
        Validator::make($request->all(), [
            'oldPassword' => 'required|min:6|max:10',
            'newPassword' => 'required|min:6|max:10',
            'confirmPassword' => 'required|min:6|same:newPassword',
        ])->validate();
    }
}
