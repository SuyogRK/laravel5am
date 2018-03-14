<?php

namespace App\Http\Controllers\admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserController extends AdminController
{
    public function signup(Request $request)
    {
        if ($request->isMethod('get')) {
            return view($this->adminPath . '.login.signup', $this->data);
        }

        if ($request->isMethod('post')) {
            $this->validate($request, [
                'name' => 'required|min:3',
                'username' => 'required|unique:users,username',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:5|confirmed',
                'upload' => 'mimes:jpeg,jpg,png,gif'

            ]);
            $data['name'] = $request->name;
            $data['username'] = $request->username;
            $data['email'] = $request->email;
            $data['password'] = bcrypt($request->password);

            if ($request->hasFile('upload')) {
                $image = $request->file('upload');
                $ext = $image->getClientOriginalExtension();
                $imageName = str_random() . '.' . $ext;
                $uploadPath = public_path('images/userimages/');

                if ($image->move($uploadPath, $imageName)) {
                    $data['image'] = $imageName;
                }
            }


            if (User::create($data)) {
                return redirect()->route('login')->with('success', 'please login first');
            }

            return redirect()->back();

        }


    }

    public function login_action(Request $request)
    {
        if ($request->isMethod('get')) {
            return redirect()->route('login')->with('success', 'please login first');
        }
        if ($request->isMethod('post')) {
            $username = $request->username;
            $password = $request->password;
            $rememberMe = isset($request->remember) ? true : false;

            if (Auth::attempt(['username' => $username, 'password' => $password], $rememberMe)) {
                return redirect()->intended('admin');

            } else {
                return redirect()->route('login')->with('success', 'there was a problem');
            }


        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function users()
    {
        $userData = User::orderBy('id', 'desc')->get();
        $this->data('title', $this->title('users'));
        $this->data('userData', $userData);
        return view($this->adminPath . 'pages.users', $this->data);
    }

    public function user_search(Request $request)
    {
        if ($request->isMethod('get')) {
            return redirect()->back();
        }

        if ($request->isMethod('post')) {
            $searchData = $request->search_data;
            $userData = DB::table('users')->where('name', 'LIKE', "%$searchData%")
                ->orWhere('username', 'LIKE', "%$searchData%")
                ->orWhere('user_type', 'LIKE', "%$searchData%")
                ->orWhere('email', 'LIKE', "%$searchData%")
                ->get();

            $this->data('userData', $userData);
            return view($this->adminPath . 'pages.users', $this->data);
        }
    }

    public function deleteWithImage($id)
    {
        $criteria = $id;
        $userFind = User::find($criteria);
        $userImage = $userFind->image;
        $imagePath = public_path('images/userimages/' . $userImage);
        if (file_exists($imagePath) && is_file($imagePath)) {
            return unlink($imagePath);

        }

        return true;


    }


    public function user_delete(Request $request)
    {
        $userId = $request->uid;
        $userFind = User::find($userId);
        if ($this->deleteWithImage($userId) && $userFind::where('id', $userId)->delete()) {
            return redirect()->route('users')->with('success', 'user was deleted');

        }
    }


    public function edit_user(Request $request)
    {
        $userId = $request->uid;
        $userData = User::find($userId);
        $this->data('userData', $userData);
        return view($this->adminPath . 'pages.edit_user', $this->data);

    }

    public function edit_user_action(Request $request)
    {
        if ($request->isMethod('get')) {
            return redirect()->back();
        }

        if ($request->isMethod('post')) {
            $userId = $request->user_id;
            $this->validate($request, [
                'name' => 'required|min:3',
                'username' => 'required|', [
                    Rule::unique('users', 'username')->ignore($userId)
                ],
                'email' => 'required|email|', [
                    Rule::unique('users', 'email')->ignore($userId)

                ],
                'upload' => 'mimes:jpeg,jpg,png,gif'

            ]);
            $data['name'] = $request->name;
            $data['username'] = $request->username;
            $data['email'] = $request->email;

            if ($request->hasFile('upload')) {
                $image = $request->file('upload');
                $ext = $image->getClientOriginalExtension();
                $imageName = str_random() . '.' . $ext;
                $uploadPath = public_path('images/userimages/');

                if ($this->deleteWithImage($userId) && $image->move($uploadPath, $imageName)) {
                    $data['image'] = $imageName;
                }
            }


            if (User::where('id', $userId)->update($data)) {
                return redirect()->route('users')->with('success', 'data was updated');
            }

            return redirect()->back();

        }

    }

    public function update_status(Request $requeste)
    {
        if ($requeste->isMethod('get')) {
            return redirect()->back();
        }

        if ($requeste->isMethod('post')) {
            $userId = $requeste->user_id;

            if (isset($_POST['admin'])) {
                $data['user_type'] = 'user';
                $message = 'user was user';
            }

            if (isset($_POST['user'])) {
                $data['user_type'] = 'admin';
                $message = 'user was admin';
            }

            if (User::where('id', $userId)->update($data)) {
                return redirect()->route('users')->with('success', $message);
            }

        }

    }
}
