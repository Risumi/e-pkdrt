@if($jenis_report == 'Ciri Korban & Pelaku')
<h3>REPORT CIRI KORBAN DAN PELAKU</h3><br>
<h3>KORBAN</h3>
<table cellpadding="5" cellspacing="0" border="1">
	<thead>
		<tr>
			<th>No.</th>
			<th>Unit/</th>
			<th>Kasus</th>
			<th colspan="9">Usia</th>
			<th colspan="5">Pendidikan</th>
			<th colspan="6">Pekerjaan</th>
			<th colspan="4">Status Perkawinan</th>
			<th>Difabel</th>
			<th>KDRT</th>
		</tr>
		<tr>
			<th></th>
			<th></th>
			<th></th>

			<th>0-5</th>
			<th>6-12</th>
			<th>13-17</th>
			<th>18-24</th>
			<th>25-44</th>
			<th>45-59</th>
			<th>60+</th>
			<th>Anak</th>
			<th>Dewasa</th>

			<th>TK</th>
			<th>SD</th>
			<th>SMP</th>
			<th>SMA</th>
			<th>S1/<br>S2/<br>S3</th>

			<th>Pedagang/<br>Tani/<br>Nelayan</th>
			<th>Swasta/<br>Buruh</th>
			<th>PNS/<br>TNI/<br>Polri</th>
			<th>Pelajar</th>
			<th>Ibu <br>Rumah <br>Tangga</th>
			<th>Tidak <br>Bekerja</th>

			<th>Belum <br>Menikah</th>
			<th>Menikah</th>
			<th>Duda/<br>Janda</th>
			<th>Sirri</th>

			<th></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$arrKecamatan = ['LOWOKWARU', 'BLIMBING', 'KLOJEN', 'SUKUN', 'KEDUNGKANDANG'];
			for ($i = 0; $i < count($arrKecamatan); $i++) {
				if($kecamatan == null)
					$key1 = $arrKecamatan[$i];
				else{
					$key1 = $kecamatan;
				}
		?>
		<tr>
			<td>{{ ($i + 1) }}</td>
			<td>{{ $kecamatan == null ? $arrKecamatan[$i] : $kecamatan }}</td>
			<td>{{ $dataKorban["$key1"][0]->totalKasus }}</td>

			<td>{{ $dataKorban["$key1"][0]->usia0_5 }}</td>
			<td>{{ $dataKorban["$key1"][0]->usia6_12 }}</td>
			<td>{{ $dataKorban["$key1"][0]->usia13_17 }}</td>
			<td>{{ $dataKorban["$key1"][0]->usia18_24 }}</td>
			<td>{{ $dataKorban["$key1"][0]->usia25_44 }}</td>
			<td>{{ $dataKorban["$key1"][0]->usia45_59 }}</td>
			<td>{{ $dataKorban["$key1"][0]->usia60 }}</td>
			<td>{{ $dataKorban["$key1"][0]->usiaanak }}</td>
			<td>{{ $dataKorban["$key1"][0]->usiadewasa }}</td>

			<td>{{ $dataKorban["$key1"][0]->pendidikan_tk }}</td>
			<td>{{ $dataKorban["$key1"][0]->pendidikan_sd }}</td>
			<td>{{ $dataKorban["$key1"][0]->pendidikan_smp }}</td>
			<td>{{ $dataKorban["$key1"][0]->pendidikan_sma }}</td>
			<td>{{ $dataKorban["$key1"][0]->pendidikan_sarjana }}</td>		

			<td>{{ $dataKorban["$key1"][0]->pekerjaan_ptn }}</td>		
			<td>{{ $dataKorban["$key1"][0]->pekerjaan_swasta }}</td>		
			<td>{{ $dataKorban["$key1"][0]->pekerjaan_pns }}</td>		
			<td>{{ $dataKorban["$key1"][0]->pekerjaan_pelajar }}</td>		
			<td>{{ $dataKorban["$key1"][0]->pekerjaan_irt }}</td>		
			<td>{{ $dataKorban["$key1"][0]->pekerjaan_tidak }}</td>

			<td>{{ $dataKorban["$key1"][0]->status_belum }}</td>
			<td>{{ $dataKorban["$key1"][0]->status_menikah }}</td>
			<td>{{ $dataKorban["$key1"][0]->status_dj }}</td>
			<td>{{ $dataKorban["$key1"][0]->status_sirri }}</td>

			<td>{{ $dataKorban["$key1"][0]->difabel }}</td>
			<td>{{ $dataKorban["$key1"][0]->kdrt }}</td>
		</tr>
		<?php 
			if($kecamatan != null)
				$i = 4;
		} ?>
	</tbody>
