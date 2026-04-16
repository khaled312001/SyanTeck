<?php

namespace App\Policies;

use App\Order;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    /**
     * Admin و Super Admin لديهم صلاحية كاملة
     */
    public function before(User $user, $ability)
    {
        if ($user->hasRole(['Admin', 'Super Admin'])) {
            return true;
        }
    }

    /**
     * عرض قائمة الطلبات
     */
    public function viewAny(User $user)
    {
        return $user->hasRole(['Support Agent', 'Finance', 'Quality Agent']);
    }

    /**
     * عرض تفاصيل طلب
     */
    public function view(User $user, Order $order)
    {
        // العميل يرى طلباته فقط
        if ($user->hasRole('Client') && $order->buyer_id == $user->id) {
            return true;
        }

        // الفني يرى الطلبات المخصصة له فقط
        if ($user->hasRole('Technician') && $order->seller_id == $user->id) {
            return true;
        }

        // الدعم والجودة والمالية يرون كل الطلبات
        return $user->hasRole(['Support Agent', 'Finance', 'Quality Agent']);
    }

    /**
     * تحديث حالة الطلب
     */
    public function updateStatus(User $user, Order $order)
    {
        // الدعم يمكنه تحديث أي طلب
        if ($user->hasRole('Support Agent')) {
            return true;
        }

        // الفني يمكنه تحديث حالة طلباته فقط
        if ($user->hasRole('Technician') && $order->seller_id == $user->id) {
            return true;
        }

        return false;
    }

    /**
     * تعيين فني للطلب
     */
    public function assignTechnician(User $user, Order $order)
    {
        return $user->hasRole('Support Agent');
    }

    /**
     * تحديث حالة الدفع
     */
    public function updatePayment(User $user, Order $order)
    {
        return $user->hasRole('Finance');
    }

    /**
     * إنشاء فاتورة
     */
    public function generateInvoice(User $user, Order $order)
    {
        if ($order->status < Order::STATUS_COMPLETED) {
            return false;
        }

        return $user->hasRole(['Support Agent', 'Finance', 'Technician']);
    }

    /**
     * إنشاء ضمان
     */
    public function generateWarranty(User $user, Order $order)
    {
        if ($order->status < Order::STATUS_COMPLETED) {
            return false;
        }

        return $user->hasRole(['Support Agent', 'Technician']);
    }

    /**
     * إنشاء متابعة جودة
     */
    public function createFollowup(User $user, Order $order)
    {
        if ($order->status < Order::STATUS_COMPLETED) {
            return false;
        }

        return $user->hasRole('Quality Agent');
    }
}
