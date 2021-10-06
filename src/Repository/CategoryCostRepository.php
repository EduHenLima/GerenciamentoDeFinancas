<?php
declare(strict_types=1);

namespace SONFin\Repository;

use Illuminate\Database\Eloquent\Collection;
use SONFin\Models\BillPay;
use SONFin\Models\BillReceive;
use SONFin\Models\CategoryCosts;

class CategoryCostRepository extends DefaultRepository implements CategoryCostRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(CategoryCosts::class);
    }

    public function sumByPeriod(string $dateStart, string $dateEnd, int $userId): array
    {
        $categories = CategoryCosts::query()
            ->selectRaw('category_costs.name, sum(value) as value')
            ->leftJoin('bill_pays', 'bill_pays.category_cost_id', '=', 'category_costs.id')
            ->whereBetween('date_launch',[$dateStart,$dateEnd])
            ->where('category_costs.user_id', $userId)
            ->whereNotNull('bill_pays.category_cost_id')
            ->groupBy('value')
            ->groupBy('category_costs.name')
            ->get();

        return $categories->toArray();
    }
}
