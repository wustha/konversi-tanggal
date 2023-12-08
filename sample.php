<?php

/**
 * Create callback method
 * Change date format
 *
 * $db_connection   mysqli  database connection
 * $data            array   row data
 * $index           int     index of current column
 */
function formatDate($db_connection, $data, $index) {
    // modify format from Y-m-d to d-m-y
    // for example: from 2023-12-07 to 07-12-2023 
    return date('d-m-Y', strtotime($data[$index]));
}

// create datagrid instance
$reportgrid = new report_datagrid();

// define table spec
$table_spec = 'visitor_count';

// define column
$reportgrid->setSQLColumn(
    'member_id AS \''.__('Member ID').'\'',     // index 0
    'member_name AS \''.__('Member Name').'\'', // index 1
    'checkin_date AS \''.__('Visit Date').'\''  // index 2, we'll change this column value
);

/**
 * Modify column content of field in datagrid
 *
 * @param_1 index of column      int
 * @param_2 any thing you want, if its a callback use format callback{method_name_here}
 */
$reportgrid->modifyColumnContent(2, 'callback{formatDate}');

// create output
echo $reportgrid->createDataGrid($dbs, $table_spec, $num_recs_show);