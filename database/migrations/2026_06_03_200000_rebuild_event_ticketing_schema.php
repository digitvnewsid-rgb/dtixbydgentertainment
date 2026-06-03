<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('ticket_scans');
        Schema::dropIfExists('tickets');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('event_ticketing_staff');
        Schema::dropIfExists('ticket_types');
        Schema::dropIfExists('events');
        Schema::dropIfExists('venues');
        Schema::dropIfExists('event_categories');
        Schema::dropIfExists('categories');

        Schema::enableForeignKeyConstraints();

        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'phone')) {
                $table->string('phone', 30)->nullable()->after('email');
            }
            if (! Schema::hasColumn('users', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('role');
            }
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('creator_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('categories')->restrictOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('description')->nullable();
            $table->string('banner')->nullable();
            $table->string('location');
            $table->string('map_url')->nullable();
            $table->dateTime('start_datetime');
            $table->dateTime('end_datetime');
            $table->string('status', 20)->default('draft');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('ticket_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->unsignedInteger('price');
            $table->unsignedInteger('quota');
            $table->unsignedInteger('sold')->default(0);
            $table->unsignedTinyInteger('max_purchase')->default(5);
            $table->dateTime('sale_start');
            $table->dateTime('sale_end');
            $table->text('benefits')->nullable();
            $table->string('status', 20)->default('active');
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('customer_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('total_amount');
            $table->string('payment_method', 50)->default('manual_transfer');
            $table->string('payment_status', 20)->default('pending');
            $table->string('order_status', 20)->default('pending');
            $table->string('payment_proof')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->timestamps();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('ticket_type_id')->constrained()->restrictOnDelete();
            $table->unsignedSmallInteger('quantity');
            $table->unsignedInteger('price');
            $table->unsignedInteger('subtotal');
            $table->timestamps();
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('amount');
            $table->string('method', 50);
            $table->string('status', 20)->default('pending');
            $table->string('proof_path')->nullable();
            $table->foreignId('validated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('validated_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_code')->unique();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->foreignId('ticket_type_id')->constrained()->restrictOnDelete();
            $table->foreignId('customer_id')->constrained('users')->cascadeOnDelete();
            $table->string('attendee_name');
            $table->string('attendee_email');
            $table->string('qr_token', 64)->unique();
            $table->string('qr_code_path')->nullable();
            $table->string('status', 20)->default('active');
            $table->timestamp('used_at')->nullable();
            $table->timestamps();
        });

        Schema::create('ticket_scans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->constrained()->cascadeOnDelete();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->foreignId('scanned_by')->constrained('users')->cascadeOnDelete();
            $table->string('scan_status', 20);
            $table->string('scan_message');
            $table->timestamp('scanned_at');
            $table->timestamps();
        });

        Schema::create('event_ticketing_staff', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['event_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('event_ticketing_staff');
        Schema::dropIfExists('ticket_scans');
        Schema::dropIfExists('tickets');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('ticket_types');
        Schema::dropIfExists('events');
        Schema::dropIfExists('categories');
        Schema::enableForeignKeyConstraints();
    }
};
