<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('country', 2)->nullable()->after('email');
            $table->string('phone')->nullable()->after('country');
            $table->string('address')->nullable()->after('phone');
            $table->string('currency', 3)->default('USD')->after('address');
            $table->string('stripe_id')->nullable()->after('currency');
            $table->string('pm_type')->nullable()->after('stripe_id');
            $table->string('pm_last_four', 4)->nullable()->after('pm_type');
            $table->timestamp('trial_ends_at')->nullable()->after('pm_last_four');
        });

        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('type');
            $table->string('stripe_id')->unique();
            $table->string('stripe_status');
            $table->string('stripe_price')->nullable();
            $table->integer('quantity')->nullable();
            $table->timestamp('trial_ends_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->timestamps();
            $table->index(['user_id', 'stripe_status']);
        });

        Schema::create('subscription_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subscription_id')->constrained()->cascadeOnDelete();
            $table->string('stripe_id')->unique();
            $table->string('stripe_product')->nullable();
            $table->string('stripe_price');
            $table->integer('quantity')->nullable();
            $table->timestamps();
        });

        Schema::create('utility_providers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('country', 2);
            $table->enum('utility_type', ['electricity', 'gas', 'water', 'internet', 'other']);
            $table->string('logo')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('utility_provider_id')->nullable()->constrained()->nullOnDelete();
            $table->enum('utility_type', ['electricity', 'gas', 'water', 'internet', 'other']);
            $table->string('currency', 3)->default('USD');
            $table->decimal('amount', 10, 2)->nullable();
            $table->date('billing_period_start')->nullable();
            $table->date('billing_period_end')->nullable();
            $table->string('file_path')->nullable();
            $table->text('extracted_text')->nullable();
            $table->enum('status', ['uploaded', 'processing', 'analyzed', 'disputed', 'resolved', 'failed'])->default('uploaded');
            $table->timestamps();
        });

        Schema::create('bill_analyses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bill_id')->constrained()->cascadeOnDelete();
            $table->json('errors')->nullable();
            $table->decimal('overcharge_amount', 10, 2)->default(0);
            $table->string('currency', 3)->default('USD');
            $table->longText('dispute_letter')->nullable();
            $table->json('ai_response')->nullable();
            $table->string('report_pdf_path')->nullable();
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');
            $table->timestamps();
        });

        Schema::create('disputes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bill_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('bill_analysis_id')->nullable()->constrained()->nullOnDelete();
            $table->enum('status', ['draft', 'sent', 'in_review', 'resolved', 'rejected'])->default('draft');
            $table->string('letter_pdf_path')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('disputes');
        Schema::dropIfExists('bill_analyses');
        Schema::dropIfExists('bills');
        Schema::dropIfExists('utility_providers');
        Schema::dropIfExists('subscription_items');
        Schema::dropIfExists('subscriptions');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['country','phone','address','currency','stripe_id','pm_type','pm_last_four','trial_ends_at']);
        });
    }
};