</table>

<h3>PELAKU</h3>
<table cellpadding="5" cellspacing="0" border="1">
	<thead>
		<tr>
			<th>No.</th>
			<th>Unit/</th>
			<th>Kasus</th>
			<th colspan="4">Usia</th>
			<th colspan="5">Pendidikan</th>
			<th colspan="6">Pekerjaan</th>
			<th colspan="4">Status Perkawinan</th>
			<th colspan="9">Hubungan</th>
		</tr>
		<tr>
			<th></th>
			<th></th>
			<th></th>

			<th>0-17</th>
			<th>18-24</th>
			<th>25-59</th>
			<th>60+</th>

			<th>TK</th>
			<th>SD</th>
			<th>SMP</th>
			<th>SMA</th>
			<th>S1/<br>S2/<br>S3</th>

			<th>Pedagang/<br>Tani/<br>Nelayan</th>
			<th>Swasta/<br>Buruh</th>
			<th>PNS/<br>TNI/<br>Polri</th>
			<th>Pelajar</th>
			<th>Ibu <br>Rumah <br>Tangga</th>
			<th>Tidak <br>Bekerja</th>

			<th>Belum <br>Menikah</th>
			<th>Menikah</th>
			<th>Duda/<br>Janda</th>
			<th>Sirri</th>

			<th>Orang/<br>Tua</th>
			<th>Keluarga/<br>Saudara</th>
			<th>Suami/<br>Istri</th>
			<th>Lainnya</th>
			<th>Tetangga</th>
			<th>Pacar/<br>Teman</th>
			<th>Guru</th>
			<th>Majikan</th>
			<th>Rekan/<br>Kerja</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$arrKecamatan = ['LOWOKWARU', 'BLIMBING', 'KLOJEN', 'SUKUN', 'KEDUNGKANDANG'];
			for ($i = 0; $i < count($arrKecamatan); $i++) {
				if($kecamatan == null)
					$key1 = $arrKecamatan[$i];
				else{
					$key1 = $kecamatan;
				}
		?>
		<tr>
			<td>{{ ($i + 1) }}</td>
			<td>{{ $kecamatan == null ? $arrKecamatan[$i] : $kecamatan }}</td>
			<td>{{ $dataPelaku["$key1"][0]->totalKasus }}</td>

			<td>{{ $dataPelaku["$key1"][0]->usia0_17 }}</td>
			<td>{{ $dataPelaku["$key1"][0]->usia18_24 }}</td>
			<td>{{ $dataPelaku["$key1"][0]->usia25_59 }}</td>
			<td>{{ $dataPelaku["$key1"][0]->usia60 }}</td>

			<td>{{ $dataPelaku["$key1"][0]->pendidikan_tk }}</td>
			<td>{{ $dataPelaku["$key1"][0]->pendidikan_sd }}</td>
			<td>{{ $dataPelaku["$key1"][0]->pendidikan_smp }}</td>
			<td>{{ $dataPelaku["$key1"][0]->pendidikan_sma }}</td>
			<td>{{ $dataPelaku["$key1"][0]->pendidikan_sarjana }}</td>		

			<td>{{ $dataPelaku["$key1"][0]->pekerjaan_ptn }}</td>		
			<td>{{ $dataPelaku["$key1"][0]->pekerjaan_swasta }}</td>		
			<td>{{ $dataPelaku["$key1"][0]->pekerjaan_pns }}</td>		
			<td>{{ $dataPelaku["$key1"][0]->pekerjaan_pelajar }}</td>		
			<td>{{ $dataPelaku["$key1"][0]->pekerjaan_irt }}</td>		
			<td>{{ $dataPelaku["$key1"][0]->pekerjaan_tidak }}</td>

			<td>{{ $dataPelaku["$key1"][0]->status_belum }}</td>
			<td>{{ $dataPelaku["$key1"][0]->status_menikah }}</td>
			<td>{{ $dataPelaku["$key1"][0]->status_dj }}</td>
			<td>{{ $dataPelaku["$key1"][0]->status_sirri }}</td>

			<td>{{ $dataPelaku["$key1"][0]->hubungan_ortu }}</td>
			<td>{{ $dataPelaku["$key1"][0]->hubungan_keluarga }}</td>
			<td>{{ $dataPelaku["$key1"][0]->hubungan_sutri }}</td>
			<td>{{ $dataPelaku["$key1"][0]->hubungan_lainnya }}</td>
			<td>{{ $dataPelaku["$key1"][0]->hubungan_tetangga }}</td>
			<td>{{ $dataPelaku["$key1"][0]->hubungan_pacarteman }}</td>
			<td>{{ $dataPelaku["$key1"][0]->hubungan_guru }}</td>
			<td>{{ $dataPelaku["$key1"][0]->hubungan_majikan }}</td>
			<td>{{ $dataPelaku["$key1"][0]->hubungan_rekankerja }}</td>
		</tr>
		<?php 
			if($kecamatan != null)
				$i = 4;
		} ?>
	</tbody>
