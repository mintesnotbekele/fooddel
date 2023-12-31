<?php

namespace App\Mail;

use App\CentralLogics\Helpers;
use App\Models\BusinessSetting;
use App\Models\EmailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserOfflinePaymentMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $status;
    protected $name;

    public function __construct($name,$status)
    {
        $this->status = $status;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $company_name = BusinessSetting::where('key', 'business_name')->first()->value;
        $sub=translate('Payment_approved');
        $status = $this->status;
        if($status == 'approved'){
            $data=EmailTemplate::where('type','user')->where('email_type', 'offline_payment_approve')->first();
        }elseif($status == 'denied'){
            $sub=translate('Payment_denied');
            $data=EmailTemplate::where('type','user')->where('email_type', 'offline_payment_deny')->first();
        }
        $template=$data?$data->email_template:5;

        $url = '';
        $restaurant_name = $this->name;
        $title = Helpers::text_variable_data_format( value:$data['title']??'',restaurant_name:$restaurant_name??'');
        $body = Helpers::text_variable_data_format( value:$data['body']??'',restaurant_name:$restaurant_name??'');
        $footer_text = Helpers::text_variable_data_format( value:$data['footer_text']??'',restaurant_name:$restaurant_name??'');
        $copyright_text = Helpers::text_variable_data_format( value:$data['copyright_text']??'',restaurant_name:$restaurant_name??'');
        return $this->subject($sub)->view('email-templates.new-email-format-'.$template, ['company_name'=>$company_name,'data'=>$data,'title'=>$title,'body'=>$body,'footer_text'=>$footer_text,'copyright_text'=>$copyright_text,'url'=>$url]);
    }
}
