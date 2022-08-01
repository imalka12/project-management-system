<?php
namespace App\Repositories\Contracts;

use App\Models\Project;

interface ProjectRepositoryInterface
{

    /**
     * create new project entry
     * 
     * @param array $data
     * @return Project
     */
    public function create(array $data): Project;

    /**
     * get project by id 
     * 
     * @param mixed $id
     * @return Porject 
     */
    public function getProjectById($id): Project;

    /**
     * delete selected project entry
     * 
     * @param mixed $id
     * @return boolean
     */
    public function delete($id): bool;

    /**
     * update selected project entry
     * 
     * @param Project $project
     * @param array $data
     * @return boolean
     */
    public function update(Project $project, array $data): bool;

}