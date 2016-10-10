<?php

class HomeController extends Controller
{
    /*
    |------------------------------------------------------------------------------
    | Output the view:
    |------------------------------------------------------------------------------
    |
    | $this->view(string 'name_of_the_view', array data{optional});
    | $this->view->data(array data{optional})->show(string 'name_of_the_view');
    |
    |------------------------------------------------------------------------------
    | Redirect:
    |------------------------------------------------------------------------------
    |
    | $this->redirect('url/param');
    | $this->redirect('/'); || $this->redirect(); // redirects to root
    |
    |------------------------------------------------------------------------------
    | Factoring:
    |------------------------------------------------------------------------------
    |
    | $this->class->method();
    |
    |------------------------------------------------------------------------------
    | Pagination:
    |------------------------------------------------------------------------------
    |
    | $this->paginate->make((int)$perPage, new Model);
    |
    | $posts = $this->paginator->make(4, $this->post); || $posts = $this->paginator->post(4);
    |
    | bind to container (/config/providers.php):
    |
    | $this->bind('paginatePosts', function () {
    |     $paginate = new Paginator(4, new Post);
    |     $paginate = $paginate->setUlClass('pagination-sm')->make();
    |     return $paginate;
    | });
    | call from container: $posts = $this->paginatePosts;
    |
    | blade loop:
    |     @foreach($posts->collection as $post)
    |         <h2>{{$post->heading}}</h2>
    |     @endforeach
    |
    | blade links:  {!!$posts->links!!}
    |
    |------------------------------------------------------------------------------
    | Flash messages:
    |------------------------------------------------------------------------------
    |
    | set: flash()->success('Message');
    | blade: {!!flash()!!}
    |------------------------------------------------------------------------------
     */
    public function index($param = null)
    {
        $param = $this->model->test($param);
        $note = 'Wellcome !';
        // $users = $this->paginateUsers;
        $users = paginate(4)->user();
        return view('wellcome', compact('param', 'note', 'users'));
    }

    public function flash()
    {
        flash()->success('This is a flash message !!!');
        return redirect();
    }
}
