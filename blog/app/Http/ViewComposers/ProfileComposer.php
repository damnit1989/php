<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
// use Illuminate\Users\Repository as UserRepository;

class ProfileComposer {

    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $users;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    {
        // service container 会自动解析所需的参数
        // $this->users = $users;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
		echo 'thisis good';
        $view->with('name', 'thisis 视图组件');
    }

}