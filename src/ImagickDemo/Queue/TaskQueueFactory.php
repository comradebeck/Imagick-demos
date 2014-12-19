<?php


namespace ImagickDemo\Queue;

use ImagickDemo\Queue\TaskQueue;
use Auryn\Provider as Injector;


class TaskQueueFactory {

    private $injector;
    
    function __construct(Injector $injector) {
        $this->injector = $injector;
    }
    
    /**
     * @return TaskQueue
     */
    function createTaskQueue() {
        return $this->injector->make(TaskQueue::class);
    }
}
