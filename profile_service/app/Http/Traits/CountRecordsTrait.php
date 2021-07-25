<?php 

namespace App\Http\Traits;

trait CountRecordsTrait {

    /**
     * Count the total number of records
     * 
     * @param $data required An array of records
     *
     * @return string
     */
    public function count_records($data) : string
    {
        // Step 1: If $data is null, yes - no records, else count total records
        if(is_null($data))
        {
            // Step 2: Assign "No records" to message when data is null
            $message = "No record";

        } else {
            // Step 3: Count total records
            $total = count($data);

            // Step 4: Show numeric value of total records and append the string records (if more than one), else record (if one)
            // $message = $total." ".($total > 1 ? "Records" : "Record");
            $message = "Success";

        }
        
        // Step 5: Return the string, message
        return $message;
    }

    public function create_record($data) {
        if(!is_null($data)) {
            return "Created";
        }
    }

    public function select_record($data) {
        if($data == true) {
            return "Selected";
        }
    }

    public function update_record($data) {
        if($data == true) {
            return "Updated";
        }
    }

    public function delete_record($data) {
        if($data == true) {
            return "Deleted";
        }
    }

}