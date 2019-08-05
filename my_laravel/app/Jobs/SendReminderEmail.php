<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\model\visitor;

class SendReminderEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * 任务最大尝试次数。
     *
     * @var int
     */
    public $tries = 5;
      
    /**
     * 任务运行的超时时间。
     *
     * @var int
     */
    public $timeout = 120;
        
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
    
        $visitor = new visitor();
        $visitor->visitor_name = 'aaa';
        $visitor->visitor_phone = '13537663210';
        $visitor->visitor_type = '测试';
        $visitor->member_id = 10;
        $visitor->company_id = 10;
        // $visitor->create_time = date("Y-m-d H:i:s");
        // $visitor->update_time = date("Y-m-d H:i:s");
        if($visitor->save()){
            
        }

    }
}
