<?php

declare(strict_types=1);

namespace MyApp\Tasks;

use Phalcon\Cli\Task;

class MainTask extends Task
{
    public function mainAction()
    {
        echo 'This is the default task and the default action' . PHP_EOL;
    }
    public function countAction($a, $b)
    {
        // Only 7 data entries in the database so enter the value btw 0 to 7 only.
        if ($a < 1) {
            $a = 1;
        }
        if ((int)$b - (int)$a < 0) {
            $a = 0;
            $b = 0;
        }
        $data = $this->mongo->data->find([], ['limit' => (int)$b - (int)$a, 'skip' => (int)$a - 1]);
        foreach ($data as $value) {
            echo "[Name: $value[name], Type: $value[type] Year: $value[year]]" . PHP_EOL;
        }
    }
}
