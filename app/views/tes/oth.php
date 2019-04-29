<table border="1">

	<thead>
		<tr>
			<th>tgl in</th>
			<th>tgl out</th>
			<th>selisih</th>
			<th>Jam</th>
			<th>menit</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>

		<tr>
			<?php
$ot8 = 0;
$total = 0;
foreach ($ot as $key1): ?>
<?php

?><td><?php echo $key1->clock_in ?></td>
<td><?php echo $key1->clock_out ?></td>
			<td><?php echo $key1->selisih ?></td>
			<td><?php echo $key1->jam ?></td>
			<td><?php echo $key1->menit ?></td>
			<td><?php echo $ot8 ?></td>
		</tr>
	<?php endforeach;?>
	</tbody>
	Total <?php echo $total ?>
</table>