<?php

namespace App\Http\Controllers\User;

use App\Models\Generalsetting;
use App\Models\User;
use Illuminate\Http\Request;
use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use Session;
use DB;
use App;


class ForgotController extends Controller
{

    public function __construct()
        {
            $this->middleware('guest');
             $this->gs = DB::table('generalsettings')->find(1);
    
            // Set Global PageSettings
    
            $this->ps = DB::table('pagesettings')->find(1);
    
            $this->middleware(function ($request, $next) {
    
                // Set Global Language
    
                if (Session::has('language')) 
                {
                    $this->language = DB::table('languages')->find(Session::get('language'));
                }
                else
                {
                    $this->language = DB::table('languages')->where('is_default','=',1)->first();
                }  
                view()->share('langg', $this->language);
                App::setlocale($this->language->name);
        
                // Set Global Currency
        
                if (Session::has('currency')) {
                    $this->curr = DB::table('currencies')->find(Session::get('currency'));
                }
                else {
                    $this->curr = DB::table('currencies')->where('is_default','=',1)->first();
                }
        
                // Set Popup
        
                if (!Session::has('popup')) 
                {
                    view()->share('visited', 1);
                }
                Session::put('popup' , 1);
    
    
                return $next($request);
            });
        }


    public function showForgotForm()
    {
       $this->code_image();
      return view('user.forgot');
    }

    public function forgot(Request $request)
    {
      $gs = Generalsetting::findOrFail(1);
      $input =  $request->all();
      if (User::where('email', '=', $request->email)->count() > 0) {
      // user found
      $admin = User::where('email', '=', $request->email)->firstOrFail();
      $autopass = str_random(8);
      $input['password'] = bcrypt($autopass);
      $admin->update($input);
      $subject = __("Reset Password Request");
      $msg = __("Your New Password is : ").$autopass;
      if($gs->is_smtp == 1)
      {
          $data = [
                  'to' => $request->email,
                  'subject' => $subject,
                  'body' => $msg,
          ];

          $mailer = new GeniusMailer();
          $mailer->sendCustomMail($data);                
      }
      else
      {
        $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
        mail($request->email,$subject,$msg,$headers);  
      }
      
      return response()->json(__('Your Password Reseted Successfully. Please Check your email for new Password.'));
      }
      else{
      // user not found
      return response()->json(array('errors' => [ 0 => __('No Account Found With This Email.') ]));    
      }  
    }

    // Capcha Code Image
    private function  code_image()
    {
        $actual_path = str_replace('project','',base_path());
        $image = imagecreatetruecolor(200, 50);
        $background_color = imagecolorallocate($image, 255, 255, 255);
        imagefilledrectangle($image,0,0,200,50,$background_color);

        $pixel = imagecolorallocate($image, 0,0,255);
        for($i=0;$i<500;$i++)
        {
            imagesetpixel($image,rand()%200,rand()%50,$pixel);
        }

        $font = base_path('../assets/front/fonts/NotoSans-Bold.ttf');
        $allowed_letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $length = strlen($allowed_letters);
        $letter = $allowed_letters[rand(0, $length-1)];
        $word='';
        //$text_color = imagecolorallocate($image, 8, 186, 239);
        $text_color = imagecolorallocate($image, 0, 0, 0);
        $cap_length=6;// No. of character in image
        for ($i = 0; $i< $cap_length;$i++)
        {
            $letter = $allowed_letters[rand(0, $length-1)];
            imagettftext($image, 25, 1, 35+($i*25), 35, $text_color, $font, $letter);
            $word.=$letter;
        }
        $pixels = imagecolorallocate($image, 8, 186, 239);
        for($i=0;$i<500;$i++)
        {
            imagesetpixel($image,rand()%200,rand()%50,$pixels);
        }
        session(['captcha_string' => $word]);
        imagepng($image, base_path('../assets/images/capcha_code.png'));
    }

}
