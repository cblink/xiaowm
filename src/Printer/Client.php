<?php

namespace Cblink\Xiaowm\Printer;

use Hanson\Foundation\AbstractAPI;
use Psr\Http\Message\RequestInterface;

class Client extends AbstractAPI
{
    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function getStatus($name)
    {
        return $this->post('http://open.xiaowm.com/Api/get_printer_status', $this->getPrinterConfig($name));
    }

    public function sendMessage($name, $text)
    {
        return $this->post('http://open.xiaowm.com/Api/send_msg', $this->getPrinterConfig($name) + ['msg' => $text]);
    }

    public function getMessageStatus($name, $messageId)
    {
        return $this->post('http://open.xiaowm.com/Api/get_msg_status', $this->getPrinterConfig($name) + ['msg_id' => $messageId]);
    }

    public function authorize($name, $password, array $extends = [])
    {
        return $this->post('http://open.xiaowm.com/Auth_api/auth', $this->getPrinterConfig($name) + [
            'app_id' => $this->app->config['app_key'],
            'pwd' => $password,
            'extends' => json_encode($extends),
        ]);
    }

    public function delete($name)
    {
        return $this->post('http://open.xiaowm.com/Auth_api/delete', $this->getPrinterConfig($name));
    }

    protected function getPrinterConfig($name)
    {
        return $this->app->config['printers'][$name];
    }

    protected function post($url, $data)
    {
        $response = $this->getHttp()->post($url, [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'json' => array_merge(['app_key' => $this->app->config['app_key']], $data),
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
