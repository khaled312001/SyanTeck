<?php

namespace App\Http\Controllers\Auth;

use App\Admin;
use App\Helpers\FlashMsg;
use App\Http\Controllers\Controller;
use App\User;
use Dflydev\DotAccessData\Data;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\BasicMail;
use App\ServiceCity;
use App\ServiceArea;
use App\Country;
use App\SellerVerify;
use Toastr;
use Str;
USE Auth;
use Session;
use DB;
use Twilio\Rest\Client;
use Exception;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
//    protected $redirectTo = '/';
    public function redirectTo(){
        return route('homepage');
    }
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:admin');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:191'],
            'captcha_token' => ['nullable'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],[
            'captcha_token.required' => __('google captcha is required'),
            'name.required' => __('name is required'),
            'name.max' => __('name is must be between 191 character'),
            'email.unique' => __('email is already taken'),
            'email.required' => __('email is required'),
            'password.required' => __('password is required'),
            'password.confirmed' => __('both password does not matched'),
        ]);
    }
    protected function adminValidator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:admins'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['user_name'],
            'phone' => $data['phone'],
            'service_city' => $data['service_city'],
            'service_area' => $data['service_area'],
            'password' => Hash::make($data['password']),
        ]);
        return $user;
    }

    public function userRegister(Request $request)
    {
        if($request->isMethod('post')){

            // check is seller area is required or null
            if($request->get_user_type == 0){
                if(empty(get_static_option('seller_service_area_required'))){
                    // if OTP is enabled
                    if (empty(get_static_option('disable_user_otp_verify'))){
                        $phone_number_unique = Str::replace(['-', ' '], '', $request->phone);
                        $country_code_with_code = '+'.$request->country_code.$phone_number_unique;
                        $existingUser = User::where('phone', $country_code_with_code)->first();
                        if ($existingUser) {
                            return redirect()->back()->withErrors(['phone' => 'Phone number is already taken']);
                        }
                    }

                    // Check if Google data exists
                    $googleData = session('google_register_data', []);
                    $passwordRules = empty($googleData) ? 'required|max:191' : 'nullable|max:191';
                    
                    // Generate unique username from email
                    $baseUsername = explode('@', $request->email)[0];
                    $username = $baseUsername;
                    $counter = 1;
                    while (User::where('username', $username)->exists()) {
                        $username = $baseUsername . '_' . $counter;
                        $counter++;
                    }
                    
                    $validationRules = [
                        'name' => 'required|max:191',
                        'email' => 'required|email|unique:users|max:191',
                        'phone' => 'required|unique:users|max:191',
                        'national_id' => 'required|string|size:10|regex:/^[0-9]{10}$/|unique:users,national_id',
                        'password' => $passwordRules,
                        'service_city' => 'required',
                        'country' => 'required',
                        'department' => 'required|exists:categories,id',
                    ];
                    
                    // Add job application fields validation only for seller/technician
                    if($request->get_user_type == 0) {
                        $validationRules['job_type'] = 'required|string|max:191';
                        $validationRules['experience'] = 'required|string';
                        $validationRules['resume_file'] = 'required|file|mimes:pdf,doc,docx|max:5120'; // 5MB max
                    }
                    
                    $request->validate($validationRules, [
                        'national_id.required' => 'رقم الهوية الوطنية مطلوب',
                        'national_id.size' => 'رقم الهوية الوطنية يجب أن يكون 10 أرقام',
                        'national_id.regex' => 'رقم الهوية الوطنية يجب أن يحتوي على أرقام فقط',
                        'national_id.unique' => 'رقم الهوية الوطنية مستخدم بالفعل. يمكنك التسجيل بحساب واحد فقط لكل رقم هوية',
                    ]);
                }
            }else{
                // if OTP is enabled
                if (empty(get_static_option('disable_user_otp_verify'))){
                    $phone_number_unique = Str::replace(['-', ' '], '', $request->phone);
                    $country_code_with_code = '+'.$request->country_code.$phone_number_unique;
                    $existingUser = User::where('phone', $country_code_with_code)->first();
                    if ($existingUser) {
                        return redirect()->back()->withErrors(['phone' => 'Phone number is already taken']);
                    }
                }

                // Check if Google data exists
                $googleData = session('google_register_data', []);
                $passwordRules = empty($googleData) ? 'required|max:191' : 'nullable|max:191';
                
                // Generate unique username from email
                $baseUsername = explode('@', $request->email)[0];
                $username = $baseUsername;
                $counter = 1;
                while (User::where('username', $username)->exists()) {
                    $username = $baseUsername . '_' . $counter;
                    $counter++;
                }
                
                $request->validate([
                    'name' => 'required|max:191',
                    'email' => 'required|email|unique:users|max:191',
                    'phone' => 'required|unique:users|max:191',
                    'national_id' => 'required|string|size:10|regex:/^[0-9]{10}$/|unique:users,national_id',
                    'password' => $passwordRules,
                    'service_city' => 'required',
                    'service_area' => 'required',
                    'country' => 'required',
                ], [
                    'national_id.required' => 'رقم الهوية الوطنية مطلوب',
                    'national_id.size' => 'رقم الهوية الوطنية يجب أن يكون 10 أرقام',
                    'national_id.regex' => 'رقم الهوية الوطنية يجب أن يحتوي على أرقام فقط',
                    'national_id.unique' => 'رقم الهوية الوطنية مستخدم بالفعل. يمكنك التسجيل بحساب واحد فقط لكل رقم هوية',
                ]);
            }

            $email_verify_tokn = rand(111,999).rand(222,888);
            $user_type = get_static_option('buyer_register_on_off') ==='off' ? 0 : $request->get_user_type;

            if(empty(get_static_option('disable_user_otp_verify'))){
                $user_number = $request->full_number;
            }else{
                $user_number = $request->phone;
            }

            // Prepare specializations for seller/technician
            $specializations = null;
            if($user_type == 0 && $request->has('department') && !empty($request->department)) {
                $specializations = json_encode([(int)$request->department]);
            }
            
            // Handle resume file upload for seller/technician
            $resumeFilePath = null;
            if($user_type == 0 && $request->hasFile('resume_file')) {
                $resumeFile = $request->file('resume_file');
                $resumeDirectory = public_path('assets/uploads/resumes/');
                
                // Create directory if it doesn't exist
                if (!file_exists($resumeDirectory)) {
                    mkdir($resumeDirectory, 0755, true);
                }
                
                $resumeFileName = time() . '_' . uniqid() . '.' . $resumeFile->getClientOriginalExtension();
                $resumeFile->move($resumeDirectory, $resumeFileName);
                $resumeFilePath = 'assets/uploads/resumes/' . $resumeFileName;
            }
            
            // Get Google data from session if exists
            $googleData = session('google_register_data', []);
            
            // Generate unique username from email if not provided
            if (empty($request->username)) {
                $baseUsername = explode('@', $request->email)[0];
                $username = $baseUsername;
                $counter = 1;
                while (User::where('username', $username)->exists()) {
                    $username = $baseUsername . '_' . $counter;
                    $counter++;
                }
            } else {
                $username = $request->username;
            }
            
            $userData = [
                'name' => $request->name,
                'email' => $request->email,
                'username' => $username,
                'phone' => $user_number,
                'national_id' => $request->national_id,
                'password' => !empty($request->password) ? Hash::make($request->password) : Hash::make(\Illuminate\Support\Str::random(16)),
                'service_city' => $request->service_city,
                'service_area' => $request->service_area,
                'country_id' => $request->country,
                'user_type' => $user_type,
                'terms_conditions' =>1,
                'email_verify_token'=> $email_verify_tokn,
                'specializations' => $specializations,
            ];
            
            // Verify by national ID if national_id is provided
            if(!empty($request->national_id)) {
                $userData['verified_by_national_id'] = 1;
            }
            
            // Add job application fields for seller/technician
            if($user_type == 0) {
                $userData['job_type'] = $request->job_type;
                $userData['experience'] = $request->experience;
                $userData['resume_file'] = $resumeFilePath;
            }
            
            // Add Google ID if exists
            if (!empty($googleData['google_id'])) {
                $userData['google_id'] = $googleData['google_id'];
                $userData['email_verified'] = 1; // Mark email as verified for Google users
            }
            
            $user = User::create($userData);
            
            // Clear Google data from session after successful registration
            if (!empty($googleData)) {
                session()->forget('google_register_data');
            }

            if(empty(get_static_option('disable_user_email_verify'))){
                if($user){
                    if($request->get_user_type==0){
                        $user_type = 'seller';
                    }else{
                        $user_type = 'buyer';
                    }

                    try {
                        $message = get_static_option('user_email_verify_message');
                        $message = str_replace(["@name", "@email_verify_tokn"],[$user->name, $email_verify_tokn],$message);
                        Mail::to($user->email)->send(new BasicMail([
                            'subject' => get_static_option('user_email_verify_subject'),
                            'message' => $message
                        ]));

                        $message = get_static_option('user_register_message');
                        $message = str_replace(["@name", "@type","@username","@email"],[$user->name, $user_type, $user->username, $user->email], $message);
                        Mail::to(get_static_option('site_global_email'))->send(new BasicMail([
                            'subject' => get_static_option('user_register_subject') ?? __('New User Registration'),
                            'message' => $message
                        ]));
                        
                        // Send detailed email to admin for seller/technician registration
                        if($user_type == 0) {
                            $adminMessage = "
                                <h2>طلب انضمام جديد لفريق العمل</h2>
                                <p><strong>الاسم:</strong> {$user->name}</p>
                                <p><strong>البريد الإلكتروني:</strong> {$user->email}</p>
                                <p><strong>رقم الهاتف:</strong> {$user->phone}</p>
                                <p><strong>نوع الوظيفة:</strong> {$user->job_type}</p>
                                <p><strong>القسم:</strong> " . ($user->specializations ? json_decode($user->specializations)[0] : 'غير محدد') . "</p>
                                <p><strong>الخبرة والمهارات:</strong></p>
                                <p>{$user->experience}</p>
                                <p><strong>السيرة الذاتية:</strong> " . ($user->resume_file ? '<a href="' . asset($user->resume_file) . '">تحميل الملف</a>' : 'غير مرفوع') . "</p>
                                <p><strong>البلد:</strong> " . ($user->country ? $user->country->country : 'غير محدد') . "</p>
                                <p><strong>المدينة:</strong> " . ($user->city ? $user->city->service_city : 'غير محدد') . "</p>
                            ";
                            
                            Mail::to(get_static_option('site_global_email'))->send(new BasicMail([
                                'subject' => 'طلب انضمام جديد لفريق العمل - ' . $user->name,
                                'message' => $adminMessage
                            ]));
                        }
                    } catch (\Exception $e) {

                    }
                }
            }

            // is OTP is disabled sent user email to opt verification message
            if(empty(get_static_option('disable_user_otp_verify'))) {
                try {
                    if ($user) {
                        $message = __('OTP has been sent on Your Mobile Number: ').$user->phone;
                        Mail::to($user->email)->send(new BasicMail([
                            'subject' => __('New User Registration'),
                            'message' => $message
                        ]));
                    }
                } catch (\Exception $e) {
                }
            }

            if($request->get_user_type==0){
                $last_order_id = DB::getPdo()->lastInsertId();
                SellerVerify::create([
                    'seller_id' => $last_order_id,
                    'status' => 0,
                ]);
            }

            // For Google users, password might be auto-generated, so login directly
            $googleData = session('google_register_data', []);
            if (!empty($googleData['google_id'])) {
                Auth::login($user);
                if($user->user_type==0){
                    return redirect()->route('seller.dashboard');
                }else{
                    return redirect()->route('buyer.dashboard');
                }
            } elseif (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
                if(Auth::user()->user_type==0){
                    return redirect()->route('seller.dashboard');
                }else{
                    return redirect()->route('buyer.dashboard');
                }
            }

            return back()->with([
                'msg' => __('Email or password does not match'),
                'type' => 'danger',
            ]);
        }

        $cities = ServiceCity::where('status', 1)->get();
        $countries = Country::where('status', 1)->get();
        // country codes and convert to JSON format
        $restricted_countries = $countries->pluck('country_code')->toJson();
        
        // Get only 3 categories: Electricity, Plumbing, Air Conditioning
        // First, try to find exact matches in Arabic
        $electricityCategory = \App\Category::where('status', 1)
            ->where(function($query) {
                $query->where('name', 'like', '%كهرباء%')
                      ->orWhere('name', 'like', '%electrical%')
                      ->orWhere('name', 'like', '%electricity%');
            })
            ->orderByRaw("
                CASE 
                    WHEN name LIKE '%كهرباء%' THEN 1
                    WHEN name LIKE '%electrical%' OR name LIKE '%electricity%' THEN 2
                    ELSE 3
                END
            ")
            ->first();
        
        $plumbingCategory = \App\Category::where('status', 1)
            ->where(function($query) {
                $query->where('name', 'like', '%سباكة%')
                      ->orWhere('name', 'like', '%plumbing%');
            })
            ->orderByRaw("
                CASE 
                    WHEN name LIKE '%سباكة%' THEN 1
                    WHEN name LIKE '%plumbing%' THEN 2
                    ELSE 3
                END
            ")
            ->first();
        
        $acCategory = \App\Category::where('status', 1)
            ->where(function($query) {
                $query->where('name', 'like', '%تكييف%')
                      ->orWhere('name', 'like', '%air conditioning%')
                      ->orWhere('name', 'like', '%ac%')
                      ->orWhere('name', 'like', '%hvac%');
            })
            ->orderByRaw("
                CASE 
                    WHEN name LIKE '%تكييف%' THEN 1
                    WHEN name LIKE '%air conditioning%' OR name LIKE '%ac%' OR name LIKE '%hvac%' THEN 2
                    ELSE 3
                END
            ")
            ->first();
        
        // Build categories collection with only the 3 required categories
        $categories = collect();
        if ($electricityCategory) {
            $categories->push($electricityCategory);
        }
        if ($plumbingCategory) {
            $categories->push($plumbingCategory);
        }
        if ($acCategory) {
            $categories->push($acCategory);
        }
        
        // If we don't have all 3, try to get any matching categories as fallback
        if ($categories->count() < 3) {
            $allMatching = \App\Category::where('status', 1)
                ->where(function($query) {
                    $query->where('name', 'like', '%كهرباء%')
                          ->orWhere('name', 'like', '%سباكة%')
                          ->orWhere('name', 'like', '%تكييف%')
                          ->orWhere('name', 'like', '%electrical%')
                          ->orWhere('name', 'like', '%plumbing%')
                          ->orWhere('name', 'like', '%air conditioning%')
                          ->orWhere('name', 'like', '%ac%');
                })
                ->get();
            
            // Group by type and take one from each type
            if (!$electricityCategory) {
                $electricityCategory = $allMatching->filter(function($cat) {
                    return stripos($cat->name, 'كهرباء') !== false || 
                           stripos($cat->name, 'electrical') !== false || 
                           stripos($cat->name, 'electricity') !== false;
                })->first();
                if ($electricityCategory && !$categories->contains('id', $electricityCategory->id)) {
                    $categories->push($electricityCategory);
                }
            }
            
            if (!$plumbingCategory) {
                $plumbingCategory = $allMatching->filter(function($cat) {
                    return stripos($cat->name, 'سباكة') !== false || 
                           stripos($cat->name, 'plumbing') !== false;
                })->first();
                if ($plumbingCategory && !$categories->contains('id', $plumbingCategory->id)) {
                    $categories->push($plumbingCategory);
                }
            }
            
            if (!$acCategory) {
                $acCategory = $allMatching->filter(function($cat) {
                    return stripos($cat->name, 'تكييف') !== false || 
                           stripos($cat->name, 'air conditioning') !== false || 
                           stripos($cat->name, 'ac') !== false ||
                           stripos($cat->name, 'hvac') !== false;
                })->first();
                if ($acCategory && !$categories->contains('id', $acCategory->id)) {
                    $categories->push($acCategory);
                }
            }
        }
        
        // Re-order to ensure correct order: Electricity (1), Plumbing (2), AC (3)
        $orderedCategories = collect();
        
        // Add electricity first
        $electricity = $categories->filter(function($cat) {
            return stripos($cat->name, 'كهرباء') !== false || 
                   stripos($cat->name, 'electrical') !== false || 
                   stripos($cat->name, 'electricity') !== false;
        })->first();
        if ($electricity) {
            $orderedCategories->push($electricity);
        }
        
        // Add plumbing second
        $plumbing = $categories->filter(function($cat) {
            return stripos($cat->name, 'سباكة') !== false || 
                   stripos($cat->name, 'plumbing') !== false;
        })->first();
        if ($plumbing) {
            $orderedCategories->push($plumbing);
        }
        
        // Add AC third
        $ac = $categories->filter(function($cat) {
            return stripos($cat->name, 'تكييف') !== false || 
                   stripos($cat->name, 'air conditioning') !== false || 
                   stripos($cat->name, 'ac') !== false ||
                   stripos($cat->name, 'hvac') !== false;
        })->first();
        if ($ac) {
            $orderedCategories->push($ac);
        }
        
        // Final result: maximum 3 categories, one for each type
        $categories = $orderedCategories->unique('id')->values();
        
        return view('frontend.user.register',compact('cities','countries', 'restricted_countries', 'categories'));
    }



    // user register after opt view page
    public function otpVerification($user_id){
        if(empty(Auth::guard('web')->user()->otp_code)) {
            $user_details = Auth::guard('web')->user();
            /* Generate An OTP */
            $userOtp = $this->generateOtp($user_details->phone ?? 0);
            $this->sendSMS($user_details->phone ?? 0);
        }

        return view('frontend.user.otp-verification', compact('user_id'));
    }

    public function resentOtpCode($user_id){
        if(!empty(Auth::guard('web')->user()->otp_code)) {
            $user_details = Auth::guard('web')->user();
            /* Generate An OTP */
            if($user_details->otp_code && now()->isAfter($user_details->otp_expire_at)){
                $this->generateOtp($user_details->phone);
                $this->sendSMS($user_details->phone);
            }
        }
        return view('frontend.user.otp-verification', compact('user_id'));
    }



    public function emailVerify(Request $request)
    {
        // todo: first check user login with opt 2nd check user register with OTP
        if (!empty($request->phone)){
            $user_details = User::where('phone', $request->phone)->first();
        }else{
            $user_details = Auth::guard('web')->user();
        }

        // todo: if request is post and user otp code not null and null then code exit
        if($request->isMethod('get')) {
            if (empty(get_static_option('disable_user_otp_verify'))) {
                if(empty(Auth::guard('web')->user()->otp_code)) {
                    /* Generate An OTP */
                    $userOtp = $this->generateOtp($user_details->phone);
                    $this->sendSMS($user_details->phone);
                    return redirect()->route('otp.verification', ['user_id' => $user_details->id])->with('success', __("OTP has been sent on Your Mobile Number."));
                }
            }
        }


        // input code
        if($request->isMethod('post')){
            // if email and OTP is required
            if(empty(get_static_option('disable_user_otp_verify'))){
                $request->validate([
                    'otp_code' => 'required|max:191'
                ]);

                if($request->otp_code == ''){
                    return  back();
                }

                // todo: first check user login with opt 2nd check user register with OTP
                if (!empty($request->phone)) {
                    $userOtp = User::where('phone', $request->phone)->first();
                }else{
                    $userOtp = User::where('id', $request->user_id)->where('otp_code', $request->otp_code)->first();
                }

                // todo: validation (01:empty) (02:not match) (03:time expire)
                $now = now();

                if (empty($userOtp)) {
                    return redirect()->route('otp.verification', ['user_id' => $user_details->id])->with(['msg' => __('Your OTP is not correct.') ,'type' => 'danger' ]);
                }elseif(!empty($request->phone)) {
                    if ($userOtp->otp_code != $request->otp_code){
                        return redirect()->back()->with([
                            'msg' => __('Your OTP is not correct.'),
                            'type' => 'danger'
                        ]);
                    }

                    if ($request->otp_code == null){
                        return redirect()->back()->with([
                            'msg' => __('Your OTP is not correct.'),
                            'type' => 'danger'
                        ]);
                    }

                    if ($userOtp && $now->isAfter($userOtp->otp_expire_at)){
                        return redirect()->back()->with([
                            'msg' => __('Your OTP has been expired.'),
                            'type' => 'danger'
                        ]);
                    }

                }elseif($userOtp && $now->isAfter($userOtp->otp_expire_at)){
                    return redirect()->route('otp.verification', ['user_id' => $user_details->id])->with(['msg' => __('Your OTP has been expired.') ,'type' => 'danger' ]);
                }


                // if only OTP is verify is required
                $user_details = User::where(['otp_code' => $request->otp_code,'phone' => $user_details->phone])->first();
                if(!is_null($user_details)){
                    $user_details->otp_verified = 1;
                    $user_details->save();

                    if($user_details->user_type==0){
                        return redirect()->route('seller.dashboard');
                    }else{
                        return redirect()->route('buyer.dashboard');
                    }
                }

                // if only email verify is required
            }elseif(empty(get_static_option('disable_user_email_verify'))){
                $this->validate($request,[
                    'email_verify_token' => 'required|max:191'
                ],[
                    'email_verify_token.required' => __('verify code is required')
                ]);
                $user_details = User::where(['email_verify_token' => $request->email_verify_token,'email' => $user_details->email ])->first();
                if(!is_null($user_details)){
                    $user_details->email_verified = 1;
                    $user_details->save();
                    if($user_details->user_type==0){
                        return redirect()->route('seller.dashboard');
                    }else{
                        return redirect()->route('buyer.dashboard');
                    }
                }
                return redirect()->back()->with(['msg' => __('Your verification code is wrong.') ,'type' => 'danger' ]);
            }
        }

        if(empty(get_static_option('disable_user_email_verify'))){
            $verify_token = $user_details->email_verify_token ?? null;
            try {
                //check user has verify token has or not
                if(is_null($verify_token)){
                    $verify_token = rand(111,999).rand(222,888);
                    $user_details->email_verify_token = rand(111,999).rand(222,888);
                    $user_details->save();

                    $message = get_static_option('user_email_verify_message');
                    $message = str_replace(["@name", "@email_verify_tokn"],[$user_details->name, $verify_token],$message);
                    Mail::to($user_details->email)->send(new BasicMail([
                        'subject' => get_static_option('user_email_verify_subject'),
                        'message' => $message
                    ]));
                }

            }catch (\Exception $e){
            }
            return view('frontend.user.email-verify');
        }

    }

    public function resendCode(){
        $user_details = Auth::guard('web')->user();
        $verify_token = $user_details->email_verify_token ?? null;
        try {

            if(is_null($verify_token)){
                $verify_token = rand(111,999).rand(222,888);
                $user_details->email_verify_token = rand(111,999).rand(222,888);
                $user_details->save();
            }

            $message = get_static_option('user_email_verify_message');
            $message = str_replace(["@name", "@email_verify_tokn"],[$user_details->name, $verify_token],$message);

            Mail::to($user_details->email)->send(new BasicMail([
                'subject' => get_static_option('user_email_verify_subject'),
                'message' => $message
            ]));
        }catch (\Exception $e){
        }
        return redirect()->back()->with(['msg' => __('Resend Email Verify Code, Please check your inbox of spam.') ,'type' => 'success' ]);
    }





    public function generate(Request $request)
    {
        /* Generate An OTP */
        $userOtp = $this->generateOtp($request->phone);
        $this->sendSMS($request->phone);
        return redirect()->route('otp.verification', ['user_id' => $userOtp->id])
            ->with('success',  "OTP has been sent on Your Mobile Number.");
    }

    // todo: first user get then user otp create in user table
    public function generateOtp($phone_no)
    {
        $userOtp = User::select('id', 'otp_code', 'otp_expire_at')->where('phone', $phone_no)->first();
        /* Create a New OTP */
        if (!empty($userOtp)){
            $now = now();
            if (!empty(get_static_option('user_otp_expire_time'))){
                if (get_static_option('user_otp_expire_time') == 30){
                    $add_second = get_static_option('user_otp_expire_time');
                    User::where('id', $userOtp->id)->update([
                        'otp_code' => rand(123456, 999999),
                        'otp_expire_at' => $now->addSecond($add_second)
                    ]);
                }else{
                    $add_minutes = get_static_option('user_otp_expire_time');
                    User::where('id', $userOtp->id)->update([
                        'otp_code' => rand(123456, 999999),
                        'otp_expire_at' => $now->addMinutes($add_minutes)
                    ]);
                }
            }else{
                User::where('id', $userOtp->id)->update([
                    'otp_code' => rand(123456, 999999),
                    'otp_expire_at' => $now->addMinutes(1)
                ]);
            }

        }
    }

    //todo: otp send code with Twilio
    public function sendSMS($receiverNumber)
    {
        // find user
        $user_details = User::select('id', 'otp_code', 'otp_expire_at')->where('phone', $receiverNumber)->first();
        $otp_with_message = __('Login OTP is:');
        $message = $otp_with_message.' ' .$user_details->otp_code;

        try {
            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_AUTH_TOKEN");
            $twilio_number = getenv("TWILIO_NUMBER");
            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number,
                'body' => $message]);
            info(__('SMS Sent Successfully.'));

        } catch (Exception $e) {
            info("Error: ". $e->getMessage());
        }

    }


}