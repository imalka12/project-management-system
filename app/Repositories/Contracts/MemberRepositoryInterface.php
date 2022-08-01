<?php
namespace App\Repositories\Contracts;

use App\Models\Member;

interface MemberRepositoryInterface
{
    /**
     * create new member entry
     * 
     * @param array $data
     * @return Member
     */
    public function create(array $data): Member;

    /**
     * delete selected entry
     * 
     * @param mixed $id
     * @return boolean
     */
    public function delete($id): bool;

    /**
     * update selected entry
     * 
     * @param Member $member
     * @param array $data
     * @return boolean
     */
    public function update(Member $member, array $data): bool;

}