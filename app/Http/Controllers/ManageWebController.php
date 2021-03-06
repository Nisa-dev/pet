<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Home;
use App\About;
use App\Contact;

class ManageWebController extends Controller
{
        // View
        public function view_manage_home()
        {
            $home = Home::first();
    
            return view('manage_web.manage_home', compact('home'));
        }
    
        public function view_manage_about_us()
        {
            $about = About::first();
            $about_en = About::find(2);
    
            return view('manage_web.manage_about_us', compact('about','about_en'));
        }
    
        public function view_manage_contact_us()
        {
            $contact = Contact::first();
    
            return view('manage_web.manage_contact_us', compact('contact'));
        }
    
        // Update
        public function manage_home(Request $request, $id)
        {   
            request()->validate([
                'home_background_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    
            $home = Home::find($id);
    
            if ($request->hasfile('home_background_image')){
                $image_name = time().'.'.request()->home_background_image->getClientOriginalExtension();
                request()->home_background_image->move(public_path('image/manage_web'), $image_name);
    
                $home->home_welcome_text = $request->home_welcome_text;
                $home->home_background_image = $image_name; 
                $home->home_google_map_embed = $request->home_google_map_embed; 
                $home->save();
            }
            else {
                $home->update($request->all());            
            }
    
            return redirect()->route('home.manage')->with('success','แก้ไขข้อมูลหน้าแรกแล้ว');
        }
    
        public function manage_about_us(Request $request, $id)
        {
            request()->validate([
                'about_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    
            $about = About::find($id);
    
            if ($request->hasfile('about_image')){
                $image_name = time().'.'.request()->about_image->getClientOriginalExtension();
                request()->about_image->move(public_path('image/manage_web'), $image_name);
    
                $about->about_title = $request->about_title;
                $about->about_subtitle = $request->about_subtitle;
                $about->about_content = $request->about_content;
                $about->about_image = $image_name; 
                $about->save();
            }
            else {
                $about->update($request->all());            
            }
            
            return redirect()->route('about_us.manage')->with('success','แก้ไขข้อมูลเกี่ยวกับเราแล้ว');
        }
    
        public function manage_contact_us(Request $request, $id)
        {
            request()->validate([
                'contact_line_qr' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'contact_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if ($request->contact_logo != null && $request->contact_line_qr != null) {
                $image_name_line_qr = time().'.'.request()->contact_line_qr->getClientOriginalExtension();
                request()->contact_line_qr->move(public_path('image/manage_web'), $image_name_line_qr);

                $image_name_logo = time().'.'.request()->contact_logo->getClientOriginalExtension();
                request()->contact_logo->move(public_path('image/manage_web'), $image_name_logo);

                $contact = Contact::find($id);
                $contact->contact_name = $request->contact_name;
                $contact->contact_address = $request->contact_address; 
                $contact->contact_tel_no = $request->contact_tel_no; 
                $contact->contact_google_map_link = $request->contact_google_map_link; 
                $contact->contact_facebook = $request->contact_facebook; 
                $contact->contact_facebook_link = $request->contact_facebook_link; 
                $contact->contact_line_qr = $image_name_line_qr; 
                $contact->contact_logo = $image_name_logo; 
                $contact->save();
            }
            elseif ($request->contact_line_qr != null){
                $image_name = time().'.'.request()->contact_line_qr->getClientOriginalExtension();
                request()->contact_line_qr->move(public_path('image/manage_web'), $image_name);
    
                $contact = Contact::find($id);
                $contact->contact_name = $request->contact_name;
                $contact->contact_address = $request->contact_address; 
                $contact->contact_tel_no = $request->contact_tel_no; 
                $contact->contact_google_map_link = $request->contact_google_map_link; 
                $contact->contact_facebook = $request->contact_facebook; 
                $contact->contact_facebook_link = $request->contact_facebook_link; 
                $contact->contact_line_qr = $image_name; 
                $contact->save();
            }
            elseif($request->contact_logo != null) {
                $image_name = time().'.'.request()->contact_logo->getClientOriginalExtension();
                request()->contact_logo->move(public_path('image/manage_web'), $image_name);

                $contact = Contact::find($id);
                $contact->contact_name = $request->contact_name;
                $contact->contact_address = $request->contact_address; 
                $contact->contact_tel_no = $request->contact_tel_no; 
                $contact->contact_google_map_link = $request->contact_google_map_link; 
                $contact->contact_facebook = $request->contact_facebook; 
                $contact->contact_facebook_link = $request->contact_facebook_link; 
                $contact->contact_logo = $image_name; 
                $contact->save();
            }
            elseif ($request->contact_logo != null && $request->contact_line_qr != null) {
                $image_name_line_qr = time().'.'.request()->contact_line_qr->getClientOriginalExtension();
                request()->contact_line_qr->move(public_path('image/manage_web'), $image_name_line_qr);

                $image_name_logo = time().'.'.request()->contact_contact_logo->getClientOriginalExtension();
                request()->contact_contact_logo->move(public_path('image/manage_web'), $image_name_logo);

                $contact = Contact::find($id);
                $contact->contact_name = $request->contact_name;
                $contact->contact_address = $request->contact_address; 
                $contact->contact_tel_no = $request->contact_tel_no; 
                $contact->contact_google_map_link = $request->contact_google_map_link; 
                $contact->contact_facebook = $request->contact_facebook; 
                $contact->contact_facebook_link = $request->contact_facebook_link; 
                $contact->contact_line_qr = $image_name_line_qr; 
                $contact->contact_logo = $image_name_logo; 
                $contact->save();
            } else {
                $contact = Contact::find($id);
                $contact->update($request->all());            
            }
    
            return redirect()->route('contact_us.manage')->with('success','แก้ไขข้อมูลติดต่อเราแล้ว');
        }
}
