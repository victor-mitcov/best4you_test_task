<?php

namespace App\Services;

use App\Branch;
use Illuminate\Database\Eloquent\Collection;

class BranchService
{
    /**
     * Creates new branch with given data
     *
     * @param array $data
     *
     * @return Branch
     */
    public function store(array $data) : Branch
    {
        $branch = new Branch($data);

        $branch->save();

        return $branch;
    }

    /**
     * Updates the branch with given data
     *
     * @param array $branchData
     *
     * @return Branch
     */
    public function update(array $branchData) : Branch
    {
        $branch = Branch::whereId($branchData['id'])->first();

        $branch->fill($branchData);

        $branch->save();

        return $branch;
    }

    /**
     * Deletes the branch and all children branches
     *
     * @param Branch $branch
     *
     * @return void
     * @throws \Exception
     */
    public function delete(Branch $branch) : void
    {
        $branchService = $this;

        $branch->children->each(function (Branch $branch) use ($branchService) {
            $branchService->delete($branch);
        });

        $branch->delete();
    }

    /**
     * Returns children branches for the given branch
     *
     * @param int $parentBranchId
     *
     * @return Collection
     */
    public function findChildren(int $parentBranchId) : Collection
    {
        return Branch::whereParentId($parentBranchId)->get();
    }
}