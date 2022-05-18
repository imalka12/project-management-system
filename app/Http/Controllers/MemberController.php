<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMemberRequest;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function showCreateMembers()
    {
        $members = Member::all();
        return view('members', compact('members'));
    }

    public function addMember(CreateMemberRequest $request)
    {
        $data = $request->validated();

        Member::create($data);

        return redirect()->route('create-member')->with('success', 'New member added successfully.');
    }

    public function deleteMember(Member $member)
    {
        $member->delete();
        return redirect()->route('create-member')->with('success', 'Member deleted successfully.');
    }

    public function editMember(Member $member)
    {
        return view('members-edit', compact('member'));
    }

    public function updateMember(CreateMemberRequest $request, Member $member)
    {
        // $data = Member::whereId($member->id)->first();
        // $data->name = $request->get('name');
        // $data->save();
        
        $member = Member::whereId($member->id)->first();
        $member->update([
            'name' => $request->get('name'),
            'address' => $request->get('address'),
            'email' => $request->get('email'),
            'telephone' => $request->get('telephone'),
            'whatsapp_number' => $request->get('whatsapp_number'),

        ]);

        return redirect()->route('create-member');
    }
}
