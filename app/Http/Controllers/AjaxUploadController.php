<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\FileUpload;

class AjaxUploadController extends Controller
{
    function index()
    {
     return view('ajax_upload');
    }

    function action(Request $request)
    {
     $validation = Validator::make($request->all(), [
      'select_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
     ]);
     if($validation->passes())
     {
      $image = $request->file('select_file');
      $new_name = rand() . '.' . $image->getClientOriginalExtension();
      $image->move(public_path('images'), $new_name);

      # Save File to database on successfull upload
       $file = new FileUpload;
       $file->name = $new_name;
       $file->save();

     # Show success message and display uploaded file
      return response()->json([
       'message'   => 'Image Upload Successfully',
       'uploaded_image' => '<img src="/images/'.$new_name.'" class="img-thumbnail" width="300" />',
       'class_name'  => 'alert-success'
      ]);
     }
     else
     {
      return response()->json([
       'message'   => $validation->errors()->all(),
       'uploaded_image' => '',
       'class_name'  => 'alert-danger'
      ]);
     }
    }
}
?>
