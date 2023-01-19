<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ProductOrderRepository;
use App\Entities\ProductOrder;

/**
 * Class ProductOrderRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ProductOrderRepositoryEloquent extends BaseRepository implements ProductOrderRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProductOrder::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
