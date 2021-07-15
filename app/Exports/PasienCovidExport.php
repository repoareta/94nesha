<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\PasienCovid;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;

class PasienCovidExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    public function collection()
    {
        $datas = PasienCovid::with(['province', 'regency','district','village'])
                            ->select(
                                'nama',
                                'jurusan',
                                'nama_kontak',
                                'no_kontak',
                                'jenkel',
                                'goldar',
                                'tgl_negatif',
                                'province_id',
                                'regency_id',
                                'district_id',
                                'village_id',
                                'kondisi',
                                'status',
                                'ket_status',
                                'kebutuhan',
                                'meninggal_dunia',
                                )
                            ->get();
        
        foreach($datas as $data){
            if($data->jenkel == 'L'){
                $data->jenkel = 'Laki-laki';
            }else{
                $data->jenkel = 'Perempuan';
            }
            $data->tgl_negaqtif = Carbon::parse($data->tgl_negaqtif)->locale('id')->isoFormat('LL');
            $data->province_id = $data->province->name;
            $data->regency_id = $data->regency->name;
            $data->district_id = $data->district ? $data->district->name : '';
            $data->village_id = $data->village ? $data->village->name : '';
            $data->status = $data->status == true ? 'Isolasi Mandiri' : 'Rumah Sakit';
        }

        return $datas;
    }

    public function headings() : array
    {
        return [
            'Nama',
            'Jurusan',
            'Nama Kontak',
            'No Kontak',
            'Jenkel',
            'Goldar',
            'Tanggal Negatif',
            'Provinsi',
            'Kabupaten',
            'Kecamatan',
            'Desa',
            'Kondisi Saat Ini',
            'Status',
            'Keterangan Status',
            'Kebutuhan',
            'Meninggal Dunia',
        ];
    }
}
