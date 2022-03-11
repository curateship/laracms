<?php

namespace App\Http\Controllers\Admin;

// Others
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

// Models
use App\Models\Post;
use App\Models\User;
use App\Models\Category;

// Support
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Imagick;

class AdminVideoController extends Controller
{
    private $rules = [
        'name' => 'required|min:3|max:30',
    ];

    // Index
    public function index()
    {
        return view('admin.videos.index');
    }

    // Create
    public function create()
    {
        return view('admin.videos.create');
    }
}