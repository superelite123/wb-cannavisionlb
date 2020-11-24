<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name',255)->nullable();
            $table->string('legalname',255)->nullable();
            $table->string('primarycontact',255)->nullable();
            $table->string('companyemail',255)->nullable();
            $table->string('companyphone',255)->nullable();
            $table->string('secondaryc_name',255)->nullable();
            $table->string('secondaryc_phone',255)->nullable();
            $table->string('secondaryc_email',255)->nullable();
            $table->string('accounting_name',255)->nullable();
            $table->string('accounting_phone',255)->nullable();
            $table->string('accounting_email',255)->nullable();
            $table->string('fax',255)->nullable();
            $table->string('deliveryc',255)->nullable();
            $table->string('deliverye',255)->nullable();
            $table->string('deliveryp',255)->nullable();
            $table->string('deliveryday',255)->nullable();
            $table->string('salesrep',255)->nullable();
            $table->string('accountmanager',255)->nullable();
            $table->string('address1',255)->nullable();
            $table->string('address2',255)->nullable();
            $table->string('city',255)->nullable();
            $table->integer('county')->nullable();
            $table->integer('state')->nullable();
            $table->string('zip',255)->nullable();
            $table->string('resale',255)->nullable();
            $table->string('licensenumber',255)->nullable();
            $table->string('companylic',255)->nullable();
            $table->string('licensetype',255)->nullable();
            $table->dateTime('licensevalid')->nullable();
            $table->dateTime('licenseexpire')->nullable();
            $table->longText('licenseul')->nullable();
            $table->string('sellers_permit',255)->nullable();
            $table->string('website',255)->nullable();
            $table->string('ein',255)->nullable();
            $table->integer('terms')->nullable();
            $table->integer('status')->nullable();
            $table->integer('servicezone')->nullable();
            $table->integer('tags')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
