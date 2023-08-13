<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasks;
use App\Jobs\SendEmailJob; 
use App\Mail\SendEmailTest;
use App\Models\User;

use Mail;
use Carbon\Carbon;
class TaskController extends Controller
{
    //
    public function index(){

        // $tasks = Tasks::all();
        $tasks = Tasks::paginate(request()->all());    
        return response()->json($tasks);
    }

    public function sendmail(){

        // $email = new SendEmailTest();
        // //Mail::to($this->details['email'])->send($email);
        // Mail::to('sikhaouvady@gmail.com')->send($email);
        
        $users = \App\Models\User::all();

        $task = Tasks::where('email_status', '0')
                ->whereDate('due_date', '=',Carbon::tomorrow())->get();
        // echo '<pre>'; print_r($task); dd('ye');
        $details['email'] = 'sikhaouvady@gmail.com';

        foreach ($task as $tsk) {
            $user_id = $tsk->user_id;
            $tskid = $tsk->id;
            $task = Tasks::find($tskid);
            $task->email_status = '1';
            $task->save();
            dispatch(new SendEmailJob($details));
        }


        // $details['email'] = 'sikhaouvady@gmail.com';
        // // SendEmailJob::dispatch(rand(0, 999999));
        // // dispatch(new SendEmailJob); 
        // dispatch(new SendEmailJob($details));
        dd('success');
        
    }


    public function store(Request $request){

        
        $task = new Tasks;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->user_id = $request->user_id;
        $task->due_date = $request->due_date;
        $task->status = $request->status;
        $task->priority = $request->priority;
        $task->save();

        // SendEmailJob::dispatch($task)->delay(now()->addDay()->startOfDay());

        return response()->json([

            "message" => "Task Added."

        ], 201);

    }

    public function show($id){

        $task = Tasks::find($id);
        
        if(!empty($task)){

            return response()->json($task);

        }else{
            return response()->json([

                "message" => "Task not found."

            ], 404);
        }
    }

    public function update(Request $request, $id){

        if(Tasks::where('id',$id)->exists()){

            $task = Tasks::find($id);
            $task->title = is_null($request->title) ? $task->title : $request->title;
            $task->description = is_null($request->description) ? $task->description : $request->description;
            $task->due_date = is_null($request->due_date) ? $task->due_date : $request->due_date;
            $task->save();
            return response()->json([

                "message" => "Task updated."

            ], 404);
         }else{

            return response()->json([

                "message" => "Task not found."

            ], 404);

         }
    }

    public function destroy($id){

        if(Tasks::where('id',$id)->exists()){
            $task = Tasks::find($id);
            $task->delete();
            return response()->json([

                "message" => "Task deleted."

            ], 202);
        }else{

            return response()->json([

                "message" => "Task not found."

            ], 404);


        }

    }


}
