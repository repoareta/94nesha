<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\PasienCovid;
use App\Models\PenyintasCovid;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;

class PenyintasPasienCovidExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    public function collection()
    {
        $datas1 = PasienCovid::with(['province', 'regency','district','village'])
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

        $datas2 = PenyintasCovid::with(['province', 'regency', 'district', 'village'])
                                ->select(
                                'nama',
                                'jurusan',
                                'nama_kontak',
                                'no_kontak',
                                'jenkel',
                                'goldar',
                                'tgl_positif',
                                'province_id',
                                'regency_id',
                                'district_id',
                                'village_id',
                                'kondisi',
                                'donor_plasma')
                                ->get();
        
        $datas = $datas1->merge($datas2);
        
        dd($datas);
        foreach($datas as $data){
            if($data->jenkel == 'L'){
                $data->jenkel = 'Laki-laki';
            }else{
                $data->jenkel = 'Perempuan';
            }
            $data->tgl_positif = Carbon::parse($data->tgl_positif)->locale('id')->isoFormat('LL');
            $data->tgl_negatif = Carbon::parse($data->tgl_negatif)->locale('id')->isoFormat('LL');
            $data->province_id = $data->province->name;
            $data->regency_id = $data->regency->name;
            $data->district_id = $data->district ? $data->district->name : '';
            $data->village_id = $data->village ? $data->village->name : '';
            $data->status = $data->status == true ? 'Isolasi Mandiri' : 'Rumah Sakit';
            if($data->donor_plasma == 1){
                $data->donor_plasma = 'Iya';
            }else{
                $data->donor_plasma = 'Tidak';
            }
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
            'Tanggal Positif',
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
            'Donor Plasma',
        ];
    }
}
