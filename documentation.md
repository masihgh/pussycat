# Welcome to the PussyCat FrameWork ᓚᘏᗢ


a framework for WebDevelop based on the mvc structure.
The name of this project for Fun because everyone can use it. Completely simple and powerful structure for all your projects

## Starting an application using this framework

1. First, download the framework, either directly or by cloning the repo.
1. Run **composer update** to install the project dependencies.
1. Configure your web server to have the **public** folder as the web root.
1. Open [App/Config.php](https://github.com/Masihgh/pussycat/App/Config.php) and enter your database configuration data.
1. Create routes, add controllers, views and models.

See below for more details.

## Configuration

Configuration settings are stored in the [App/Config.php](https://github.com/Masihgh/pussycat/App/Config.php) class. Default settings include database connection data and a setting to show or hide error detail. You can access the settings in your code like this: `Config::DB_HOST`. You can add your own configuration settings in here.

## Routing

The [Router](Core/Router.php) translates URLs into controllers and actions. Routes are added in the [front controller](https://github.com/Masihgh/pussycat/public/index.php). A sample home route is included that routes to the `index` action in the [Home controller](https://github.com/Masihgh/pussycat/App/Controllers/Home.php).

Routes are added with the `add` method. You can add fixed URL routes, and specify the controller and action, like this:

```php
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('posts/index', ['controller' => 'Posts', 'action' => 'index']);
```

Or you can add route **variables**, like this:

```php
$router->add('{controller}/{action}');
```

In addition to the **controller** and **action**, you can specify any parameter you like within curly braces, and also specify a custom regular expression for that parameter:

```php
$router->add('{controller}/{id:\d+}/{action}');
```

You can also specify a namespace for the controller:

```php
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);
```

## Controllers

Controllers respond to user actions (clicking on a link, submitting a form etc.). Controllers are classes that extend the [Core\Controller](https://github.com/Masihgh/pussycat/Core/Controller.php) class.

Controllers are stored in the `App/Controllers` folder. A sample [Home controller](https://github.com/Masihgh/pussycat/App/Controllers/Home.php) included. Controller classes need to be in the `App/Controllers` namespace. You can add subdirectories to organise your controllers, so when adding a route for these controllers you need to specify the namespace (see the routing section above).

Controller classes contain methods that are the actions. To create an action, add the **`Action`** suffix to the method name. The sample controller in [App/Controllers/Home.php](https://github.com/Masihgh/pussycat/App/Controllers/Home.php) has a sample `index` action.

You can access route parameters (for example the **id** parameter shown in the route examples above) in actions via the `$this->route_params` property.

### Action filters

Controllers can have **before** and **after** filter methods. These are methods that are called before and after **every** action method call in a controller. Useful for authentication for example, making sure that a user is logged in before letting them execute an action. Optionally add a **before filter** to a controller like this:

```php
/**
 * Before filter. Return false to stop the action from executing.
 *
 * @return void
 */
protected function before()
{
}
```

To stop the originally called action from executing, return `false` from the before filter method. An **after filter** is added like this:

```php
/**
 * After filter.
 *
 * @return void
 */
protected function after()
{
}
```

## Views

Views are used to display information (normally HTML). View files go in the `App/Views` folder. Views can be in one of two formats: standard PHP, but with just enough PHP to show the data. No database access or anything like that should occur in a view file. You can render a standard PHP view in a controller, optionally passing in variables, like this:

```php
View::render('Home/index.php', [
    'name'    => 'Dave',
    'colours' => ['red', 'green', 'blue']
]);
```

The second format uses the [Twig](https://twig.symfony.com/) templating engine. Using Twig allows you to have simpler, safer templates that can take advantage of things like [template inheritance](https://twig.symfony.com/doc/templates.html#template-inheritance). You can render a Twig template like this:

```php
View::renderTemplate('Home/index.html', [
    'name'    => 'Dave',
    'colours' => ['red', 'green', 'blue']
]);
```

A sample Twig template is included in [App/Views/Home/index.html](https://github.com/Masihgh/pussycat/App/Views/Home/index.html) that inherits from the base template in [App/Views/base.html](App/Views/base.html).

### Import Files
in config file set app_url
in public folder for example assets,storage folder
{{ dir }} in view linked to app_url
#### link css file
```html
<link rel="stylesheet" href="{{ dir }}assets/css/main.css">
```
#### link js file
```html
<script src="{{ dir }}assets/js/mai.js"></script>
```

## Models

Models are used to get and store data in your application. They know nothing about how this data is to be presented in the views. Models extend the `Core\Model` class and use [PDO](http://php.net/manual/en/book.pdo.php) to access the database. They're stored in the `App/Models` folder. A sample user model class is included in [App/Models/User.php](https://github.com/Masihgh/pussycat/App/Models/User.php). You can get the PDO database connection instance like this:

```php
$db = static::getDB();
```
### Use Models in Controllers
#### Step 1 - use
```php
use App\Models\User;
```
User Name of Models
#### Step 2 - use
```php
$Users = User::getAll();
```
## Errors

If the `SHOW_ERRORS` configuration setting is set to `true`, full error detail will be shown in the browser if an error or exception occurs. If it's set to `false`, a generic message will be shown using the [App/Views/404.html](https://github.com/Masihgh/pussycat/App/Views/404.html) or [App/Views/500.html](https://github.com/Masihgh/pussycat/App/Views/500.html) views, depending on the error.

## Web server configuration

Pretty URLs are enabled using web server rewrite rules. An [.htaccess](https://github.com/Masihgh/pussycat/public/.htaccess) file is included in the `public` folder. Equivalent nginx configuration is in the [nginx-configuration.txt](https://github.com/Masihgh/pussycat/nginx-configuration.txt) file.

---
