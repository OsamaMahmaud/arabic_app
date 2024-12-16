<?php

namespace App\Http\Controllers\User\Profile;

use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\ContactRequest;

class ContactMessageController extends Controller
{
    use ApiTrait;
public function store(ContactRequest $request)
{
    try {
    
        $message = ContactMessage::create($request->safe()->all());
    
        return $this->SuccessMessage( 'Message sent successfully',201,$message);
       

    } catch (\Exception $e) {

        return $this->ErrorMessage('حدث خطأ أثناء إرسال شكواك');
    }
   

}
}
