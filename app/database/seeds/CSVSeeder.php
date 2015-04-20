<?php

class CSVSeeder extends Seeder {

    public function SeedFromCSV($table, $filename)
    {
        $file = fopen('app/database/csv/'.$filename, 'r');
        $columns = fgetcsv($file, 5000, ',');

        /** Initialize row index to 0 */
        $rowIndex = 0;

        /** Initialize empty array */
        $dbArray=array();

        /** Read each row */
        while($data = fgetcsv($file, 5000, ','))
        {
            /** Initialize column index */
            $columnIndex = 0;

            /** For each column within a row, assign column name and value */
            foreach($data as $value)
            {
                $dbArray[$rowIndex][$columns[$columnIndex]] = $value;
                $columnIndex++;
            }
            $rowIndex++;
        }

        DB::table($table)->insert($dbArray);
    }
}