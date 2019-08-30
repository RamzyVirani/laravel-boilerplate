<?php

namespace App\Criteria;

use App\Helper\Util;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class UserCriteria.
 *
 * @package namespace App\Criteria;
 */
class UserCriteria extends BaseCriteria implements CriteriaInterface
{
    protected $role        = null;
    protected $query       = null;
    protected $latitude    = null;
    protected $longitude   = null;
    protected $area        = null;
    protected $distance    = null;
    protected $device_type = null;
    protected $graph       = null;


    private $distance_query = '( ? * acos ( cos ( radians( ? ) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians( ? ) ) + sin ( radians( ? ) ) * sin( radians( latitude ) ) ) ) AS distance';

    /**
     * Apply criteria in query repository
     *
     * @param string $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        // Check if Role Property is set
        if ($this->isset('role')) {
            // If Role Property is set, add a condition to include only those users who have this role
            $role  = $this->role;
            $model = $model->whereHas('roles', function ($q) use ($role) {
                return $q->where('id', $role);
            });
        }


        // Check if Query Property is set
        if ($this->isset('query')) {
            // If Query Property is set, add a like condition to include only those users who have this string in their name
            $query = $this->getLikeString($this->query);

            /**
             * Optimization: Add Search and Location Condition in Single WhereHas to reduce the size and filter of the query.
             */
            if ($this->isset('latitude') && $this->isset('longitude')) {
                // If query property and location properties are set,
                // then we would add a single whereHas with like query as well as distance query.
                $latitude      = $this->latitude;
                $longitude     = $this->longitude;
                $area          = $this->area;
                $distance      = $this->distance;
                $distanceQuery = $this->distance_query;
                $model         = $model
                    ->whereHas('details', function ($q) use ($area, $latitude, $longitude, $distance, $query, $distanceQuery) {
                        return $q->where('first_name', 'like', $query)
                            ->select('*')
                            ->selectRaw($distanceQuery, [$area, $latitude, $longitude, $latitude])
                            ->having('distance', '<', $distance)
                            ->orderBy('distance', 'asc');
                    });
            } else {
                // If only query property is set and location properties are not set
                // then we would only add like query
                $model = $model->whereHas('details', function ($q) use ($query) {
                    return $q->where('first_name', 'like', $query);
                });
            }
        } else if ($this->isset('latitude') && $this->isset('longitude')) {
            // else if query property is not set and location properties are set
            // then we would only add distance query.
            $latitude      = $this->latitude;
            $longitude     = $this->longitude;
            $area          = $this->area;
            $distance      = $this->distance;
            $distanceQuery = $this->distance_query;
            $model         = $model->whereHas('details', function ($q) use ($area, $latitude, $longitude, $distance, $distanceQuery) {
                return $q->select('*')->selectRaw($distanceQuery, [$area, $latitude, $longitude, $latitude])->having('distance', '<', $distance)->orderBy('distance', 'asc');
            });
            return $model;
        }

        // TODO: Add Conditions to check if User has a device whose type is equals to the type provided;
        // Check if Device Type Property is set
        if ($this->isset('device_type')) {
            // If Device Type Property is set, add a condition to include only those users who have this device type
            $device_type = $this->device_type;

            $model = $model->whereHas('devices', function ($q) use ($device_type) {
                return $q->where('device_type', $device_type);
            });
        }

        if ($this->isset('graph')) {
            if ($this->graph == Util::GRAPH_MONTHLY) {
                $model = $model->selectRaw('CONCAT(MONTH(created_at), "-",YEAR(created_at)) as month_year, count(id) as count')->groupBy('month_year')->where('created_at', '>', date('Y-m-01 00:00:00', strtotime('-1 Year')));
            }
        }

        return $model;
    }
}
