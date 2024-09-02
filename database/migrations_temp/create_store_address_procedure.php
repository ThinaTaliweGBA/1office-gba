<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $store_country_procedure = "DROP PROCEDURE IF EXISTS `store_country`;
        

        CREATE PROCEDURE `store_country`(IN `cname` TEXT)
        BEGIN
        declare country_id SMALLINT(5);
          SELECT id INTO country_id FROM country WHERE name = cname LIMIT 1;
        
          IF (country_id IS NULL) THEN
            INSERT INTO country(name) VALUES (cname);
          END IF;
        END;";

        \DB::unprepared($store_country_procedure);


        $store_province_procedure = "DROP PROCEDURE IF EXISTS `store_province`;
        

        
        CREATE PROCEDURE `store_province`(IN `pname` VARCHAR(255), IN `countryID` INT)
        BEGIN
        declare province_id SMALLINT(5);
          SELECT id INTO province_id FROM province WHERE name = pname AND country_id = countryID LIMIT 1;

          IF (province_id IS NULL) THEN
            INSERT INTO province(name, country_id) VALUES (pname, countryID);
          END IF;
        END;";

        \DB::unprepared($store_province_procedure);


        $store_city_procedure = "DROP PROCEDURE IF EXISTS `store_city`;
        

        
        CREATE PROCEDURE `store_city`(IN `cityname` VARCHAR(255), IN `countryID` INT, IN `provinceID` INT)
          BEGIN
          declare city_id SMALLINT(5);
            SELECT id INTO city_id FROM city WHERE name = cityname AND country_id = countryID AND province_id = provinceID LIMIT 1;

            IF (city_id IS NULL) THEN
              INSERT INTO city(name,country_id,province_id) VALUES (cityname,countryID,provinceID);
            END IF;
          END;";

        \DB::unprepared($store_city_procedure);


    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_address_procedure');
    }
};
