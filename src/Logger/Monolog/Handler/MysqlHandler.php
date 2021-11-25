<?php

namespace Logger\Monolog\Handler;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;

class MysqlHandler extends AbstractProcessingHandler
{
    protected $table;
    protected $connection;

    public function __construct($level = Logger::DEBUG, $bubble = true)
    {
        $this->table      = 'api_logs';
        $this->connection = 'mysql';

        parent::__construct($level, $bubble);
    }

    protected function write(array $record) : void
    {
        $data = [
//            'instance'    => gethostname(),
//            'channel'     => $record['channel'],
            'level'       => $record['level'],
            'request'     => $record['message'],
            'context'     => $record['context'],
//            'level_name'  => $record['level_name'],
//            'remote_addr' => isset($_SERVER['REMOTE_ADDR'])     ? ip2long($_SERVER['REMOTE_ADDR']) : null,
//            'user_agent'  => isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT']      : null,
            'created_by'  => $record['context']['user_id'] ?? null,
            'created_at'  => $record['datetime']->format('Y-m-d H:i:s')
        ];

        DB::connection($this->connection)->table($this->table)->insert($data);
    }
}
