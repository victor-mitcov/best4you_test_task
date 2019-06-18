<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Http\Requests\StoreBranchFormRequest;
use App\Http\Requests\UpdateBranchRequest;
use App\Services\BranchService;
use Illuminate\Support\Facades\Log;

class BranchController extends Controller
{
    /** @var BranchService $branchService */
    private $branchService;

    /**
     * BranchController constructor.
     *
     * @param BranchService $branchService
     */
    public function __construct(BranchService $branchService)
    {
        $this->branchService = $branchService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param $parentBranchId
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function list($parentBranchId)
    {
        return $this->branchService->findChildren($parentBranchId);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBranchFormRequest $request
     *
     * @return void
     */
    public function store(StoreBranchFormRequest $request): void
    {
        $this->branchService->store($request->validated());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBranchRequest $request
     *
     * @return void
     */
    public function update(UpdateBranchRequest $request)
    {
        $this->branchService->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Branch $branch
     *
     * @return void
     */
    public function destroy(Branch $branch)
    {
        try {
            $this->branchService->delete($branch);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage(), ['exception' => $exception]);
        }
    }
}
