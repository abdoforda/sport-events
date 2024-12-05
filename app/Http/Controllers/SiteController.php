<?php

namespace App\Http\Controllers;

use App\ImageAlbum;
use App\News;
use App\Page;
use App\Event;
use App\Rental;
use App\RentalType;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    // news

    public function news()
    {   $news = News::orderBy('id', 'desc')->paginate(1);
        return view('pages.news.index', compact('news'));
    }

    //showNews

    public function showNews($slug)
    {
        $new = News::where('slug', $slug)->first();
        $new->increment('views');
        $bestNewsViews = News::orderBy('views', 'desc')->take(3)->get();
        return view('pages.news.show', compact(['new', 'bestNewsViews']));
    }

    //gallery

    public function gallery()
    {
        $albums = ImageAlbum::orderBy('id', 'desc')
        ->paginate(12);

        return view('pages.images.index', compact('albums'));
    }

    public function showgallery($id)
    {
        $album = ImageAlbum::where('id', $id)->first();
        //return $album->images;
        
        return view('pages.images.show', compact('album'));
    }

    public function pageShow($id)
    {
        $page = Page::where('id', $id)->first();
        return view('pages.page', compact('page'));
    }

    //register
    public function register(Request $request){

        if(auth()->check()){
            return redirect()->route('home');
        }

        if($request->isMethod('post')){
            $request->validate([
                'name'        => 'required|min:3',
                'email'       => 'required|email|unique:users',
                'password'    => 'required|min:6|confirmed',
                'phone'       => 'required|numeric',
                'type'        => 'required|in:visitor,employee',
                'job_name'    => 'required_if:type,employee',
                'job_number'  => 'required_if:type,employee',
                'tshirt_size' => 'required_if:type,employee|in:S,M,L,XL,XXL',
            ]);

            $user = new \App\User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->phone = $request->phone;
            $user->type = $request->type;
            $user->job_name = $request->job_name;
            $user->job_number = $request->job_number;
            $user->tshirt_size = $request->tshirt_size;
            $user->save();

            auth()->login($user);

            return "Done";

        }

        return view('pages.auth.register');
    }

    //login
    public function login(Request $request){

        if(auth()->check()){
            return redirect()->route('home');
        }

        if($request->isMethod('post')){
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:6'
            ]);
            $remember = $request->has('remember');
            if(auth()->attempt(['email' => $request->email, 'password' => $request->password], $remember)){
                return "Done";
            }

            return response()->json(['errors' => ['password' => ['كلمة المرور غير صحيحة']]], 422);

        }
        return view('pages.auth.login');
    }

    //events
    public function events(){
        
        $events = Event::where('status', 1)->orderBy('id', 'desc')->paginate(6);
        return view('pages.events.index', compact('events'));
    }

    //event_show
    public function event_show($id){
        $event = Event::where('id', $id)->firstOrFail();
        return view("pages.events.show", compact('event'));
    }

    //rentalTypeShow
    public function rentalTypeShow($id){
        if(auth()->check()){
            if(auth()->user()->type == 'visitor'){
                return redirect()->route('home');
            }
        }
        $rentalType = RentalType::where('id', $id)->firstOrFail();
        return view("pages.rentals.show", compact('rentalType'));
    }

    //rentalStore
    public function rentalStore(Request $request, $id){
        
        if(auth()->check()){
            if(auth()->user()->type == 'visitor'){
                return redirect()->route('home');
            }
        }

        $ids = [];
        if(in_array($id, [1, 2])){
            $ids = [1, 2];
        }else{
            $ids[] = $id;
        }
        $rentalType = RentalType::whereIn('id', $ids)->get();
        if(count($rentalType) == 0){
            return response()->json([
                'message' => 'هذا النوع غير متاح',
                'errors' => ['number_of_hours' => ['هذا النوع غير متاح']]
            ], 422);
        }
        

        $validation = $request->validate([
            'phone' => 'required|numeric',
            'date_start' => 'required',
            'number_of_hours' => 'required|numeric',
        ]);


        $dateTimeStart = $request->date_start;
        $dateTimeStart = str_replace(' ص',':00 AM',$dateTimeStart);
        $dateTimeStart = str_replace(' م',':00 PM',$dateTimeStart);
        $dateTimeStart = str_replace('/','-',$dateTimeStart);
        $date1 = Carbon::parse($dateTimeStart)->format('Y-m-d H:i:s');

        

        //check date_start not before now
        if($date1 < Carbon::now()){
            return response()->json([
                'message' => 'تاريخ وساعة الحجز قد مضت',
                'errors' => ['date_start' => ['تاريخ وساعة الحجز قد مضت']]
            ], 422);
        }

        $dateTimeStart = date('Y-m-d H:i:s', strtotime($dateTimeStart));

        $dateTimeEnd = date('Y-m-d H:i:s', strtotime($dateTimeStart. ' + '.$request->number_of_hours.' hours'));
        
        

        $dateStart = $dateTimeStart;
        $dateEnd = $dateTimeEnd;

        foreach($rentalType as $rentalMain){
            $existingRentals = $rentalMain->rentals()
            ->where(function($query) use ($dateStart, $dateEnd) {
                $query->where(function($q) use ($dateStart) {
                    $q->where('date_start', '<=', $dateStart)
                      ->where('date_end', '>=', $dateStart);
                })->orWhere(function($q) use ($dateEnd) {
                    $q->where('date_start', '<=', $dateEnd)
                      ->where('date_end', '>=', $dateEnd);
                })->orWhere(function($q) use ($dateStart, $dateEnd) {
                    $q->where('date_start', '>=', $dateStart)
                      ->where('date_end', '<=', $dateEnd);
                });
            })->exists();
        
            if ($existingRentals) {
                return response()->json([
                    'message' => 'تم حجز هذه الساعة بالفعل',
                    'errors' => ['date_start' => ['تم حجز هذه الساعة بالفعل']]
                ], 422);
            }
        }

        

    


        $rental = new Rental();
        $rental->user_id = auth()->user()->id;
        $rental->rental_type_id = $id;
        $rental->phone = $request->phone;
        $rental->date_start = $dateTimeStart;
        $rental->date_end = $dateTimeEnd;
        $rental->name = auth()->user()->name;
        $rental->save();

        return $rental;

    }

    //event_register
    public function event_register(Request $request){
        
        if(auth()->check()){
            if(auth()->user()->type == 'visitor'){
                return redirect()->route('home');
            }
        }

        $request->validate([
            'id' => 'required|exists:events,id',
        ]);

        $event = Event::where('id', $request->id)->firstOrFail();

        if($event->status == 0){
            return response()->json(['message' => 'هذا الحدث غير متاح'], 422);
        }
        

        if($event->users()->where('id', auth()->user()->id)->exists()){
            // delete user from event
            $event->users()->detach(auth()->user());
            return response()->json(['message' => 'تم الغاء الإشتراك بنجاح', 'eventCount' => $event->users()->count()], 200);
        }

        $event->users()->attach(auth()->user());

        return response()->json(['message' => 'تم الإشتراك بنجاح', 'eventCount' => $event->users()->count()], 200);
    }

    //rentalShowUser
    public function rentalShowUser($id){
        
        $rental = Rental::where([
            'id' => $id,
            'user_id' => auth()->user()->id
        ])->firstOrFail();

        return view("pages.rentals.show_user", compact('rental'));
    }

    //getHours
    public function getHours($id, Request $request){

        $ids = [];
        if(in_array($id, [1, 2])){
            $ids = [1, 2];
        }else{
            $ids[] = $id;
        }

        $date = $request->date;
        // formate date yyyy - mm - dd
        $date = explode('/', $date);
        $date = $date[2].'-'.$date[1].'-'.$date[0];
        
        $rentals = Rental::whereIn('rental_type_id', $ids)
        ->whereDate('date_start', '=', $date)
        ->get();
        
        if(count($rentals) == 0){
            return '<tr><td colspan="5" style="text-align: center;">لا يوجد حجوزات في هذا اليوم</td></tr>';
        }

        $html = '';
        foreach($rentals as $index => $rental){
            $index = $index+1;
            $date_start = Carbon::parse($rental->date_start)->format('d-m-Y');
            $date_end = Carbon::parse($rental->date_end)->format('d-m-Y');
            $houreStart = tranlateTime($rental->date_start);
            $houreEnd = tranlateTime($rental->date_end);
            $date1 = new \DateTime($rental->date_start);
            $date2 = new \DateTime($rental->date_end);
            $diff = $date1->diff($date2);
            $number_of_hours = $diff->h + ($diff->days * 24) . ' ساعة';

            $html .= '<tr><td>'.$index.'</td><td>'.$date_start.'</td><td>'.$houreStart.'</td><td>'.$number_of_hours.'</td><td>'.$houreEnd.'</td></tr>';
        }

        return $html;
    }

    //profile
    public function profile(Request $request){


        // if method post
        if($request->isMethod('post')){

            $request->validate([
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users,email,'.auth()->user()->id,
            ]);

            $job_name = '';
            $job_number = '';
            $tshirt_size = '';
            if(auth()->user()->type == 'employee'){

                $request->validate([
                    'job_name' => 'required',
                    'job_number' => 'required|numeric',
                    'tshirt_size' => 'required|in:S,M,L,XL,XXL',
                ]);

                $job_name = $request->job_name;
                $job_number = $request->job_number;
                $tshirt_size = $request->tshirt_size;
            }


            if($request->password){
                $request->validate([
                    'password' => 'required|min:6',
                    'password_confirmation' => 'required|same:password',
                ]);
                auth()->user()->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'job_name' => $job_name,
                    'job_number' => $job_number,
                    'tshirt_size' => $tshirt_size,
                ]);
            }else{
                auth()->user()->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'job_name' => $job_name,
                    'job_number' => $job_number,
                    'tshirt_size' => $tshirt_size,
                ]);
            }

            return "تم حفظ البيانات بنجاح";

        }

        return view("pages.profile");

    }

    //my_events
    public function my_events(){
        $events = auth()->user()->events()->paginate(10);
        return view("pages.my_events", compact('events'));
    }

    //my_rentals
    public function my_rentals(){
        $rentals = auth()->user()->rentals()->get();
        return view("pages.my_rentals", compact('rentals'));
    }
}
