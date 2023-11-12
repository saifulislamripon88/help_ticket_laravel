<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{

    public function showAllTicket(){
        $allTicket = DB::table('tickets')
                   ->orderBy('id')
                   ->paginate(8);
        return view('ticket', compact('allTicket'));
    }

    public function storeTicket(Request $request){
    // this is validation
           $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'attachment' => 'nullable|mimes:pdf,png,jpg,jpeg|max:5120'
             ]);

    //    this code for processing uploading file
           $filepath = ''; // Initialize filepath variable
        if($request->file('attachment')){
            $file = $request->file('attachment');
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $fileName = pathinfo($originalName, PATHINFO_FILENAME);
            $fileNameWithExtension = $fileName . '.' . $extension;
            $filepath = $file->storeAs('uploads', $fileNameWithExtension, 'public');
        }

        $strTicket = DB::table('tickets')
        ->insert([
         'title' => $request->title,
         'description' => $request->description,
         'attachment' => $filepath,
         'user_id' => Auth::user()->id,
         'created_at' => now(),
         'updated_at' => now(),
        ]);

        if($strTicket){
            return redirect()->route('ticket');
        }

    }



    // update issued ticket
    public function ticketUpdateView(Request $request, $id){
        $uvTicket = DB::table('tickets')
                  ->find( $id );
             return view('editticket', compact('uvTicket'));     
    }

    public function ticketUpdate(Request $request, $id){

        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'attachment' => 'nullable|mimes:pdf,png,jpg,jpeg|max:5120'
        ]);

        $ticket = DB::table('tickets')->where('id', $id)->first(); // Fetch the existing ticket record
        $previousAttachment = $ticket->attachment; 
        $newAttachmentPath = $previousAttachment;

        if ($request->file('attachment')) {
            // If a new file is being uploaded, update the filepath
            $file = $request->file('attachment');
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $fileName = pathinfo($originalName, PATHINFO_FILENAME);
            $fileNameWithExtension = $fileName . '.' . $extension;
            $newAttachmentPath = $file->storeAs('uploads', $fileNameWithExtension, 'public');
        }
    
        $updTicket = DB::table('tickets')
                  ->where('id', $id )
                  ->update([
                    'title' => $request->title,
                    'description' => $request->description,
                    'attachment' => $newAttachmentPath,
                    'status_changed_by_id' => Auth::user()->id,
                    'updated_at' => now(),
                  ]);



                  if($updTicket){

                    // this code use for removing previous from db and project file
                    if($request->file('attachment') && $previousAttachment !== $newAttachmentPath){
                        Storage::disk('public')->delete($previousAttachment);
                    }
                    return redirect()->route('ticket');
                  }  

    }                                   



    // deleting data

    public function deleteTicket(string $id){
        $delTicket = DB::table('tickets')
                   ->where('id', $id)
                   ->delete();

               if($delTicket){
                return redirect()->route('ticket');
               }    
    }



    public function ticketDetails(string $id){
        $tcDetails = DB::table('tickets')
                   ->where('id', $id)
                   ->first();
            return view('details', compact('tcDetails')); 
            // dd($tcDetails);
    }


    // contents--------------
    public function readContents(string $id){
        $readContents = DB::table('tickets')
                      ->where('id', $id)
                      ->first();

                 return view('content', compact('readContents'));  

    }





    // logout 

    // public function logout(Request $request){
    //     Auth::logout();
    //     return redirect()->route('view.login');

    // }



   


   





    
}
