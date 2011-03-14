<?php defined('SYSPATH') or die('No direct script access.');

class ORM extends Kohana_ORM {
    public function count_last_query() 
    {
        $sql = $this->last_query();

        if ($sql) 
        {
            if (stripos($sql, 'LIMIT') !== FALSE) 
            {
                // Remove LIMIT from the SQL
                $sql = preg_replace('/\sLIMIT\s+[^a-z]+/i', ' ', $sql);
            }
     
            if (stripos($sql, 'OFFSET') !== FALSE) {
                // Remove OFFSET from the SQL
                $sql = preg_replace('/\sOFFSET\s+\d+/i', '', $sql);
            }
            // Get the total rows from the last query executed
            $result = DB::query(
                Database::SELECT,
                'SELECT COUNT(*) AS total_rows '.
                'FROM ('.trim($sql).') AS counted_results'
            )->execute()->current();

            // Return the total number of rows from the query
            return (int) $result["total_rows"];
        }
 
        return FALSE;
     }
}
