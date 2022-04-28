<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function __construct(Contact $contact)
    {
        $this->model = $contact;
    }

    public function index(Request $request)
    {
        $contacts = $this->model->all();
        // Listar contatos a partir da empresa
        // Filtrar através do link /api/contacts?company=Company Name&coditions=name=Contact Name;email=Contact Email
        if($request->has('company')) {
            $company_name = $request->get('company');
            $company = Company::where('name', $company_name)->first();
        }
        if($request->has('coditions')) {
            $expressions = explode(';', $request->get('coditions'));
            

            foreach($expressions as $e) {
                $exp = explode('=', $e);
                $contacts = Contact::where('company_id', $company['id'])
                                    ->where($exp[0], $exp[1])
                                    ->get();
            }
        }

        return response()->json([
            'success' => true,
            'data' => $contacts
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email'
        ]);

        if ($validator->fails())
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 422);

        $input = $request->all();

        $contact = new Contact();
        $contact->fill($input)->save();

        if ($contact->fill($input)->save())
            return response()->json([
                'success' => true,
                'message' => 'Successfully created'
            ], 201);

        return resonse()->json([
            'success' => false,
            'message' => 'Failed: could not create'
        ], 500);
    }

    public function update(Request $request, $id)
    {
        $contact = $this->model->find($id);
        //return response()->json($contact);

        if (!$contact)
            return response()->json([
                'success' => false,
                'message' => 'Not found'
            ], 404);

        $updated = $contact->fill($request->all())->save();

        if ($updated)
            return response()->json([
                'success' => true,
                'message' => 'Successfully updated'
            ], 200);

        return response()->json([
            'success' => false,
            'message' => 'Failed: could not update'
        ], 500);
    }

    public function destroy($id)
    {
        $contact = $this->model->find($id);

        if (!$contact)
            return response()->json([
                'success' => false,
                'message' => 'Not found'
            ], 404);

        if ($contact->delete())
            return response()->json([
                'success' => true,
                'message' => 'Successfully deleted'
            ], 202);

        return response()->json([
            'success' => false,
            'message' => 'Failed: could not delete'
        ], 500);
    }
}
