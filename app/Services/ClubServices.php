<?php

namespace App\Services;

use App\Exceptions\ServerErrorException;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Club;
use Exception;

class ClubServices
{
    public function get($request)
    {
        $perPage = $request->query('size', 10);
        $page = $request->query('number', 1);

        $query = QueryBuilder::for(Club::class)
                ->allowedSorts(['id','created_at'])
                ->allowedFilters(['id', 'name'])
                ->paginate($perPage, ['*'], 'page', $page);

        $data = $query->toArray();

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mendapatkan data',
            'data' => $data,
        ], 200);
    }

    public function create($request)
    {
        try {
            $club = new Club;
            $club->fill($request->all());
            $club->save();
            
            $data = $club->toArray();

            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil mendapatkan data',
                'data' => $data,
            ], 200);
        } catch (Exception $e) {
            throw new ServerErrorException($e->getMessage(),$e);
        }
    }

    // public function update($request)
    // {
    //     //cek authorization
    //     $this->cekSession();
    //     //cek klien ada atau tidak
    //     $this->cekKlien($request->id);
    //     try {
    //         $klien = Klien::find($request->id);
    //         $klien->fill($request->except('id'));
    //         $klien->account_officer_id = $this->auth->id;
    //         $klien->save();
    //         return responseJson('success', 'Berhasil mengubah data', $klien, 200);
    //     } catch (Exception $e) {
    //         throw new ServerErrorException($e->getMessage(),$e);
    //     }
    // }

    // public function delete($request)
    // {
    //     //cek authorization
    //     $this->cekSession();
    //     //cek klien ada atau tidak
    //     $this->cekKlien($request->id);
    //     try {
    //         $klien = Klien::find($request->id);
    //         $klien->status = 0;
    //         $klien->save();
    //         return responseJson('success', 'Berhasil menghapus data', $klien, 200);
    //     } catch (Exception $e) {
    //         throw new ServerErrorException($e->getMessage(),$e);
    //     }
    // }

    // public function cekKlien($id){
    //     $klien = Klien::find($id);
    //     if(!isset($klien)){
    //         $message=array(
    //             'status' => 'not_found',
    //             'message' => 'Data klien tidak ditemukan',
    //             'data' => []
    //         );
    //         response()->json($message, 404)->throwResponse();
    //     }
    // }
}
