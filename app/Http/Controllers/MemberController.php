<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMemberRequest;
use App\Models\Member;
use App\Services\MemberService;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public $member;

    public function __construct(MemberService $memberService)
    {
        $this->member = $memberService;
    }

    /**
     * show create member page to add member
     * 
     * @return void
     */
    public function showCreateMembers()
    {
        $members = Member::all();
        return view('members', compact('members'));
    }

    /**
     * process create member request
     * 
     * @param CreateMemberRequest @request
     */
    public function addMember(CreateMemberRequest $request)
    {
        $this->member->create($request);

        return redirect()->route('create-member')->with('success', 'New member added successfully.');
    }

    /**
     * process delete member request
     * 
     * @param Member $member
     */
    public function deleteMember(Member $member)
    {
        $this->member->delete($member);
        return redirect()->route('create-member')->with('success', 'Member deleted successfully.');
    }

    /**
     * show edit member page to update details
     * 
     * @param Member $member
     */
    public function editMember(Member $member)
    {
        return view('members-edit', compact('member'));
    }

    /**
     * process update member request
     * 
     * @param CreateMemberRequest $request
     * @param Member $member
     */
    public function updateMember(CreateMemberRequest $request, Member $member)
    {
        $this->member->update($member, $request);
        
        return redirect()->route('create-member');
    }


    //js 

    public function showMembersPage()
    {
        return view('members_js');
    }

    public function createNewMember(CreateMemberRequest $request)
    {
        $data = $request->validated();
        $member = Member::create($data);

        return $member;
    }

    public function getAllMembers()
    {
        $members = Member::all();

        return $members;
    }

    public function updateSelectedMember(CreateMemberRequest $request, Member $member)
    {
        $member = Member::whereId($member->id)->first();

        $member->update([
            'name' => $request->get('name'),
            'address' => $request->get('address'),
            'email' => $request->get('email'),
            'telephone' => $request->get('telephone'),
            'whatsapp_number' => $request->get('whatsapp_number'),
        ]);

        return $member;
    }

    public function deleteSelectedMember(Member $member)
    {
        $member = Member::whereId($member->id)->first();
        // dd($member);
        $member->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Member record deleted successfully..',
        ]);
    }

    public function getMember(Member $member)
    {
     return $member;
    }


    //member profile - photo uploading
    public function showMemberProfilePage()
    {
        return view('member-profile');
    }
}
