<?php

use Illuminate\Support\Facades\Http;

function getPayment($data)
{
    $api = env('PAY_API');
    $redirect = env('PAY_REDIRECT');

    $responce = Http::post('https://pay.ir/pg/send', [
        'api' => $api,
        'amount' => $data['price'],
        'redirect' => $redirect,
        'description' => $data['course_title'],
    ]);

    $responce = json_decode($responce);


    if ($responce->status == 1)
    {
        auth()->user()->payments()->create([
            'token' => $responce->token,
            'amount' => $data['price'],
            'course_id' => $data['course_id'],
        ]);
//        auth()->user()->courseUser()->attach($data['course_name'], ['created_at' => now(), 'updated_at' => now()]);
//        $course = Course::query()->find($data['course_name']);
//        $course->update([
//            'total_sales' => $course->total_sales  + 1
//        ]);
        return redirect(url("https://pay.ir/pg/$responce->token"));
    }
}

function verifyPayment($token)
{
    $api = env('PAY_API');

    $responce = Http::post('https://pay.ir/pg/verify', [
        "api" => $api,
        "token" => $token
    ]);

    $responce = json_decode($responce);



    auth()->user()->payments()->update([
         'status' => $responce->status,
        'cardNumber' => $responce->cardNumber,
        'transId' => $responce->transId,
    ]);
//    dd($responce);
//    Payment::create([
//        'token' => $token,
//        'amount' => $responce->amount,
//        'user_id' => auth()->user()->id,
//        'status' => $responce->status,
//        'cardNumber' => $responce->cardNumber,
//        'transId' => $responce->transId,
//    ]);

    if ($responce->status == 1)
    {
//        auth()->user()->courseUser()->attach($request->course_name, ['created_at' => now(), 'updated_at' => now()]);
//        $course = Course::query()->find($request->course_name);
//        $course->update([
//            'total_sales' => $course->total_sales  + 1
//        ]);
        return [
            "message" => "success",
            "amount" => $responce->amount,
            "transId" => $responce->transId,
        ];
    }
}
