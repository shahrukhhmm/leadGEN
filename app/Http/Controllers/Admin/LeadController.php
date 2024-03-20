<?php

namespace App\Http\Controllers\Admin;

use App\Models\Lead;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LeadController extends Controller
{

    public function get(){
        $leadData = Lead::get();

        return view('Lead.index', compact('leadData'));
    }


    public function create()
    {
        return view('Lead.create');
    }

    public function store(Request $request)
    {
        $leadData = $request->except('_token');
        $jsonData = json_encode($leadData);

        Lead::insert([
            'lead_data' => $jsonData,
            'created_at'=>now()
        ]);

        return redirect()->back()->with('success', 'Lead added successfully!');
    }

    public function edit($leadId)
    {
        $lead = Lead::find($leadId);
        $leadData = json_decode($lead->lead_data, true);

        return view('Lead.edit', compact('leadData', 'leadId'));
    }

    public function update(Request $request, $id)
    {
        $leadData = $request->except('_token', '_method');
        $jsonData = json_encode($leadData);

        Lead::where('id', $id)->update([
            'lead_data' => $jsonData,
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Lead updated successfully!');
    }

    public function delete($leadId){
        $lead = Lead::find($leadId);

        $lead->delete();

        return redirect()->back();
    }
}
