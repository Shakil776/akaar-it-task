<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // $procedure = "DROP PROCEDURE IF EXISTS `get_count`;
        //     CREATE PROCEDURE get_count
        //     (
        //         IN branchId INT
        //     )

        //     BEGIN

        //         SELECT COUNT(*) AS count
        //         FROM customers
        //         WHERE branch_id = branchId AND gender = 'M';

        //     END;";
  
        // \DB::unprepared($procedure);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
