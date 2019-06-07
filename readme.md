# Author
PATRISSOL KENFACK

Created by PatrissolJuns

[Github](https://github.com/PatrissolJuns) | [E-Mail](mailto:patrissolkenfack@gmail)

## About JunsPHP

JunsPHP is a new web application framework with a new vision of development in php. This framework will help you bluiding powerful application with smallest code.

JunsPHP like others framework implements MVC architecture and brings out the powerful side of it.


## How to use JunsPHP

Since JunsPHP is using MVC architecture, the usage is a little bit similar than other framework such as Laravel, Symfony and so on.

This framework use concept like routing, Controller, Model, View and later soon Template Engine.

### The Routing
 
All about routing is found into `Routes/routes` file. 

If you want to and a `get` request to the controller `ThingController` and the action `index`, just add this code into `Routes/routes`

```php
Router::get('/thing/index', 'ThingController@index');
```
This will be available at the route `/thing/index`

This is the same thing for all other method

### The Model

All model is found in the folder `Models`. Each Modal extends the Model class which provide a sample of method such as:

```PHP
// findModel($ModelName, $id);

// Example:
findModel("Thing", $id);
```
which will retrieve a particular model passed in parameter.

This is an example of a Model

```PHP
class Thing extends Model
{
    public $title;
    public $description;
    
    public function find($id){
        return $this->findModel("Thing", $id);
    }
    public function findAll(){
        return $this->findModelAll("Thing");
    }
    public function save()
    {
        return $this->saveModel("thing", ['title', 'description'], [$this->title, $this->description]);
    }
}
```

**Note:** please open this file `Core/Model` to get all the methods available.

### The Controller

the controllers are found in the folder `Controllers` and their goal is to execute different action. 

The syntax is very similar to a normal php file just that it may include Model and other folder.

here is an example of controller file

```PHP
require(ROOT . 'Models/Thing.php');

class ThingController extends Controller
{
    public function __construct($request)
    {
        parent::__construct($request);
    }
    
    function index()
    {
        $thing = new Thing();
		
		// data to send
        $data['things'] = $thing->findAll();
        
        return View::render("thing/index", $data);
    }
    function create()
    {
        return View::render("thing/create");
    }

    function save()
    {
        if ($this->request->getMethod() == 'POST')
        {
            $thing= new Thing();
			
            $thing->title = $this->request->getParams()['title'];
			
            $thing->description = $this->request->getParams()['description'];
			
            if ($thing->save())
            {
                $this->redirect("thing/index");
            }
        }
    }
}
```

**Note:** Here we have definded a constructor in order to be able to access information about request so a controller must have this constructor.

### The View

The view in this framework are found in `Views`.

Since we have yet include a template engine, the manipulation of variable is done directly in PHP code.

If you pass a variable from the controller to a view trough a table like this example up so, that variable will be directly accessible form the views.

Still continuos our example of Thing, here is a way to display a list of things:

```PHP
<h1>Thing</h1>
<div class="row col-md-12 centered">
    <a href="/Rant/thing/create">Create</a>
    <table class="table table-striped custab">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
        </tr>
        </thead>
        <?php
        print_r($things);
        foreach ($things as $thing)
        {
        ?>
            <tr>
            <td><?php print_r($thing['id'])?></td>
            <td><?php echo $thing['title']?></td>
            <td><?php echo $thing['description']?></td>
            </tr>
        <?php
        }
        ?>
    </table>
</div>
```

### DATABASE Connection

All the configuration about the database is inside `Config/Database` file.

You just need to change the database credentials in orrder to match your own.


## Contributing

I will be very happy if you can contribute for this framework in order to bluit a more powerful framework.

Do not hesitate to contact me at my email `patrissolkenfack@gmail.com`.

## License

JunsPHP is a open source project under the [MIT license](https://opensource.org/licenses/MIT).