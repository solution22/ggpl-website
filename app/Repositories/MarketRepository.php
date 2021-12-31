<?php

namespace App\Repositories;

use App\Models\Market;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Traits\CacheableRepository;

/**
 * Class MarketRepository
 * @package App\Repositories
 * @version August 29, 2019, 9:38 pm UTC
 *
 * @method Market findWithoutFail($id, $columns = ['*'])
 * @method Market find($id, $columns = ['*'])
 * @method Market first($columns = ['*'])
 */
class MarketRepository extends BaseRepository implements CacheableInterface
{

    use CacheableRepository;
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'code',
        'description',
        'address',
        'address_line_1',
        'address_line_2',
        'city',
        'state',
        'pincode',
        'gender',
        'date_of_birth',
        'latitude',
        'longitude',
        'email',
        'phone',
        'mobile',
        'information',
        'delivery_fee',
        'default_tax',
        'type',
        'gstin',
        'delivery_range',
        'available_for_delivery',
        'closed',
        'admin_commission',
        'customer_group',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Market::class;
    }

    /**
     * get my markets
     */

    public function myMarkets()
    {
        return Market::join("user_markets", "market_id", "=", "markets.id")
            ->where('user_markets.user_id', auth()->id())->get();
    }

    public function myActiveMarkets()
    {
        return Market::join("user_markets", "market_id", "=", "markets.id")
            ->where('user_markets.user_id', auth()->id())
            ->where('markets.active','=','1')->get();
    }

}
