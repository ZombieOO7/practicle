<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BaseController extends Controller
{
        /**
     * -------------------------------------------------------------
     * | DB transation start                                       |
     * |                                                           |
     * | @return Void                                              |
     * -------------------------------------------------------------
     */
    public function dbStart()
    {
        DB::beginTransaction();
    }

    /**
     * -------------------------------------------------------------
     * | DB transation end                                         |
     * |                                                           |
     * | @return Void                                              |
     * -------------------------------------------------------------
     */

    public function dbEnd()
    {
        DB::commit();
    }

    /**
     * -------------------------------------------------------------
     * | DB transation roll back                                   |
     * |                                                           |
     * | @return Void                                              |
     * -------------------------------------------------------------
     */
    public function dbRollBack()
    {
        DB::rollback();
    }
}
