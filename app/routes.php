<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	// return View::make('hello');
    echo "lets do queueing with redis\n";

    $queue = Queue::push('LogMessage', array('message' => 'Date: '.date('y-m-d h:i:sa')));

    var_dump($queue);
});

class LogMessage {
    public function fire($job, $data)
    {
        File::append(app_path().'/queue.txt', $data['message'].PHP_EOL);

        $job->delete();
    }
}
