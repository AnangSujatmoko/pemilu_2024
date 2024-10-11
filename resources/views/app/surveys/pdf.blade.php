<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penduduk List</title>
    <style>
        /* Mengatur margin halaman agar lebih kecil */
        @page {
            margin: 10px;
        }

        /* Font lebih kecil untuk menghemat ruang */
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
        }

        /* Tabel full width dan layout tabel tetap */
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            /* Mengatur tabel layout tetap */
        }

        th,
        td {
            border: 1px solid black;
            padding: 6px;
            text-align: left;
            word-wrap: break-word;
            /* Membuat teks di dalam kolom bisa terpecah */
        }

        th {
            background-color: #f2f2f2;
        }

        /* Pecah halaman jika data terlalu panjang */
        .page-break {
            page-break-after: always;
        }

        /* Mengatur lebar kolom sesuai kebutuhan */
        th:nth-child(1),
        td:nth-child(1) {
            width: 3%;
            /* Kolom nomor lebih sempit */
        }

        th:nth-child(2),
        td:nth-child(2) {
            width: 12%;
            /* Kolom NIK lebih lebar */
        }

        th:nth-child(3),
        td:nth-child(3) {
            width: 15%;
            /* Kolom Nama */
        }

        th:nth-child(4),
        td:nth-child(4) {
            width: 7%;
            /* Kolom Jenis Kelamin */
        }

        th:nth-child(5),
        td:nth-child(5) {
            width: 5%;
            /* Kolom Usia */
        }

        th:nth-child(6),
        td:nth-child(6) {
            width: 15%;
            /* Kolom Alamat */
        }

        th:nth-child(7),
        td:nth-child(7),
        th:nth-child(8),
        td:nth-child(8) {
            width: 5%;
            /* Kolom RT/RW */
        }

        th:nth-child(9),
        td:nth-child(9) {
            width: 6%;
            /* Kolom TPS lebih sempit */
        }

        th:nth-child(10),
        td:nth-child(10) {
            width: 10%;
            /* Kolom Kecamatan */
        }

        th:nth-child(11),
        td:nth-child(11) {
            width: 10%;
            /* Kolom Kelurahan */
        }

        th:nth-child(12),
        td:nth-child(12) {
            width: 8%;
            /* Kolom Paslon */
        }

        th:nth-child(13),
        td:nth-child(13) {
            width: 10%;
            /* Kolom Domisili */
        }
    </style>
</head>

<body>
    <h1>Penduduk List</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nik</th>
                <th>Name</th>
                <th>Jenis Kelamin</th>
                <th>Usia</th>
                <th>Alamat</th>
                <th>RT</th>
                <th>RW</th>
                <th>Tps</th>
                <th>Kecamatan</th>
                <th>Kelurahan</th>
                <th>Paslon</th>
                <th>Domisili</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penduduks as $penduduk)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $penduduk->nik }}</td>
                    <td>{{ $penduduk->name }}</td>
                    <td>{{ $penduduk->jenis_kelamin }}</td>
                    <td>{{ $penduduk->usia }}</td>
                    <td>{{ $penduduk->alamat }}</td>
                    <td>{{ $penduduk->rt }}</td>
                    <td>{{ $penduduk->rw }}</td>
                    <td>{{ $penduduk->tps }}</td>
                    <td>{{ $penduduk->kode_kec }}</td>
                    <td>{{ $penduduk->kode_kel }}</td>
                    <td>{{ $penduduk->id_paslon }}</td>
                    <td>{{ $penduduk->id_domisili }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
