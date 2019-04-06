<?php

namespace IntegralCalculator;

class App
{
    // ########################################

    public function process()
    {
        try {

            $data = (array)json_decode(trim(file_get_contents('php://input')), true);

            $commandManager = (new \IntegralCalculator\Core\Command\Manager\Factory())->create($data);
            $command        = $commandManager->createCommand();

            $command->process();

            echo json_encode($command->getOutput());
        } catch (\Exception $exception) {
            http_response_code(415);
            echo json_encode(["error" => $exception->getMessage()]);

            return;
        }
    }

    // ########################################
}
