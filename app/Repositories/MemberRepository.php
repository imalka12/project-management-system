<?php
namespace App\Repositories;

use App\Models\Member;
use App\Repositories\Contracts\MemberRepositoryInterface;

class MemberRepository implements MemberRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function create(array $data): Member
    {
        return Member::create($data);
    }

    /**
     * @inheritDoc
     */
    public function delete($id): bool
    {
        return Member::whereId($id)->delete();
    }

    /**
     * @inheritDoc
     */
    public function update(Member $member, array $data): bool
    {
        return $member->update($data);
    }

}