<?php
/**
 * File name: ProductRepository.php
 * Last modified: 2020.06.07 at 07:02:57
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Repositories;

use App\Models\InventoryTrack;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Traits\CacheableRepository;

/**
 * Class ProductRepository
 * @package App\Repositories
 * @version August 29, 2019, 9:38 pm UTC
 *
 * @method Product findWithoutFail($id, $columns = ['*'])
 * @method Product find($id, $columns = ['*'])
 * @method Product first($columns = ['*'])
 */
class InventoryRepository extends BaseRepository implements CacheableInterface
{

    use CacheableRepository;
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'purchase_invoice_id',
        'inventory_track_category',
        'inventory_track_type',
        'inventory_track_date',
        'inventory_track_product_id',
        'inventory_track_product_quantity',
        'inventory_track_product_uom',
        'inventory_track_description',
        'inventory_track_usage'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return InventoryTrack::class;
    }

    /**
     * get my products
     **/
    public function myProducts()
    {
        return Product::join("user_markets", "user_markets.market_id", "=", "products.market_id")
            ->where('user_markets.user_id', auth()->id())->get();
    }

    public function groupedByMarkets()
    {
        $products = [];
        foreach ($this->all() as $model) {
            if(!empty($model->market)){
            $products[$model->market->name][$model->id] = $model->name;
        }
        }
        return $products;
    }
}