</table>
@endif
@if($jenis_report == 'Bentuk Kekerasan, Tempat Kejadian & Pelayanan')
<h3>REPORT BENTUK KEKERASAN, TEMPAT KEJADIAN & PELAYANAN</h3>
<table cellpadding="5" cellspacing="0" border="1">
	<thead>
		<tr>
			<th>No.</th>
			<th>Unit/</th>
			<th>Kasus</th>
			<th colspan="7">Bentuk Kekerasan</th>
			<th colspan="6">Tempat Kejadian</th>
			<th colspan="8">Jenis Pelayanan</th>
		</tr>
		<tr>
			<th></th>
			<th></th>
			<th></th>

			<th>Fisik</th>
			<th>Psikis</th>
			<th>Seksual</th>
			<th>Eksploitasi</th>
			<th>Trafficking</th>
			<th>Penelantaran</th>
			<th>Lainnya</th>

			<th>Rumah<br>Tangga</th>
			<th>Tempat<br>Kerja</th>
			<th>Lainnya</th>
			<th>Sekolah</th>
			<th>Fasilitas<br>Umum</th>

			<th>Pengaduan</th>
			<th>Kesehatan</th>
			<th>Bantuan<br>Hukum</th>
			<th>Penegakan<br>Hukum</th>
			<th>Rehabilitasi<br>Sosial</th>
			<th>Reintegrasi<br>Sosial</th>
			<th>Pemulangan</th>
			<th>Pendampingan<br>Tokoh Agama</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$arrKecamatan = ['LOWOKWARU', 'BLIMBING', 'KLOJEN', 'SUKUN', 'KEDUNGKANDANG'];
			for ($i = 0; $i < count($arrKecamatan); $i++) {
				if($kecamatan == null)
					$key1 = $arrKecamatan[$i];
				else{
					$key1 = $kecamatan;
				}
		?>
		<tr>
			<td>{{ ($i + 1) }}</td>
			<td>{{ $kecamatan == null ? $arrKecamatan[$i] : $kecamatan }}</td>
			<td>{{ $dataKekerasan["$key1"][0]->totalKasus }}</td>

			<td>{{ $dataKekerasan["$key1"][0]->kekerasan_fisik }}</td>
			<td>{{ $dataKekerasan["$key1"][0]->kekerasan_psikis }}</td>
			<td>{{ $dataKekerasan["$key1"][0]->kekerasan_seksual }}</td>
			<td>{{ $dataKekerasan["$key1"][0]->kekerasan_eksploitasi }}</td>
			<td>{{ $dataKekerasan["$key1"][0]->kekerasan_trafficking }}</td>
			<td>{{ $dataKekerasan["$key1"][0]->kekerasan_penelantaran }}</td>
			<td>{{ $dataKekerasan["$key1"][0]->kekerasan_lainnya }}</td>

			<td>{{ $dataKekerasan["$key1"][0]->tempat_rumah }}</td>
			<td>{{ $dataKekerasan["$key1"][0]->tempat_kerja }}</td>
			<td>{{ $dataKekerasan["$key1"][0]->tempat_lainnya }}</td>
			<td>{{ $dataKekerasan["$key1"][0]->tempat_sekolah }}</td>
			<td>{{ $dataKekerasan["$key1"][0]->tempat_fasilitasumum }}</td>			

			<td>{{ $dataKekerasan["$key1"][0]->pelayanan_pengaduan }}</td>		
			<td>{{ $dataKekerasan["$key1"][0]->pelayanan_kesehatan }}</td>		
			<td>{{ $dataKekerasan["$key1"][0]->pelayanan_bantuanhukum }}</td>		
			<td>{{ $dataKekerasan["$key1"][0]->pelayanan_penegakanhukum }}</td>		
			<td>{{ $dataKekerasan["$key1"][0]->pelayanan_rehabilitasisosial }}</td>		
			<td>{{ $dataKekerasan["$key1"][0]->pelayanan_reintegrasisosial }}</td>
			<td>{{ $dataKekerasan["$key1"][0]->pelayanan_pemulangan }}</td>
			<td>{{ $dataKekerasan["$key1"][0]->pelayanan_pendampingantokohagama }}</td>
		</tr>
		<?php 
			if($kecamatan != null)
				$i = 4;
		} ?>
	</tbody>
