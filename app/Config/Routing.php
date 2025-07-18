<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * Routing configuration
 */
class Routing extends BaseConfig
{
    /**
     * An array of directories to look in for controllers.
     * They must be in the order that you'd like them
     * searched.
     *
     * @var array<string>
     */
    public array $controllers = [];

    /**
     * The default method to use within the controller
     * if one is not specified.
     */
    public string $defaultMethod = 'index';

    /**
     * The default namespace to look for controllers in.
     */
    public string $defaultNamespace = 'App\Controllers';

    /**
     * The default controller to use if one is not specified.
     */
    public string $defaultController = 'Home';

    /**
     * Determines if the RouteCollection should translate
     * dashes in URIs to underscores in controller/method names.
     */
    public bool $translateURIDashes = false;

    /**
     * Determines if the routing should match on exact case.
     * If false, routes will be case-insensitive.
     */
    public bool $autoRoute = true;

    /**
     * Prioritize routes. If TRUE, routes defined with lower priority
     * will be matched before those with higher priority.
     */
    public bool $prioritize = false;

    /**
     * The default HTTP status code to use if no route is found.
     */
    public ?int $override404 = null;

    /**
     * An array of files that should be loaded for defining routes.
     * If empty, only the routes defined in this file will be used.
     *
     * @var array<string>
     */
    public array $routeFiles = [
        APPPATH . 'Config/Routes.php',
    ];

    /**
     * Determines if multiple URI segments should be passed as one parameter.
     * When false, URI segments are passed as separate parameters.
     * When true, all segments after the method are passed as a single parameter.
     */
    public bool $multipleSegmentsOneParam = false;
}