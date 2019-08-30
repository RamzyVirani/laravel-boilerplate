<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class CategoryCriteria.
 *
 * @package namespace App\Criteria;
 */
class BaseCriteria
{

    const LIKE_TYPE_BOTH = 0;
    const LIKE_TYPE_BEFORE = 10;
    const LIKE_TYPE_AFTER = 20;

    /**
     * BaseCriteria constructor.
     * @param array $settings
     */
    public function __construct($settings = [])
    {
        $settings = is_array($settings) ? $settings : [$settings];
        foreach ($settings as $prop => $value) {
            if (property_exists($this, $prop)) {
                $this->$prop = $value;
            }
        }
    }

    public function isset($property)
    {
        return ($this->$property !== null);
    }

    /**
     * @param $str
     * @param int $type
     * @return string
     */
    public function getLikeString($str, $type = self::LIKE_TYPE_BOTH)
    {
        switch ($type) {
            case self::LIKE_TYPE_BEFORE:
                return "%" . $str;
            case self::LIKE_TYPE_AFTER:
                return $str . "%";
            default:
            case self::LIKE_TYPE_BOTH:
                return "%" . $str . "%";
        }
        return $str;
    }
}