</table>
@endif
@if($jenis_report == 'Kasus & Korban Anak/Dewasa Terlayani')
<h3>REPORT KASUS & KORBAN ANAK DEWASA TERLAYANI</h3>
<table cellpadding="5" cellspacing="0" border="1">
	<thead>
		<tr>
			<th>No.</th>
			<th>Unit/</th>
			<th>Kasus</th>
			<th colspan="3">Korban</th>
			<th colspan="3">Terlayani</th>
		</tr>
		<tr>
			<th></th>
			<th></th>
			<th></th>

			<th>N</th>
			<th>Anak</th>
			<th>Dewasa</th>

			<th>% N</th>
			<th>% Anak</th>
			<th>% Dewasa</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$arrKecamatan = ['LOWOKWARU', 'BLIMBING', 'KLOJEN', 'SUKUN', 'KEDUNGKANDANG'];
			for ($i = 0; $i < count($arrKecamatan); $i++) {
				if($kecamatan == null)
					$key1 = $arrKecamatan[$i];
				else{
					$key1 = $kecamatan;
				}
		?>
		<tr>
			<td>{{ ($i + 1) }}</td>
			<td>{{ $kecamatan == null ? $arrKecamatan[$i] : $kecamatan }}</td>
			<td>{{ $dataTerlayani["$key1"][0]->totalKasus }}</td>

			<td>0</td>
			<td>{{ $dataTerlayani["$key1"][0]->usiaanak }}</td>
			<td>{{ $dataTerlayani["$key1"][0]->usiadewasa }}</td>

			<td>-</td>
			@if($dataTerlayani["$key1"][0]->usiaanak > 0)
				<td>{{ round(($dataTerlayani["$key1"][0]->terlayani_anak / $dataTerlayani["$key1"][0]->usiaanak) * 100, 2) }}</td>
			@else
				<td>0</td>
			@endif
			@if($dataTerlayani["$key1"][0]->usiadewasa > 0)
				<td>{{ round(($dataTerlayani["$key1"][0]->terlayani_dewasa / $dataTerlayani["$key1"][0]->usiadewasa) * 100, 2) }}</td>
			@else
				<td>0</td>
			@endif
		</tr>
		<?php 
			if($kecamatan != null)
				$i = 4;
		} ?>
	</tbody>
