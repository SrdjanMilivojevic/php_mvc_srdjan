# Php_mvc_srdjan - feather light PHP framework
<hr>
#Usage:
<br>
##Uses flexibile automatic routing:
	www.domen.com/controller/action/param1/param2/
 	www.domen.com/controller/param1/param2/
 	www.domen.com/action/param1/param2/
 	www.domen.com/param1/param2/
 	www.domen.com/action/
 	www.domen.com/

###Defalut Routing
Set the default controller and default method <br>
<b>Settings:</b><br>
/config/app.php<br>
```
'routes' => [

        'HomeController' => 'index',

    ]
```
<hr>
###Utilizes Laravel's Eloquent ORM 
<b>Settings:</b><br>
/config/database.php <br>
<b>Migrations:</b><br>
/database/* <br>
```
$ php db migrate
$ php db seed
$ php db migrate --seed
```
###Dependency injection
/config/di.php
```
$this->bind('name', function() {
	//
});
```
in the controller:
```
$this->name->someMethod();
```
<hr>
###Controller
<b>Output the view:</b><br>
```
return $this->view((string)'name_of_the_view', (array)data{optional});
return view((string)'name_of_the_view', (array)data{optional});
```
<br>
<b>Redirect:</b><br>
```
$this->redirect('url/param');
$this->redirect('/'); || $this->redirect(); // redirects to root
redirect()  // helper function
```
<br>
<b>Factoring:</b><br>
```
$this->class->someMethodOfThatClass();
```
<br>
<b>Flash messages:</b><br>
```
set: $this->flashMessages->success('Message'); || flash()->success('Message');

get: {!!flash()!!}
```
<b>Pagination:</b><br>
```
$this->paginator->make((int)$perPage, new Model); || paginate(_constructor_)->make();
```
Example:
```
$posts = $this->paginator->make(4, $this->post); || $posts = $this->paginator->post(4); ||
$posts = paginate(4)->post();
```
You can use setUlClass() method to set the class for the pagination 'ul' element.<br>
You have an id="pagination" already set:
```
$paginate->setUlClass('pagination-sm')->make(2);
```
Also, you can bind all of this or some parts to the container:
```
$this->bind('paginatePosts', function () {
        $paginate = new Paginate(4, new Post);
        $paginate = $paginate->setUlClass('pagination-sm')->make();
        return $paginate;
    });
```
in the controller just call:
```
$posts = $this->paginatePosts;
```
anoter example:
```
$this->bind('paginate', function () {
        $paginate = new Paginate();
        return $paginate = $paginate->setUlClass('pagination-sm someOtherClass');
    });
---------------------
$posts = paginate()->post(6);
```
Set the pagination url prefix (default is 'pg_'):
/config/app.php
```
 'urlPrefix' => 'pg_',
 ```
 <b>In view (blade):</b><br>
 loop:
 ```
    @foreach($posts->collection as $post)
        <h2>{{$post->heading}}</h2>
    @endfoeach
```
links:
```
{!!$posts->links!!}
```
<br>
###Uses Blade templating engine thanks to XiaoLer!
still uder development