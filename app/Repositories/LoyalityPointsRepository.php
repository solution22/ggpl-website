<?php

namespace App\Repositories;

use App\Models\LoyalityPoints;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class LoyalityPointsRepository
 * @package App\Repositories
 * @version September 4, 2019, 3:38 pm UTC
 *
 * @method Cart findWithoutFail($id, $columns = ['*'])
 * @method Cart find($id, $columns = ['*'])
 * @method Cart first($columns = ['*'])
*/
class LoyalityPointsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'affiliate_id',
        'point_type',
        'points',
        'referee_mobile'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return LoyalityPoints::class;
    }
}
