<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class CreateService extends GeneratorCommand
{
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Service';

    /**
     * 
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub(){
        return base_path('stubs/service.stub');
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace){
        return $rootNamespace . '\Services';
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceClass($stub, $name){
        $class = str_replace($this->getNamespace($name).'\\', '', $name);

        return str_replace('DummyService', $class, $stub);
    }
    
}
