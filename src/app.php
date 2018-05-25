<?php

namespace IntegralCalculator;

use IntegralCalculator\Core\CommandManager\CommandManagerFactory;

class App
{
    public function process()
    {
        try {
            $data = json_decode(trim(file_get_contents('php://input')), true);
$a = 1;
            //todo remove only test data
            /*$data = array(
                'command' => 'calculateIntegral',
                'version' => 1,
  'params' =>
  array (
      'methods' =>
          array (
              0 => 1,
          ),
      'func' =>
          array (
              'func' => 'POW(x, 3)',
              'vars' =>
                  array (
                      0 => 'x',
                  ),
          ),
      'surface' =>
          array (
              'func' => 'SIN(x) * y',
              'vars' =>
                  array (
                      0 => 'x',
                      1 => 'y',
                  ),
          ),
      'xMin' => -5,
      'xMax' => 5,
  ),
);*/

            $commandManager = (new CommandManagerFactory())->create($data);
            $command        = $commandManager->createCommand();

            $command->process();

            echo json_encode($command->getOutput());

        } catch (\Exception $exception) {
            http_response_code(415);
            echo json_encode(["error" => $exception->getMessage()]);
            return;
        }
    }
}