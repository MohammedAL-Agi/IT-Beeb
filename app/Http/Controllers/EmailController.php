<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class EmailController extends Controller
{
	function mail()
	{
		$services = "";
		$usersData = DB::table('users')
			->join('services', 'services.user_id', '=', 'users.user_id')
			->join('feelings', 'feelings.user_id', '=', 'users.user_id')
			->where('services.check', '=', 1)
			->where('feelings.check', '=', 1)
			->get();

		foreach ($usersData as $data) {
			$services .= $data->service_name;
		}
		$emailData = array(
			'name' => $usersData[0]->name,
			'mobile' => $usersData[0]->mobile,
			'feeling' => $usersData[0]->feeling_name,
			'services' => $services
		);
		// die($emailData);
		Mail::to($usersData[0]->email)->send(new WelcomeMail($emailData));

		return $usersData;
	}
}
