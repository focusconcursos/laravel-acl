<?php

namespace Mahesvaran\LaravelAcl\Commands;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Routing\Route;
use Illuminate\Routing\Router;
use Illuminate\Console\Command;
use Illuminate\Routing\Controller;
use Symfony\Component\Console\Input\InputOption;
use Mahesvaran\LaravelAcl\Models\Permission;

class AclSyncCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'acl:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all registered routes';

    /**
     * The router instance.
     *
     * @var \Illuminate\Routing\Router
     */
    protected $router;

    /**
     * An array of all the registered routes.
     *
     * @var \Illuminate\Routing\RouteCollection
     */
    protected $routes;

    /**
     * Create a new route command instance.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function __construct(Router $router)
    {
        parent::__construct();
        $this->routes = $router->getRoutes();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        if (count($this->routes) == 0) {
            return $this->error("Your application doesn't have any routes.");
        }
        $this->syncDeletedRoutes();
        $this->syncNewRoutes();
    }

    private function syncDeletedRoutes()
    {
        $names = [];
        foreach ($this->routes as $route) {
            $name = $route->getName();
            if (!! $name) {
                $names[] = $name;
            }
        }
        Permission::whereNotIn('name', $names)->delete();
    }

    public function syncNewRoutes()
    {
        foreach ($this->routes as $route) {
            $name = $route->getName();
            if (!! $name) {
                Permission::updateOrCreate([
                    'name' => $name,
                    'description' => $route->getActionName()
                ]);
            }
        }
    }
}
