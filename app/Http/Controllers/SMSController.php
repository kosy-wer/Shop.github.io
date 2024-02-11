<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\TwilioService;
use App\Http\Requests\SendSmsRequest;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Sms;

class SMSController extends Controller
{
    protected $twilioService;

    public function __construct(TwilioService $twilioService)
    {
        $this->twilioService = $twilioService;
    }

    public function sendSMS(SendSmsRequest $request)
    {
        if ($request->sms_type === 'promotion') {
            $smsBody = Sms::query()->first();
            if ($smsBody) {
                $patients = Patient::all();
                foreach ($patients as $key => $patient) {
                    if ($patient->iso2 === 'bd') {
                        $mobile_number = '+' . $patient->dial_code . substr($patient->mobile_number, -10);
                        $response = $this->twilioService->sendSMS($mobile_number, $smsBody->body);
                    }
                }
            }
            return back()->withError('SMS text not found.');
        }

        $appointment = Appointment::where('patient_id', $request->patient_id)
            ->orderBy('id', 'desc')
            ->first();

        $txt = sprintf(
            "Doctor, %s. Hello, %s. Your ID: %s, Appointment ID: %s, Serial: %u and Appointment Date: %s. Thank you for the Appointment",
            $appointment->doctor->full_name,
            $appointment->patient->full_name,
            $appointment->patient->patient_id_number,
            $appointment->appointment_id_no,
            $appointment->serial_number,
            $appointment->date
        );

        $mobile_number = '+' . $appointment->patient->dial_code . $appointment->patient->mobile_number;
        $response = $this->twilioService->sendSMS($mobile_number, $txt);

        if ($response->sid) {
            return back()->withMessage('SMS sent successfully');
        }
        return back()->withError('Failed to send SMS');
    }
}

