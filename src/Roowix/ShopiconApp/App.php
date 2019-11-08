<?php


namespace Roowix\ShopiconApp;

use Roowix\ShopiconApp\DB\DB;
use Roowix\ShopiconApp\Response\ResponseWriter;

class App
{
    /** @var string */
    private $uri;
    /** @var DB */
    private $connect;
    /** @var ResponseWriter */
    private $response;

    public function __construct(DB $dbconn)
    {
        $this->connect = $dbconn;
    }

    public function run(string $uri, string $method, ResponseWriter $response)
    {
        $this->uri = $uri;
        $this->response = $response;

        switch ($method) {
            case 'GET':
                return $this->getAction();
            case 'POST':
                return $this->createAction();
            case 'PUT':
                return $this->updateAction();
            case 'DELETE':
                $inArray = explode("/", $this->uri);    // 'localhost/api/${id}'
                $idArray = ["id" => (int)$inArray[2]];
                return $this->deleteAction($idArray);
            default:
                return null;
        }
    }

    private function getAction()
    {
        $students = $this->connect->takeAll();
        $this->response->write($students);
        return json_encode($students);
    }

    private function createAction()
    {
        $result = $this->connect->insert($_POST);
        $this->response->write($result);
        return json_encode($result);
    }

    private function deleteAction($id)
    {

        $result = $this->connect->delete($id);
        $this->response->write($result);
        return json_encode($result);
    }

    private function updateAction()
    {
        $filter = ["id" => $_POST["id"]];
        $result = $this->connect->update($_POST, $filter);
        $this->response->write($result);
        return json_encode($result);
    }
}