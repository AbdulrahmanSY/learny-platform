<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeacherWalletRequest;
use App\Http\Requests\UpdateTeacherWalletRequest;
use App\Models\Teacher;
use App\Models\TeacherWallet;
use Illuminate\Support\Facades\DB;

class TeacherWalletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getWallet()
    {
        $user_id = Auth()->id();
        $teacher = Teacher::where('user_id', $user_id)->first();

        $total = DB::table('teacher_wallets')->where('teacher_id',$teacher->id)
            ->sum(DB::raw('actual_of_hours * price'));

        $columnSums = TeacherWallet::where('teacher_id', $teacher->id)->select(
            DB::raw('COUNT(*) as total_records'),
            DB::raw('COALESCE(SUM(number_of_hours), 0) as number_of_hours_sum'),
            DB::raw('COALESCE(SUM(actual_of_hours), 0) as actual_of_hours_sum'),
            DB::raw('COALESCE(SUM(withdraw_money), 0) as withdraw_money_sum')
        )->first();
        $total_price =  $total-$columnSums->withdraw_money_sum;
        $columnSums->total_price =  $total_price;


        return $this->success($columnSums);

    }


}
