<?php

namespace App\Filament\Widgets;

use App\Models\Bill;
use App\Models\BillAnalysis;
use App\Models\Dispute;
use App\Models\Inquiry;
use App\Models\User;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\DB;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;


    protected function getStats(): array
    {
        $totalUsers = User::count();
        $newUsersThisMonth = User::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $totalBills = Bill::count();
        $billsThisMonth = Bill::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $openDisputes = Dispute::whereIn('status', ['draft', 'sent', 'in_review'])->count();
        $resolvedDisputes = Dispute::where('status', 'resolved')->count();

        $newLeads = Inquiry::where('status', 'new')->count();
        $totalLeads = Inquiry::count();

        $totalOvercharges = BillAnalysis::where('status', 'completed')
            ->sum('overcharge_amount');

        $activeSubscriptions = DB::table('subscriptions')
            ->whereIn('stripe_status', ['active', 'trialing'])
            ->count();

        $userSparkline = $this->getMonthlySparkline(new User(), 6);
        $billSparkline  = $this->getMonthlySparkline(new Bill(), 6);
        $disputeSparkline = $this->getMonthlySparkline(new Dispute(), 6);
        $inquirySparkline = $this->getMonthlySparkline(new Inquiry(), 6);

        return [
            Stat::make('Total Users', number_format($totalUsers))
                ->description("+{$newUsersThisMonth} this month")
                ->descriptionIcon(Heroicon::OutlinedUserGroup)
                ->descriptionColor('success')
                ->icon(Heroicon::OutlinedUsers)
                ->color('info')
                ->chart($userSparkline)
                ->chartColor('info'),

            Stat::make('Bills Submitted', number_format($totalBills))
                ->description("+{$billsThisMonth} this month")
                ->descriptionIcon(Heroicon::OutlinedDocumentText)
                ->descriptionColor('primary')
                ->icon(Heroicon::OutlinedDocumentCurrencyDollar)
                ->color('primary')
                ->chart($billSparkline)
                ->chartColor('primary'),

            Stat::make('Open Disputes', number_format($openDisputes))
                ->description("{$resolvedDisputes} resolved total")
                ->descriptionIcon(Heroicon::OutlinedCheckCircle)
                ->descriptionColor('success')
                ->icon(Heroicon::OutlinedExclamationCircle)
                ->color($openDisputes > 0 ? 'warning' : 'success')
                ->chart($disputeSparkline)
                ->chartColor('warning'),

            Stat::make('New Leads', number_format($newLeads))
                ->description("{$totalLeads} total inquiries")
                ->descriptionIcon(Heroicon::OutlinedInbox)
                ->descriptionColor('gray')
                ->icon(Heroicon::OutlinedChatBubbleLeftRight)
                ->color('danger')
                ->chart($inquirySparkline)
                ->chartColor('danger'),

            Stat::make('Total Overcharges Found', '$' . number_format($totalOvercharges, 2))
                ->description('From completed analyses')
                ->descriptionIcon(Heroicon::OutlinedBanknotes)
                ->descriptionColor('warning')
                ->icon(Heroicon::OutlinedCurrencyDollar)
                ->color('warning'),

            Stat::make('Active Subscriptions', number_format($activeSubscriptions))
                ->description('Active & trialing plans')
                ->descriptionIcon(Heroicon::OutlinedCreditCard)
                ->descriptionColor('success')
                ->icon(Heroicon::OutlinedCreditCard)
                ->color('success'),
        ];
    }

    private function getMonthlySparkline($model, int $months): array
    {
        $data = [];
        for ($i = $months - 1; $i >= 0; $i--) {
            $data[] = (float) $model::whereYear('created_at', now()->subMonths($i)->year)
                ->whereMonth('created_at', now()->subMonths($i)->month)
                ->count();
        }
        return $data;
    }
}