</table>
@endif
@if($jenis_report == 'Kasus & Korban Laki-Laki/Perempuan Terlayani')
<h3>REPORT KASUS & KORBAN TERLAYANI BY DATE
</h3>
<table cellpadding="5" cellspacing="0" border="1">
	<thead>
		<tr>
			<th>No.</th>
			<th>Unit/</th>
			<th>Kasus</th>
			<th colspan="2">Korban</th>
			<th colspan="5">Terlayani</th>
		</tr>
		<tr>
			<th></th>
			<th></th>
			<th></th>

			<th>Laki-laki</th>
			<th>Perempuan</th>

			<th>Laki-laki</th>
			<th>Perempuan</th>
			<th>% Laki-laki</th>
			<th>% Perempuan</th>
			<th>% Total</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$arrKecamatan = ['LOWOKWARU', 'BLIMBING', 'KLOJEN', 'SUKUN', 'KEDUNGKANDANG'];
			for ($i = 0; $i < count($arrKecamatan); $i++) {
				if($kecamatan == null)
					$key1 = $arrKecamatan[$i];
				else{
					$key1 = $kecamatan;
				}
		?>
		<tr>
			<td>{{ ($i + 1) }}</td>
			<td>{{ $kecamatan == null ? $arrKecamatan[$i] : $kecamatan }}</td>
			<td>{{ $dataJenisKelamin["$key1"][0]->totalKasus }}</td>

			<td>{{ $dataJenisKelamin["$key1"][0]->jenis_laki }}</td>
			<td>{{ $dataJenisKelamin["$key1"][0]->jenis_perempuan }}</td>

			<td>{{ $dataJenisKelamin["$key1"][0]->terlayani_laki }}</td>
			<td>{{ $dataJenisKelamin["$key1"][0]->terlayani_perempuan }}

			@if($dataJenisKelamin["$key1"][0]->jenis_laki > 0)
				<td>{{ round(($dataJenisKelamin["$key1"][0]->terlayani_laki / $dataJenisKelamin["$key1"][0]->jenis_laki) * 100, 2) }}</td>
			@else
				<td>0</td>
			@endif

			@if($dataJenisKelamin["$key1"][0]->jenis_perempuan > 0)
				<td>{{ round(($dataJenisKelamin["$key1"][0]->terlayani_perempuan / $dataJenisKelamin["$key1"][0]->jenis_perempuan) * 100, 2) }}</td>
			@else
				<td>0</td>
			@endif

			@if($dataJenisKelamin["$key1"][0]->jenis_laki + $dataJenisKelamin["$key1"][0]->jenis_perempuan > 0)
				<td>{{ round((($dataJenisKelamin["$key1"][0]->terlayani_laki + $dataJenisKelamin["$key1"][0]->terlayani_perempuan) / ($dataJenisKelamin["$key1"][0]->jenis_laki + $dataJenisKelamin["$key1"][0]->jenis_perempuan)) * 100, 2) }}</td>
			@else
				<td>0</td>
			@endif
		</tr>
		<?php 
			if($kecamatan != null)
				$i = 4;
		} ?>
	</tbody>
</table>
@endif
<?php
// print_r($data);