<?php
namespace App\Services;

use App\Http\Requests\CreateMemberRequest;
use App\Models\Member;
use App\Repositories\MemberRepository;

class MemberService
{
    public $memberRepository;

    public function __construct(MemberRepository $memberRepository)
    {
        $this->memberRepository = $memberRepository;
    }

    public function create(CreateMemberRequest $request): Member
    {
        $data = $request->validated();

        return $this->memberRepository->create($data);
    }

    public function delete(Member $member)
    {
        return $this->memberRepository->delete($member->id);
    }

    public function update(Member $member, CreateMemberRequest $request)
    {
        $data = $request->validated();
        return $this->memberRepository->update($member, $data);
    }

}