<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\UKM;
use App\Models\Location;
use App\Models\PlantingPartner;
use App\Models\TreeType;
use App\Models\Activity;
use App\Models\Transaction;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use PHPMailer\PHPMailer\PHPMailer;


class DonationController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
}
    public function getManage(){
        return view('admin.donation.manage.index',[
            'donations' => DB::table('donations')
                                    ->select('*')
                                    ->where('status','=','Enabled')
                                    ->orderBy('is_published','asc')
                                    ->get()
        ]);
    }
    public function getTransaction(){
        return view('admin.donation.transactions.index',[
            'donations' => DB::table('donations')
                                    ->select('*')
                                    ->where('status','=','Enabled')
                                    ->orderBy('is_published','asc')
                                    ->get()
        ]);
    }
    public function getDetail($id){
        return view('admin.donation.transactions.indexdetail',[
            'transactions' => DB::table('transactions')
                                    ->select('transactions.order_code', 'transactions.donate_id', 'donations.title',
                                    'transactions.email', 'transactions.name', 'transactions.date', 'transactions.grand_total', 'transactions.status')
                                    ->leftJoin('donations','transactions.donate_id','=','donations.id')
                                    ->where('transactions.donate_id','=',$id)
                                    ->get(),
            'total_pending' => DB::table('transactions')
                            ->where('donate_id','=', $id)
                            ->where('status','=','request')
                            ->orWhere('status','=','pending')
                            ->count(),

            'total_failed' => DB::table('transactions')
                            ->where('status','=','expired')
                            ->orWhere('status','=','failed')
                            ->where('donate_id','=', $id)
                            ->count(),

            'total_success' => DB::table('transactions')
                            ->where('status','=','success')
                            ->where('donate_id','=', $id)
                            ->count(),

            'total_paid' => DB::table('transactions')
                            ->where('donate_id','=', $id)
                            ->where('status','=','success')
                            ->sum('grand_total'),
        ]);
    }
    public function getActivity($id){
        return view('admin.donation.activity.index',[
            'transactions' => DB::table('activity')
                                    ->select('*')
                                    ->where('id_donation','=',$id)
                                    ->get(),
            'id_donations' => $id
        ]);
    }
    public function add(){
        return view ('admin.donation.manage.add',[
            'ukms' => UKM::get('*'),
            'locations'=> Location::get('*')->where('status','=','Enabled'),
            'partners'=> PlantingPartner::get('*')->where('status','=','Enabled'),
            'treetype'=> TreeType::get('*')->where('is_adopted','=','1')
        ]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'id_ukm' => 'required',
            'title' => 'required',
            'image' => 'required | max:1024',
            'description' => 'required',
            'target' => 'required',
            'due_date' => 'required',
            'id_location' => 'required',
            'id_mitra' => 'required',
            'id_tree' => 'required',
        ]);

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('donation-images','public');
        }
        $image = $request->file('image')->store('donation-images','public');

        $nama_ukm = DB::table('ukm')
                        ->where('id',$request->input('id_ukm'))
                        ->pluck('name')
                        ->first();

        $nama_location = DB::table('locations')
                            ->where('id',$request->input('id_location'))
                            ->pluck('name')
                            ->first();

        $nama_partner = DB::table('planting_partners')
                        ->where('id', $request->input('id_mitra'))
                        ->pluck('name')
                        ->first();

                        $tree_name = DB::table('tree_types')
                        ->where('id', $request->input('id_tree'))
                        ->pluck('name')
                        ->first();




      $donasi =  Donation::create([
            'title' => $request->input('title'),
            'image' => $image,
            'description' =>$request->input('description'),
            'target' => $request->input('target'),
            'due_date' => $request->input('due_date'),
            'planting_date' => $request->input('planting_date'),
            'id_ukm' => $request->input('id_ukm'),
            'nama_ukm' => $nama_ukm,
            'id_location' => $request->input('id_location'),
            'nama_lokasi' => $nama_location,
            'id_mitra' => $request->input('id_mitra'),
            'nama_mitra' => $nama_partner,
            'id_tree' => $request->input('id_tree'),
            'tree_name' => $tree_name,
            'status' =>$request->input('status'),
            'is_published' =>$request->input('is_published'),
            'is_bingkaikarya' =>$request->input('is_bingkaikarya'),]);

        $qr_name = 'bumibaik.com/donate/'.$donasi->id;
        $qr_code = QrCode::format('png')->size(500)->generate($qr_name);
        $output_file = '/img/qr-code/donation/'.$donasi->title.'.png';
        Storage::disk('public')->put($output_file, $qr_code);

        Donation::where('id', $donasi->id)
        ->update([
            'id' => $donasi->id,
            'qr_code' => $output_file
            ]);

        return redirect('donation/manage')->with('success', 'Donation successfully added');
    }


    public function edit($id){
        $data = Donation::whereId($id)->first();
        return view ('admin.donation.manage.edit',[
            'donation' => $data,
            'ukms' => UKM::get('*'),
            'locations'=> Location::get('*')->where('status','=','Enabled'),
            'partners'=> PlantingPartner::get('*')->where('status','=','Enabled'),
            'treetype'=> TreeType::get('*')->where('is_adopted','=','1')


        ]);
}
    public function update(Request $request, $id)
{

        $validatedData = $request->validate([
            'title' => 'required',
            'image' => 'required | max:1024',
            'description' => 'required',
            'target' => 'required',
            'due_date' => 'required',
            'planting_date' => 'required',
            'id_ukm' => 'required',
            'id_location' => 'required',
            'id_mitra' => 'required',
            'id_tree' => 'required'
        ]);
    $image = $request->file('image')->store('donation-images','public');

    $nama_ukm = DB::table('ukm')
        ->where('id',$request->input('id_ukm'))
        ->pluck('name')
        ->first();

    $nama_location = DB::table('locations')
        ->where('id',$request->input('id_location'))
        ->pluck('name')
        ->first();

    $nama_partner = DB::table('planting_partners')
        ->where('id', $request->input('id_mitra'))
        ->pluck('name')
        ->first();

    $tree_name = DB::table('tree_types')
        ->where('id', $request->input('id_tree'))
        ->pluck('name')
        ->first();

    $test = Donation::where('id', $id)
    ->update([
        'title' => $request->input('title'),
        'image' => $image,
        'description' =>$request->input('description'),
        'target' => $request->input('target'),
        'due_date' => $request->input('due_date'),
        'planting_date' => $request->input('planting_date'),
        'id_ukm' => $request->input('id_ukm'),
        'nama_ukm' => $nama_ukm,
        'id_location' => $request->input('id_location'),
        'nama_lokasi' => $nama_location,
        'id_mitra' => $request->input('id_mitra'),
        'nama_mitra' => $nama_partner,
        'id_tree' => $request->input('id_tree'),
        'tree_name' => $tree_name,
        'status' =>$request->input('status'),
        'is_published' =>$request->input('is_published'),
        'is_bingkaikarya' =>$request->input('is_bingkaikarya'),
    ]);

        return redirect()->route('get.manage')
        ->with('success', 'Data Berhasil diupdate');

    }

    public function filter(Request $request){


        $status = $request->input('status');
        $is_published = $request->input('is_published');

        return view('admin.donation.manage.filteredIndex',[
            'donations' => DB::table('donations')
                                    ->select('*')
                                    ->when ($status, function ($query, $status) {
                                        return $query->where('status','=', $status);
                                    })
                                    ->when ($is_published, function ($query, $is_published) {
                                        return $query->where('is_published','=', $is_published);
                                    })
                                    ->orderBy('id','asc')
                                    ->get()
        ]);
    }

    public function destroy(Donation $donation, $id){
        $data = Donation::where('id', $id)->first();
        // dd($product);
        if ($data == null) {
            return redirect()->route('get.manage');
        }

        $data->delete();

        return redirect()->route('get.manage');
    }
    public function update_publish($id)
    {
        $data = Donation::where('id', $id)->first();
        if ($data == null) {
            return redirect('donation/manage');
        }

        $data->update(['is_published'=> 'Yes']);

        return redirect('donation/manage');
    }

    public function update_unpublish($id)
    {
        $data = Donation::where('id', $id)->first();
        if ($data == null) {
            return redirect('donation/manage');
        }

        $data->update(['is_published'=> 'No']);

        return redirect('donation/manage');
    }

    public function update_enable($id)
    {
        $data = Donation::where('id', $id)->first();
        if ($data == null) {
            return redirect('donation/manage');
        }

        $data->update(['status'=> 'Enabled']);

        return redirect('donation/manage');
    }

    public function update_disable($id)
    {
        $data = Donation::where('id', $id)->first();
        if ($data == null) {
            return redirect('donation/manage');
        }

        $data->update(['status'=> 'Disabled']);

        return redirect('donation/manage');
    }
    public function qr_download($id){
        $data = Donation::where('id', $id)->first();
        $pathToFile = public_path('donations/qr_code/{id}');
        return Response::download($pathToFile);
    }

    public function addActivity($id){
        return view ('admin.donation.activity.add',[
            'id_donations' =>$id
        ]);
    }

    public function storeActivity(Request $request){
        $validatedData = $request->validate([
            'subject' => 'required',
            'title' => 'required',
            'image' => 'required | max:1024',
            'description' => 'required',
            'link'=> 'required'
        ]);

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('donation-images','public');
        }
        $image = $request->file('image')->store('donation-images','public');

      $donasi =  Activity::create([
            'subject' => $request->input('subject'),
            'title' => $request->input('title'),
            'image' => $image,
            'description' =>$request->input('description'),
            'is_sent' => 'Yes',
            'id_donation' => $request->input('id_donation'),
            'link' => $request->input('link'),
        ]);

        return redirect()->to('donation/activity/'.$donasi->id_donation);
    }
    public function editActivity($id){
        $data = Activity::whereId($id)->first();
        return view ('admin.donation.activity.edit',[
            'activity' => $data,
        ]);
    }
    public function updateActivity(Request $request, $id)
    {
        $validatedData = $request->validate([
            'subject'=>'required',
            'title' => 'required',
            'image' => 'max:1024',
            'description' => 'required',
        ]);

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('donation-images','public');
        }
        $image = $request->file('image')->store('donation-images','public');

      $donasi =  Activity::where('id',$id)
      ->update([
            'subject' => $request->input('subject'),
            'title' => $request->input('title'),
            'image' => $image,
            'description' =>$request->input('description'),
            'is_sent' => 'Yes',
            'id_donation' => $request->input('id_donation'),
            'link' => $request->input('link')
        ]);

        $id_donasi = $request->id_donation;

        return redirect()->to('donation/activity/'.$id_donasi);
    }

    public function destroyActivity(Donation $donation, $id){
        $data = Activity::where('id', $id)->first();
        if ($data == null) {
            // return redirect()->route('get.manage');
            return Redirect::back();
        }

        $data->delete();

        return Redirect::back();
    }

    public function sendEmail($id, $id_activity){
        $email_address = Transaction::where('donate_id',$id)->get();
        // var_dump($email_address);
        $title = DB::table('activity')
                        ->where('id','=',$id_activity)
                        ->pluck('title')
                        ->first();

        $description = DB::table('activity')
                        ->where('id','=',$id_activity)
                        ->pluck('description')
                        ->first();

        $image = DB::table('activity')
                        ->where('id','=',$id_activity)
                        ->pluck('image')
                        ->first();

        $link = DB::table('activity')
                        ->where('id','=',$id_activity)
                        ->pluck('link')
                        ->first();

        require base_path("vendor/autoload.php");
        $mail = new PHPMailer(true);     // Passing `true` enables exceptions
        $mail->CharSet = 'utf-8';
        $body = view("landing/email/emailActivity")->with('title',$title)
                                                    ->with('description',$description)
                                                    ->with('link',$link)
                                                    ->with('image', $image);
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
            // Email server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp-relay.brevo.com';             //  smtp host
            $mail->SMTPAuth = true;
            $mail->Username = env('MAIL_USERNAME');   //  sender username
            $mail->Password = env('MAIL_PASSWORD');       // sender password
            $mail->SMTPSecure = 'tls';                  // encryption - ssl/tls
            $mail->Port = 587;                          // port - 587/465

            $mail->setFrom(env('MAIL_USERNAME'), 'BumiBaik');


            foreach($email_address as $email){
                $mail->addAddress($email->email);
            }

            $mail->isHTML(true);                // Set email content format to HTML

            $mail->Subject = 'Update Penanaman';
            $mail->MsgHTML($body);

            // $mail->AltBody = plain text version of email body;

            if( !$mail->send() ) {
                return back()->with("failed", "Email not sent.")->withErrors($mail->ErrorInfo);
            }

            else {
                return back()->with("success", "Email has been sent.");
            }
    }


}
