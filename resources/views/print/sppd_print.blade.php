@php 
    setlocale(LC_ALL, 'id');
    // echo \Carbon\Carbon::now()->formatLocalized('%A %d %B %Y')

    use Carbon\Carbon;
    Carbon::setLocale('id');
    $date_issue = new Carbon($sppd->date_issue);
    $date_start = new Carbon($sppd->date_start);
    $date_end   = new Carbon($sppd->date_end);
    $peserta = 0;

@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print SPPD {{ $sppd->num_validate }}</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <style>
        table{
            width: 100%;
        }
        table tr td{
            vertical-align: top;
            padding-left: 5px;
            padding-right: 5px; 
            /* border border-black: 1px solid slategray; */
        }

        p{
            text-align: justify;
            margin-bottom: 10px;
        }

        @media all {
            .page-break	{ display: none; }
        }

        @media print {
            .page-break	{ display: block; page-break-before: always; }
        }
    </style>
</head>
<body>
    <div class="container" style="width:725px">
        <table class="mb-6">
            <tr>
                <td  class="w-32">
                    <img src="{{ asset('images/logo-kab-malang_bw.png') }}" alt="logo" width="80px">
                </td>
                <td class="text-center" style="line-height: 18px">
                    <div>
                        PEMERINTAH {{ Str::upper($conf->region_sys . ' ' . $conf->region) }}
                    </div>
                    <div class="text-center text-xl font-bold" style="line-height: 18px">
                        KECAMATAN {{ Str::upper($conf->name) }}
                    </div> 
                    <div class="text-center text-sm" style="line-height: 18px; margin-top:3px;">
                        {{ $conf->address }}, Phone : {{ $conf->contact_phone }}
                    </div> 
                    <div class="text-center text-sm" style="line-height: 18px">
                        website : {{ $conf->contact_web }}, email : {{ $conf->contact_email }}
                    </div> 
                    <div class="text-center text-sm" style="line-height: 18px">
                        {{ Str::upper($conf->name) . ' ' .  $conf->post_code}}
                    </div> 
                </td>
            </tr>
        </table>

        <div class="text-center">
            <h3 class="font-bold">SURAT TUGAS</h3>
            <span>Nomor : 090/ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; /{{ $sppd->nomor }}</span>
        </div>

        
        <table class="mb-6 mt-6">
            <tr>
                <td width="130px" class="align-top">Dasar</td>
                <td class="align-top" style="width: 5px;">:</td>
                <td>{!! $sppd->dasar !!}</td>
            </tr>
        </table>

        <div class="text-center">
            <h3 class="font-bold">MENUGASKAN</h3>
        </div>

        <table class="mb-6">
            <tr>
                <td width="130px">Kepada</td>
                <td style="width: 5px;">:</td>
                <td>
                    <table>
                    @foreach ($sppd->participants as $item)
                        @if( $item->lead == 1 )
                        <tr>
                            <td><span class="font-bold">{{ $item->user->fullname }}</span><br>NIP. {{ $item->user->employe->nip }}</td>
                            <td>{{ $item->user->employe->pangkat }}<br/>{{ $item->user->employe->jabatan }}</td>
                        </tr>
                        @else
                         @php $peserta++ @endphp
                        @endif
                    @endforeach
                    </table>
                </td>
            </tr>
        </table>
        <table class="mb-6">
            <tr>
                <td width="130px" class="align-top">Untuk</td>
                <td class="align-top" style="width: 5px;">:</td>
                <td class="text-justify">Melaksanakan kegiatan <span class="font-bold">{{ ''. $sppd->acara }} </span> {{' di ' . $sppd->place_name . ', ' . $sppd->to . ', pada tanggal ' }} {{ $date_start->formatLocalized("%d %B %Y") }}  {{ ' s/d ' . $date_end->formatLocalized("%d %B %Y") }}</td>
            </tr>
        </table>

        {!! $sppd->redaktur !!}
        {{-- <p class="mb-4 text-justify" style="margin-left: 136px">Sesuai prosedur, setelah melaksanakan kegiatan dimaksud agar melaporkan hasilnya kepada pimpinan.</p> --}}
        {{-- <p class="mb-10 text-justify" style="margin-left: 136px">Demikian Surat Tugas ini disampaikan kepada yang bersangkutan untuk dilaksanakan dengan penuh tanggung jawab.</p> --}}
        <div class="flex justify-end mt-6">
            <table style="width: 40%">
                <tr style="line-height: 18px">
                    <td>Dikeluarkan di</td>
                    <td>:</td>
                    <td>{{ $conf->name }}</td>
                </tr>
                <tr style="line-height: 18px">
                    <td>Pada tanggal</td>
                    <td>:</td>
                    <td>{{ $date_issue->formatLocalized("%d %B %Y")}}</td>
                </tr>
                <tr style="line-height: 18px">
                    <td colspan="3" class="font-bold">{{ Str::upper($sppd->user_auth->employe->jabatan)}}</td>
                </tr>
                <tr>
                    <td colspan="3" height="70px"></td>
                </tr>
                <tr style="line-height: 18px">
                    <td colspan="3" class="font-bold">{{ $sppd->user_auth->fullname}}</td>
                </tr>
                {{-- <tr style="line-height: 18px">
                    <td colspan="3">{{ Str::upper($sppd->user_auth->employe->status)}}</td>
                </tr> --}}
                <tr style="line-height: 18px">
                    <td colspan="3">NIP : {{ Str::upper($sppd->user_auth->employe->nip)}}</td>
                </tr>
            </table>
        </div>


        {{-- break page --}}
        <div class="page-break"></div>

        <table class="mb-6">
            <tr>
                <td  class="w-32">
                    <img src="{{ asset('images/logo-kab-malang_bw.png') }}" alt="logo" width="80px">
                </td>
                <td class="text-center" style="line-height: 18px">
                    <div>
                        PEMERINTAH {{ Str::upper($conf->region_sys . ' ' . $conf->region) }}
                    </div>
                    <div class="text-center text-xl font-bold" style="line-height: 18px">
                        KECAMATAN {{ Str::upper($conf->name) }}
                    </div> 
                    <div class="text-center text-sm" style="line-height: 18px; margin-top:3px;">
                        {{ $conf->address }}, Phone: {{ $conf->contact_phone }}
                    </div> 
                    <div class="text-center text-sm" style="line-height: 18px">
                        website : {{ $conf->contact_web }}, email : {{ $conf->contact_email }}
                    </div> 
                    <div class="text-center text-sm" style="line-height: 18px">
                        {{ Str::upper($conf->name) . ' ' .  $conf->post_code}}
                    </div> 
                </td>
            </tr>
        </table>
        
        <div class="text-center mb-6">
            <h3 class="font-bold">SURAT PERINTAH PERJALANAN DINAS</h3>
            <span>( S P P D )</span><br />
            <span>Nomor : 090/ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; /{{ $sppd->nomor }}
        </div>

        <table class="mb-6">
            <tr>
                <td width="30px"></td>
                <td width="30%"></td>
                <td width="10px"></td>
                <td></td>
            </tr>
            <tr>
                <td>1.</td>
                <td>Pejabat berwenang yang memberi perintah</td>
                <td>:</td>
                <td class="font-bold">{{ Str::upper($sppd->user_auth->employe->jabatan)}}</td>
            </tr>
            <tr>
                <td>2.</td>
                <td>Pegawai yang diperintah</td>
                <td>:</td>
                <td>
                    <table class="mb-6">
                        @foreach ($sppd->participants as $item)
                            @if( $item->lead == 1 )
                            <tr>
                                <td><span class="font-bold">{{ $item->user->fullname }}</span><br>NIP. {{ $item->user->employe->nip }}</td>
                                <td>{{ $item->user->employe->pangkat }}<br />{{ $item->user->employe->jabatan }}</td>
                            </tr>
                            @endif
                        @endforeach
                    </table>
                </td>
            </tr>
            <tr>
                <td rowspan="2" class="align-top">3.</td>
                <td rowspan="2" class="align-top">Perjalanan Dinas yang Diperintahkan</td>
                <td rowspan="2" class="align-top">:</td>
                <td>
                    Dari : {{ $sppd->from }}
                </td>
            </tr>
            <tr>
                <td>
                    Ke : {{ $sppd->place_name .', ' . $sppd->to }}
                </td>
            </tr>
            <tr>
                <td>4.</td>
                <td>Alat angkutan yang dibawa</td>
                <td>:</td>
                <td>
                    {{ $sppd->transportasi }}
                </td>
            </tr>
            <tr>
                <td>5.</td>
                <td>Perjalanan Dinas Direncanakan</td>
                <td>:</td>
                <td>
                     {{ $date_end->diffInDays($sppd->date_start)+1 }} hari
                </td>
            </tr>
            <tr>
                <td rowspan="2" class="align-top">6.</td>
                <td class="align-top">Tanggal berangkat</td>
                <td class="align-top">:</td>
                <td>{{ $date_start->formatLocalized("%A, %d %B %Y") }}</td>
            </tr>
            <tr>
                <td>Tanggal kembali</td>
                <td>:</td>
                <td>
                    {{ $date_end->formatLocalized("%A, %d %B %Y") }}
                </td>
            </tr>
            <tr>
                <td>7.</td>
                <td>Maksud mengadakan perjalanan dinas</td>
                <td>:</td>
                <td>Melaksanakan kegiatan <span class="font-bold">{{ ''. $sppd->acara }} </span> {{' di ' . $sppd->place_name }} </td>
            </tr>
            <tr>
                <td>8.</td>
                <td>Pembebanan Anggaran</td>
                <td>:</td>
                <td>{{ $sppd->cost }}</td>
            </tr>
            <tr>
                <td class="align-top">9.</td>
                <td class="align-top">Keterangan / Pengikut</td>
                <td class="align-top">:</td>
                <td>
                    @if($peserta >0)
                    <table class="mb-6">
                        <tr>
                            <td colspan="2">Nama</td>
                            <td>Pangkat/Gol</td>
                            <td>Jabatan</td>
                        </tr>
                        @php $nom=1; @endphp
                        {{-- {{ dd($sppd->participants) }} --}}
                        @foreach ($sppd->participants as $item)
                        @if( $item->lead == 0 )
                        <tr>
                            <td class="align-top">{{ $nom++ . '.' }}</td>
                            <td class="align-top">{{ $item->user->name }} <br>NIP. {{ $item->user->employe->nip }}</td>
                            <td class="align-top">{{ $item->user->employe->pangkat }}</td>
                            <td class="align-top">{{ $item->user->employe->jabatan }}</td>
                        </tr>
                        @endif
                        @endforeach
                    </table>
                    @endif
                </td>
            </tr>
        </table>
        <div class="flex justify-end">
            <table style="width: 45%">
                <tr style="line-height: 18px">
                    <td>Dikeluarkan di</td>
                    <td>:</td>
                    <td>{{ $conf->name }}</td>
                </tr style="line-height: 18px">
                <tr style="line-height: 18px">
                    <td>Pada tanggal</td>
                    <td>:</td>
                    <td>{{ $date_issue->formatLocalized("%d %B %Y")}}</td>
                </tr>
                <tr style="line-height: 18px">
                    <td colspan="3" class="font-bold">{{ Str::upper($sppd->user_auth->employe->jabatan)}}</td>
                </tr>
                <tr>
                    <td colspan="3" height="70px"></td>
                </tr>
                <tr style="line-height: 18px">
                    <td colspan="3" class="font-bold">{{ $sppd->user_auth->fullname}}</td>
                </tr>
                {{-- <tr style="line-height: 18px">
                    <td colspan="3">{{ Str::upper($sppd->user_auth->employe->status)}}</td>
                </tr> --}}
                <tr style="line-height: 18px">
                    <td colspan="3">NIP : {{ Str::upper($sppd->user_auth->employe->nip)}}</td>
                </tr>
            </table>
        </div>

        {{-- break page --}}
        <div class="page-break"></div>
        <div class="text-center font-bold">
            <div style="line-height: 18px">DAFTAR PENERIMA BIAYA PERJALANAN DINAS DALAM DAERAH</div>
            <div style="line-height: 18px">PADA KANTOR KECAMATAN {{ $conf->name }} KABUPATEN MALAN</div>
        </div>

        <table class="mt-6">
            <tr>
                <td style="width:130px">Kegiatan</td>
                <td style="width: 5px;">:</td>
                <td><span class="font-bold">{{ ''. $sppd->acara }} </span> <br>{{' di ' . $sppd->place_name }} </td>
            </tr>
            <tr>
                <td>Hari / Tanggal</td>
                <td>:</td>
                <td><span class="font-bold">{{ $date_start->formatLocalized("%A, %d %B %Y") }}</span> s/d <span class="font-bold">{{ $date_end->formatLocalized("%A, %d %B %Y") }}</span> </td>
            </tr>
            <tr>
                <td>Instansi</td>
                <td>:</td>
                <td><span class="font-bold">Kantor Kecamatan {{ $conf->name }}</span> </td>
            </tr>
        </table>
        <table class="mt-6">
            <thead>
                <tr>
                    <th class="border border-black">NO</th>
                    <th class="border border-black">Nama/NIP/<br>Pangkat-Gol/Jabatan</th>
                    <th class="border border-black">Uang Harian <br>(Rp.)</th>

                    <th class="border border-black">Lama Hari</th>
                    <th class="border border-black">Jumlah <br>(Rp.)</th>
                    <th class="border border-black">Tanda Tangan</th>
                </tr>
            </thead>
            <tbody>
                @php $nom=1; $sub_total=0; $total = 0; @endphp
                @foreach ($sppd->participants as $item)
                    @php 
                        $item_date_start = new Carbon($item->start_work); 
                        $item_date_end = new Carbon($item->end_work); 
                        $lama_hari = $item_date_end->diffInDays($item_date_start)+1;

                        $sub_total = $lama_hari * $item->cost_per_day;
                        $total      = $sub_total + $total;
                    @endphp

                    <tr>
                        <td class="border border-black text-center">{{ $nom++ . '.' }}</td>
                        <td class="border border-black"><span class="font-bold">{{ $item->user->fullname }}</span><br>NIP. {{ $item->user->employe->nip }}<br>{{ $item->user->employe->pangkat }} / {{ $item->user->employe->jabatan }}</td>
                        <td class="border border-black">Rp. <span class="float-right">{{ number_format($item->cost_per_day) }}</span></td>

                        <td class="border border-black text-right">{{ $lama_hari }} hari</td>
                        <td class="border border-black">Rp. <span class="float-right">{{ number_format($sub_total) }}</span></td>
                        <td class="border border-black"></td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td class="border border-black" colspan="4"><span class="font-bold">Total</span></td>
                    <td class="border border-black font-bold">Rp. <span class="float-right">{{ number_format($total) }}</span></td>
                    <td class="border border-black"></td>
                </tr>
            </tfoot>
        </table>
        
        <div class="mt-6">
            <table>
                <tr style="line-height: 18px">
                    <td class="text-center">Mengetahui / Menyetujui</td>
                    <td></td>
                    <td class="text-center">{{ $conf->name }}, {{ $date_issue->formatLocalized("%d %B %Y")}}</td>
                </tr style="line-height: 18px">
                <tr style="line-height: 18px">
                    <td  class="font-bold text-center">{{ Str::upper($sppd->user_pjb_finance->employe->jabatan)}}</td>
                    <td></td>
                    <td  class="font-bold text-center">{{ Str::upper($sppd->user_finance->employe->jabatan)}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td  height="70px"></td>
                </tr>
                <tr style="line-height: 18px">
                    <td class="font-bold text-center">{{ $sppd->user_pjb_finance->fullname}}</td>
                    <td></td>
                    <td class="font-bold text-center">{{ $sppd->user_finance->fullname}}</td>
                </tr>
                <tr style="line-height: 18px">
                    <td  class="text-center">NIP : {{ Str::upper($sppd->user_pjb_finance->employe->nip)}}</td>
                    <td></td>
                    <td  class="text-center">NIP : {{ Str::upper($sppd->user_finance->employe->nip)}}</td>
                </tr>
            </table>
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>
</html>