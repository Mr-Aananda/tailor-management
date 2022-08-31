<?php

namespace App\Http\Controllers\Accounting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Phone;
use App\Models\Address;

class ContactController extends Controller {
    // default variables 
    private $paginate = 25;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $contactTypes = config('contactdata.contactType');
        $records = Contact::with(['phones', 'addresses'])->paginate($this->paginate);

        return view('accounting.contact.index', compact('contactTypes', 'records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        // get contact-types
        $contactTypes = config('contactdata.contactType');
        $contactGender = config('contactdata.gender');

        // view 
        return view('accounting.contact.create', compact('contactGender', 'contactTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // validation 
        $data = $request->validate([
            'organigation_name'     => 'required|string',
            'contact_person_name'   => 'required|string',
            "opening_balance"       => "required|numeric",
            'credit_limit'          => 'required|numeric',
            'nid'                   => 'required|string|min:10|max:17',
            'email_address'         => 'nullable|email|unique:contacts,email_address',
            // mobile number 
            "mobile_number"         => "required|array|min:1",
            'mobile_number.*'       => 'required|numeric|distinct',
            // present address 
            'present_upazila'       => 'required|string',
            'present_district'      => 'required|string',
            'present_division'      => 'required|string',
            'present_street'        => 'required|string',
            // permanent address
            'permanent_upazila'     => 'nullable|string',
            'permanent_district'    => 'nullable|string',
            'permanent_division'    => 'nullable|string',
            'permanent_street'      => 'nullable|string',
            'contact_type'          => 'required|string',
            'note'                  => 'nullable|string'
        ], [
            'mobile_number.*.required'  => 'The :attribute field is required.',
            'mobile_number.*.numeric'   => 'The :attribute is not valid.',
            'mobile_number.*.distinct'  => 'The :attribute field has a duplicate value.',
        ]);

        // insert to contact 
        $contact = Contact::create([
            'user_id' => null,
            'organigation_name' => $request->organigation_name,
            'contact_person_name' => $request->contact_person_name,
            // 'father_name' => 'N/A',
            // 'mother_name' => 'N/A',
            'gender' => $request->gender,
            // 'date_of_birth' => null,
            'nid' => $request->nid,
            'email_address' => $request->email_address,
            'opening_balance' => $request->opening_balance,
            'current_balance' => $request->opening_balance,
            'credit_limit' => $request->credit_limit,
            'contact_type' => $request->contact_type,
            'note' => $request->note,
        ]);

        if($contact) { 
            // insert to phone 
            foreach ($request->mobile_number as $index => $mobile) {
                Phone::create([
                    'contact_id' => $contact->id,
                    'mobile_number' => $mobile,
                    'is_primary' => ($index == 0) ? 1 : 0,
                ]);
            }

            // insert to address 
            // present address 
            Address::create([
                'contact_id' => $contact->id,
                'street' => $request->present_street,
                // 'postal_code' => null,
                'upazila' => $request->present_upazila,
                'district' => $request->present_district,
                'division' => $request->present_division,
                'address_type' => 'present_address',
            ]);

            // parmanent address 
            Address::create([
                'contact_id' => $contact->id,
                'street' => $request->permanent_street,
                // 'postal_code' => null,
                'upazila' => $request->permanent_upazila,
                'district' => $request->permanent_district,
                'division' => $request->permanent_division,
                'address_type' => 'permanent_address'
            ]);
            
        }

        // view + message 
        return redirect()->back()->withSuccess('Contact has been created successfully.'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $record = Contact::with(['phones', 'addresses'])->findOrFail($id);
        $contactTypes = config('contactdata.contactType');
        
        return view('accounting.contact.show', compact('record', 'contactTypes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        // get data from config
        $contactGender = config('contactdata.gender');
        $contactTypes = config('contactdata.contactType');

        // get specified resource 
        $record = Contact::with(['phones', 'addresses'])->findOrFail($id);
        
        // view 
        return view('accounting.contact.edit', compact('record', 'contactGender', 'contactTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        // find contact details
        $contact = Contact::findOrFail($id);

        // validation 
        $data = $request->validate([
            'organigation_name'     => 'required|string',
            'contact_person_name'   => 'required|string',
            "opening_balance"       => "required|numeric",
            'credit_limit'          => 'required|numeric',
            'nid'                   => 'required|string|min:10|max:17',
            'email_address'         => 'nullable|email|unique:contacts,email_address,' . $id,
            // mobile number 
            "mobile_number"         => "required|array|min:1",
            'mobile_number.*'       => 'required|numeric|distinct',
            // present address 
            'present_upazila'       => 'required|string',
            'present_district'      => 'required|string',
            'present_division'      => 'required|string',
            'present_street'        => 'required|string',
            // permanent address
            'permanent_upazila'     => 'nullable|string',
            'permanent_district'    => 'nullable|string',
            'permanent_division'    => 'nullable|string',
            'permanent_street'      => 'nullable|string',
            'contact_type'          => 'required|string',
            'note'                  => 'nullable|string'
        ], [
            'mobile_number.*.required' => 'The :attribute field is required.',
            'mobile_number.*.numeric' => 'The :attribute is not valid.',
            'mobile_number.*.distinct' => 'The :attribute field has a duplicate value.',
        ]);

        // insert to contact 
        $contact->update([
            'organigation_name' => $request->organigation_name,
            'contact_person_name' => $request->contact_person_name,
            'gender' => $request->gender,
            'nid' => $request->nid,
            'email_address' => $request->email_address,
            'opening_balance' => $request->opening_balance,
            'current_balance' => $request->opening_balance,
            'credit_limit' => $request->credit_limit,
            'contact_type' => $request->contact_type,
            'note' => $request->note,
        ]);

        if($contact) { 
            // remove phone details 
            foreach ($contact->phones as $phone) {
                Phone::findOrFail($phone->id)->delete();
            }

            // insert new phone details 
            foreach ($request->mobile_number as $index => $mobile) {
                Phone::create([
                    'contact_id' => $contact->id,
                    'mobile_number' => $mobile,
                    'is_primary' => ($index == 0) ? 1 : 0,
                ]);
            }

            // update present address details
            $present_address = Address::findOrFail($request->present_address_id);
            $present_address->update([
                'street' => $request->present_street,
                'upazila' => $request->present_upazila,
                'district' => $request->present_district,
                'division' => $request->present_division,
                'address_type' => 'present_address',
            ]);

            // update permanent address 
            $permanent_address = Address::findOrFail($request->permanent_address_id);
            $permanent_address->update([
                'street' => $request->permanent_street,
                'upazila' => $request->permanent_upazila,
                'district' => $request->permanent_district,
                'division' => $request->permanent_division,
                'address_type' => 'permanent_address'
            ]);
            
        }

        // view + message 
        return redirect()->back()->withSuccess('Contact details has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        // delete
        $contact = Contact::findOrFail($id);

        // view 
        if ($contact->delete()) {
            return redirect()->route('contact.index')->withSuccess('Contact has been deleted successfully.');
        } else {
            return back()->withErrors('Failed to delete contact.');
        }
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash() {
        // get contact type
        $contactTypes = config('contactdata.contactType');

        // get all accounts
        $records = Contact::onlyTrashed()->paginate($this->paginate);

        // search 
        if(request()->search) {
            $where = [];

            foreach (request()->filter as $key => $value) {
                if($key == 'group_id' && $value != null) {
                    $where[] = ['group_id', '=', $value];
                }

                if($key == 'particular' && $value != null) {
                    $where[] = ['particular', 'LIKE', "%" . $value . "%"];
                }
            }

            $records = Contact::onlyTrashed()->where($where)->paginate($this->paginate);
        }

        // view
        return view('accounting.contact.trash', compact('contactTypes', 'records'));
    }

    /**
     * 
     */
    public function restoreOrDelete(Request $request) {
        $message = "";

        if($request->contacts != null) {
            foreach ($request->contacts as $contact) {
                if($request->restore) {
                    Contact::withTrashed()->find($contact)->restore();
                    $message = 'Contacts has been restored successfully.';
                } else {
                    Contact::withTrashed()->find($contact)->forceDelete();
                    $message = 'Contact has been deleted permanently.';
                }
            }

            return redirect()->back()->withSuccess($message);
        }

        return redirect()->back()->withErrors('No record(s) has been selected.');
    }

    /**
     * 
     */
    public function restore($id) {
        // restore by id
        Contact::withTrashed()->find($id)->restore();

        // view
        return redirect()->back()->withSuccess('Contact has been restore successfully.');
    }

    /**
     * 
     */
    public function permanentDelete($id) {
        // Permanent delete by id
        Contact::withTrashed()->find($id)->forceDelete();

        // view 
        return redirect()->back()->withSuccess('Contact has been deleted permanently.');
    }

}
