<?php

namespace App\Helper;

use Illuminate\Support\Facades\DB;

/**
 * Class UtilHelper
 * @package App\Helper
 */
class Util
{
    const BOOL_FALSE = 0;
    const BOOL_TRUE  = 1;

    const GRAPH_MONTHLY = 0;
    const GRAPH_YEARLY  = 10;

    public static $BOOLS = [
        self::BOOL_FALSE => "No",
        self::BOOL_TRUE  => "Yes",
    ];

    public static $BOOLS_CSS = [
        self::BOOL_FALSE => "danger",
        self::BOOL_TRUE  => "success",
    ];

    public static $BOOLS_BG_CSS = [
        self::BOOL_FALSE => "red",
        self::BOOL_TRUE  => "green",
    ];

    /**
     * @param $value
     * @return mixed
     */
    public static function getBoolText($value)
    {
        return self::$BOOLS[$value];
    }

    /**
     * @param $value
     * @param bool $bg
     * @return mixed
     */
    public static function getBoolCss($value, $bg = false)
    {
        return $bg ? self::$BOOLS_BG_CSS[$value] : self::$BOOLS_CSS[$value];
    }

    public static function getDataTableParams()
    {
        return ['responsive' => true,];
    }

    public function readCSV($file, $colName = 0)
    {
        $row             = 0;
        $rows            = $columns = [];
        $autoLineEndings = ini_get('auto_detect_line_endings');
        ini_set('auto_detect_line_endings', TRUE);

        if (($handle = fopen(public_path() . '/csv/' . $file, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
                if (count($data) <= 1) {
                    $columns[] = $data;
                    continue;
                }
                $row++;
                if ($row == 1) {
                    $columns[] = $data;
                    continue;
                }
                $rows[] = $data;
            }
            fclose($handle);
        }
        ini_set('auto_detect_line_endings', $autoLineEndings);

        if ($colName) {
            return [
                'rows'    => $rows,
                'columns' => $columns
            ];
        } else {
            return $rows;
        }
    }

    public function updateCSV($file, $data)
    {
        $current_content = $this->readCSV($file, 1);
        $new_data[0]     = $data;
        $new_content     = array_merge($current_content['columns'], $current_content['rows'], $data);

        $fp = fopen(public_path() . '/csv/' . $file, 'w');
        foreach ($new_content as $content) {
            fputcsv($fp, $content);
        }
        fclose($fp);

        return true;
    }

    public function seedWithCSV($file)
    {
        $newData = [];
        $data    = $this->readCSV($file, 1);

        foreach ($data['rows'] as $key => $row) {
            foreach ($row as $keys => $item) {
                $newData[$key][$data['columns'][0][$keys]] = $item;
            }
        }
        return $newData;
    }
}