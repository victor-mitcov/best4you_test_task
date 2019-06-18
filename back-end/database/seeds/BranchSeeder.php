<?php

use App\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $branches = factory(Branch::class, rand(3, 5))->create([
            'parent_id' => 0
        ]);

        for ($i = 1; $i <= 3; $i++) {
            $childBranches = collect();

            $branches->each(function ($branch) use (&$childBranches, $i) {
                $temp = factory(Branch::class, rand(0, 3))->create([
                    'parent_id' => $branch->id
                ]);

                $childBranches = $childBranches->merge($temp);
            });
            $branches = $childBranches;
        }
    }
}
