<?php

namespace App\Console\Commands;

use App\Mail\email_To_Place;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class DeletePromo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:Minute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This commend will delete service after specific time';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $msg = [
            'massage' =>   'تم رفض تسجيلك في تطبيقنا ، الرجاء محاولة التسجيل مرة أخرى مع إدخال بيانات صحيحية' ,
        ];
        Mail::to('nada@gmail.com')->send(new email_To_Place($msg));   

        // Service::whereRaw('ispromo' , 1)->whereRaw('deleted_at' , '==' , Carbon::now())->delete();
    }
}
