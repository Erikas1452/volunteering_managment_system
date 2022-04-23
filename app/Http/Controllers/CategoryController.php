<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\User;
use App\Models\Organization;
use App\Models\Category;
use Carbon\Carbon;
use Session;

class CategoryController extends Controller
{
    public function storeCategory(Request $request){

        $request->validate([
             'category_name_en' => 'required',
             'category_icon' => 'required',
         ],[
             'category_name_en.required' => 'Input Category English Name',
         ]);
 
         Category::insert([
 
             'category_name_en' => $request->category_name_en,
             'category_icon' => $request->category_icon,
         ]);
 
         $notification = array(
             'message' => 'Kategorija sukurta sėkmingai',
             'alert-type' => 'success'
         );
 
         return redirect()->back()->with($notification);
     }

     public function deleteCategory($id){

    	Category::findOrFail($id)->delete();
    	$notification = array(
			'message' => 'Kategorija pašalinta sėkmingai',
			'alert-type' => 'success'
		);
		return redirect()->back()->with($notification);
    }

    public function editCategory($id){
    	$category = Category::findOrFail($id);
    	return view('admin.dashboard-category-edit',compact('category'));
    }

    public function updateCategory(Request $request ,$id){

        Category::findOrFail($id)->update([
          'category_name_en' => $request->category_name_en,
          'category_name_hin' => $request->category_name_hin,
          'category_slug_en' => strtolower(str_replace(' ', '-',$request->category_name_en)),
          'category_slug_hin' => str_replace(' ', '-',$request->category_name_hin),
          'category_icon' => $request->category_icon,
  
          ]);
  
          $notification = array(
              'message' => 'Kategorija atnaujinta sėkmingai',
              'alert-type' => 'success'
          );
  
          return redirect()->route('admin.dashboard.categories')->with($notification);
      }
}
