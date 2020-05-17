<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneralSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('general_settings')->insert([
            'sitename'                    => 'Emosbest',
            'cur_text'                    => 'NGN',
            'cur_sym'                     => '₦',
            'efrom'                       => 'noreply@emosbest.com',
            'etemp'                       => '<br style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;;"><br style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;;"><div class="contents" style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; max-width: 600px; margin: 0px auto; border: 2px solid rgb(0, 0, 54);"><div class="header" style="background-color: rgb(0, 0, 54); padding: 15px; text-align: center;"><div class="logo" style="padding: 25px; width: 260px; margin: 0px auto;"><img src="https://i.imgur.com/4NN55uD.png" alt="THESOFTKING" style="width: 210px;">&nbsp;	</div></div><div class="mailtext" style="padding: 30px 15px; background-color: rgb(240, 248, 255); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px; line-height: 26px;">Hi {{name}},&nbsp;<br><br>{{message}}&nbsp;<br><br><br><br></div><div class="footer" style="background-color: rgb(0, 0, 54); padding: 15px; text-align: center;"><a href="https://thesoftking.com/" style="color: rgb(255, 255, 255); background-color: rgb(46, 204, 113); padding: 10px 0px; margin: 10px; display: inline-block; width: 100px; text-transform: uppercase; font-weight: 600; border-radius: 4px;">WEBSITE</a>&nbsp;<a href="https://thesoftking.com/products" style="color: rgb(255, 255, 255); background-color: rgb(46, 204, 113); padding: 10px 0px; margin: 10px; display: inline-block; width: 100px; text-transform: uppercase; font-weight: 600; border-radius: 4px;">PRODUCTS</a>&nbsp;<a href="https://thesoftking.com/contact" style="color: rgb(255, 255, 255); background-color: rgb(46, 204, 113); padding: 10px 0px; margin: 10px; display: inline-block; width: 100px; text-transform: uppercase; font-weight: 600; border-radius: 4px;">CONTACT</a></div><div class="footer" style="background-color: rgb(0, 0, 54); padding: 15px; text-align: center; border-top: 1px solid rgba(255, 255, 255, 0.2);"><span style="font-weight: bolder; color: rgb(255, 255, 255);">© 2011 - 2020 THESOFTKING. All Rights Reserved.</span><p style="color: rgb(221, 221, 221);">TheSoftKing is not partnered with any other company or person. We work as a team and do not have any reseller, distributor or partner!</p></div></div><br style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;;">',
            'smsapi'                      => '',
            'bclr'                        => '2ecc71',
            'sclr'                        => '000036',
            'ev'                          => 0,
            'en'                          => 1,
            'mail_config'                 => '{"name":"php"}',
            'sv'                          => 0,
            'sn'                          => 0,
            'social_login'                => 1,
            'reg'                         => 1,
            'alert'                       => 1,
            'active_template'             => 'tmp2',
            'created_at'                  => \Carbon\Carbon::now(),
            'updated_at'                  => \Carbon\Carbon::now(),
            'matrix_width'                => 5,
            'matrix_height'               => 5,
            'bal_trans_fixed_charge'      => 2,
            'bal_trans_per_charge'        => 5,
            'contact_email'               => 'contact@emosbest.com',
            'contact_address'             => 'Company Location,City, Country',
            'contact_phone'               => '09045867433',
        ]);
    }
}
