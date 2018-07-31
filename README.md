
$app = new Cblink\Xiaowm\Printer([
    'app_key' => '应用编号',
    'printers' => [ // 配置多个打印机
        'office-01' => [
            'number' => '打印机编号',
            'token' => '打印机 Token',
        ],
    ],
]);

获取打印机状态 $app->getStatus('office-01')

打印消息 sendMessage('office-01', string $text)

获取消息打印状态 getMessageStatus('office-01', $messageId)

打印机授权 authorize('office-01', $password, array $extends = [])

删除打印机 delete('office-01')
