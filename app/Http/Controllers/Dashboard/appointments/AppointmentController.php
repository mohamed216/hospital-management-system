<?php

namespace App\Http\Controllers\Dashboard\appointments;

use App\Http\Controllers\Controller;
use App\Mail\AppointmentConfirmation;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;

class AppointmentController extends Controller
{
    public function index(){

        $appointments = Appointment::where('type','غير مؤكد')->get();
        return view('Dashboard.appointments.index',compact('appointments'));
    }

    public function index2(){

        $appointments = Appointment::where('type','مؤكد')->get();
        return view('Dashboard.appointments.index2',compact('appointments'));
    }

    public function approval(Request $request,$id){
        $appointment = Appointment::findorFail($id);
        $appointment->update([
            'type'=>'مؤكد',
            'appointment'=>$request->appointment
        ]);
        Mail::to($appointment->email)->send(new AppointmentConfirmation($appointment->name,$appointment->appointment));

        // send message mob
        $receiverNumber = $appointment->phone;
        $message = "عزيزي المريض" . " " . $appointment->name . " " . "تم حجز موعدك بتاريخ " . $appointment->appointment;
        $basic  = new \Vonage\Client\Credentials\Basic("4fcb6cb5", "YIo0XkFZ4MZmwrRV");
        $client = new \Vonage\Client($basic);
        $response = $client->sms()->send(
            new \Vonage\SMS\Message\SMS($receiverNumber, "H&M", $message)
        );
        $message1 = $response->current();

        if ($message1->getStatus() == 0) {
            echo "The message was sent successfully\n";
        } else {
            echo "The message failed with status: " . $message1->getStatus() . "\n";
        }
        session()->flash('add');
        return back();
    }
}
