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
        $procedure = "DROP PROCEDURE IF EXISTS `GetCounts`;
            CREATE PROCEDURE GetCounts()

            BEGIN

                SELECT COUNT(*) as total_customer from customers GROUP BY branch_id 

                UNION
    
                SELECT COUNT(*) AS total_male_customer from customers WHERE gender = 'M' GROUP BY branch_id

                UNION

                SELECT COUNT(*) AS total_female_customer from customers WHERE gender = 'F' GROUP BY branch_id;

            END;";
  
        \DB::unprepared($procedure);
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
