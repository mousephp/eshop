<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Log;
use Exception;

class ContactController extends Controller
{
    protected $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function index(){
        $contacts = $this->contact->all();

        return view('backend.manager.contact.index', compact('contacts'));
    }
    
    public function contact(){
        return view('frontend.pages.contact');
    }
    
    public function store(Request $request){
        $this->validate($request,[
            'name'	   => 'require',
            'subject'  => 'require',
            'email'	   => 'require|email',
            'phone'	   => 'require|numeric',
            'message'  => 'require'
        ]);

        try {
            $this->contact->create($request->all());
        
            return redirect()->route('contact')->with('message','Gửi liên hệ thành công');
        } catch (\Exception $e) {
            Log::error('error(loi):'.$e->getMessage().$e->getLine());
        }
    }

    public function feeback($id){

    }
    
    public function destroy($id){
        try {
            $this->contact->delete($id);
        
            return redirect()->route('contact.admin.index')->with('message','Xóa thành công');
        } catch (\Exception $e) {
            Log::error('error(loi):'.$e->getMessage().$e->getLine());
        }
    }

}
