<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Http\Helper\ApiHelper;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RiwayatAktifitasController extends Controller
{
    public function index()
    {
        try {

            DB::beginTransaction();
            $data = [];

            $client = new Client([
                "timeout" => 10
            ]);
            DB::commit();

            $transUmum = $client->post(ApiHelper::apiUrl("organization/account/admin/history_activity"));
            $responseBodyUmum = json_decode($transUmum->getBody(), true);

            
            if ($responseBodyUmum["statusCode"] == 200 && $responseBodyUmum["statusCode"] == 200) {
                $data["umum"] = $responseBodyUmum["data"];
                $memberAccountCode = session("data")["member_account_code"];

                $filteredUmum = array_filter($data["umum"], function($umum) use ($memberAccountCode) {
                    return $umum["parent_id"] == $memberAccountCode;
                });

                $data["array_filter_umum"] = $filteredUmum;
            }

            return view("pages.transaksi.riwayat-aktifitas.index", $data);
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("pages.dashboard")->with("error", $e->getMessage());
        }
    }
}
