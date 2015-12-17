<html>
<body>
<form name=”suratphoto” action=”” method=”post”>
<table border=”1? align=”center” bgcolor=”lightgreen”>
<tr>
<td colspan=”4? align=”center”><h2 align=”center”>Sukses Dunia dan Akhirat Studio Photo</h2></td>
</tr>
<tr>
<td>id pelanggan</td>
<td><input name=”id_pelanggan” type=”hidden”></td>
</tr>
<tr>
<td>nama</td>
<td><input name=”textnama” type=”text” size=”32? maxlength=”32?></td>
<td>tangal (YYYY-MM-DD)</td>
<td><input name=”texttanggal” type=”text” size=”24? maxlength=”24?></td>
</tr>
<tr>
<td>tipe photo</td>
<td><input name=”radiotipe” type=”radio” value=”berwarna”>berwarna
<input name=”radiotipe” type=”radio” value=”grayscale”>grayscale</td>
<td>photo bulan</td>
<td><input name=”textphoto_bulan” type=”text” size=”32? maxlength=”32?></td>
</tr>
<tr>
<td>cetak photo</td>
<td><input name=”radiocetak_photo” type=”radio” value=”kilat”>kilat
<input name=”radiocetak_photo” type=”radio” value=”biasa”>biasa</td>
<td>ukuran</td>
<td><input name=”textukuran” type=”text” size=”14? maxlength=”14?></td>
</tr>
<tr>
<td>jumlah photo</td>
<td><input name=”textjumlah_photo” type=”text” size=”32? maxlength=”32?></td>
<td>total ongkos</td>
<td><input name=”texttotal_ongkos” type=”text” size=”32? maxlength=”32?></td>
</tr>
<tr>
<td>uang muka</td>
<td><input name=”textuang_muka” type=”text” size=”32? maxlength=”32?></td>
<td>uang sisa</td>
<td><input name=”textuang_sisa” type=”text” size=”32? maxlength=”32?></td>
</tr>
<tr>
<td colspan=”4? align=”center”>
<input name=”buttonsimpan” type=”submit” value=”simpan”>
<input name=”buttoncancel” type=”reset” value=”cancel”>
</td>
</tr>
</table>
</form>
<?php
?>
</body>
</html>