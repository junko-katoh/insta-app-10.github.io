<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{
    private $post;
    private $user;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Post $post, User $user)
    {
        $this->post = $post;
        $this->user = $user;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $home_posts = $this->getHomePosts();
        $suggested_users = $this->getSuggestedUsers();
        return view('users.home')->with('home_posts', $home_posts)->with('suggested_users', $suggested_users);
    }

    # get the posts of the users that the auth user follows
    private function getHomePosts()
    {
        $all_posts = $this->post->latest()->get();
        $home_posts = []; //in case the home-posts is empty, it will not return null but empty instead

        foreach($all_posts as $post){
            if ($post->user->isFollowed() || $post->user->id === Auth::user()->id){
                $home_posts[] = $post;
            }
        }

        return $home_posts;
    }

    # get the users that the Auth user is not following
    private function getSuggestedUsers()
    {
        $all_users = $this->user->all()->except(Auth::user()->id);
        $suggested_users = [];

        foreach($all_users as $user)
        {
            if(!$user->isFollowed())
            {
                $suggested_users[] = $user;
            }
        }
        return array_slice($suggested_users, 0, 5);
        // array_slice(x,y,z)
        // x - name of the array
        // y - starting index
        // z - length of the list
    }

    public function search(Request $request)
    {
        $users = $this->user->where('name', 'like', '%'. $request->search . '%')->get();
        return view('users.search')->with('users', $users)->with('search', $request->search);
    }
}
