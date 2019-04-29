<table border="1">
    <thead>
<th>tgl absen</th>

<th>import IN</th>
<th>Jadwal IN</th>

<th>selisih</th>
<th>jam</th>
<th>menit</th>
<th>detik</th>
<th>terlambat</th>
<th>Pulang CEpat</th>
<th>Status</th>
</thead>
<tbody>
    <tr>
<?php $total = 0;
$telat = 0;?>
<?php foreach ($list as $key): ?>
  <?php

if ($key->jam == 0 and $key->menit == 0) {
	$telat = 0;
} else {
	if ($key->jam > 0 and $key->menit > 0) {
		if ($key->jam > 0 and $key->menit == 0) {
			$telat = $key->jam;
		}
		if ($key->jam > 0 and $key->menit < 31) {
			$telat = $key->jam + 0.5;
		}
		if ($key->jam > 0 and $key->menit > 31) {
			$telat = $key->jam + 1;
		}

	}
	if ($key->jam == 0 and $key->menit <= 31) {
		$telat = 0.5;
	}

}

//   if ($key->jam>0 AND $key->menit>0) {
//    if($key->jam>0){
//         $telat=$key->jam;
//     }
//     if ($key->jam>0 AND $key->menit<31) {
//         $telat=$key->jam+0.5;
//     }
//     if ($key->jam>0 AND $key->menit>31) {
//         $telat=$key->jam+1;
//     }

// }
// else {
//      $telat=0;
// }
?>
<td><?php echo $key->attendance_date ?></td>
<td><?php echo $key->clock_in ?></td>
<td><?php echo $key->monday_in_time ?></td>
<td><?php echo $key->selisih ?></td>
<td><?php echo $key->jam ?></td>
<td><?php echo $key->menit ?></td>
<td><?php echo $key->detik ?></td>
<td><?php echo $telat ?></td>
<td><?php echo $telat ?></td>
<td><?php echo $key->attendance_status ?></td>
<?php $total += $telat?>



<!--
<?php if ($key->jam == 0 and $key->menit == 0): ?>
    <td>0</td>
<?php elseif ($key->jam != 0 and $key->menit < 3): ?>
    <td>0</td>
<?php elseif ($key->jam > 0 and $key->menit != 30): ?>
    <?php ?>
    <td><?php echo $key->jam ?></td>
<?php ?>
<?php endif;?> -->
</tr>
    <?php endforeach;?>
  Total Telat: <?php echo $total ?>
</tbody>
</table>
<table border="1">

    <thead>
        <tr>
            <th>DATE</th>
            <th>OUT REAL</th>
            <th>OUT JADWAL</th>
            <th>SELISIH</th>
            <th>JAM</th>
            <th>MENIT</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <tr>

            <?php
$total_cepat = 0;
$cepet = 0;
foreach ($list1 as $key1):
	if ($key1->selisih > 0) {
		$cepet = 0;
	}

	if ($key1->jam == 0 and $key1->menit == 0) {
		$cepet = 0;
	} else {

		if ($key1->jam > 0 and $key1->menit > 0) {
			if ($key1->jam > 0 and $key1->menit == 0) {
				$cepet = $key1->jam;
			}
			if ($key1->jam > 0 and $key1->menit < 31) {
				$cepet = $key1->jam + 0.5;
			}
			if ($key1->jam > 0 and $key1->menit > 31) {
				$cepet = $key1->jam + 1;
			}
		} elseif ($key1->jam > 0 and $key1->menit == 0) {
		$cepet = $key1->jam;
	} elseif ($key1->jam == 0 and $key1->menit > 31) {
		$cepet = 1;
	}
	if ($key1->selisih < 0 and $key1->jam == 0 and $key1->menit <= 31) {
		$cepet = 0.5;
	}
}

?>

                <td><?php echo $key1->attendance_date ?></td>
                 <td><?php echo $key1->clock_out ?></td>
                  <td><?php echo $key1->monday_out_time ?></td>
                   <td><?php echo $key1->selisih ?></td>
                    <td><?php echo $key1->jam ?></td>
                     <td><?php echo $key1->menit ?></td>
                     <td><?php echo $cepet ?></td>
                     <?php $total_cepat += $cepet;?>
            </tr>
        <?php endforeach;?>
    </tbody>
    Total Pulang AWAL: <?php echo $total_cepat ?>
</table>


<table border="1">

    <thead>
        <tr>
            <th>DATE</th>
            <th>OUT REAL</th>
            <th>OUT JADWAL</th>
            <th>SELISIH</th>
            <th>JAM</th>
            <th>MENIT</th>
            <th>Total</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <tr>

            <?php
$total_cepat = 0;
foreach ($ot as $key1):

	if ($key1->jam > 1 AND $key1->menit == 0) {
		$cepet = $key1->jam;
	} elseif ($key1->jam > 1 AND $key1->menit > 31) {
	$cepet = $key1->jam + 1;
} elseif ($key1->jam > 1 AND $key1->menit < 31) {
	$cepet = $key1->jam + 0.5;
} else {
	$cepet = 0;
}
// 	if ($key1->jam == 0 and $key1->menit == 0) {
// 		$cepet = 0;
// 	} else {
// 		if ($key1->jam > 0 and $key1->menit > 0) {
// 			if ($key1->jam > 0 and $key1->menit == 0) {
// 				$cepet = $key1->jam;
// 			}
// 			if ($key1->jam > 0 and $key1->menit < 31) {
// 				$cepet = $key1->jam + 0.5;
// 			}
// 			if ($key1->jam > 0 and $key1->menit > 31) {
// 				$cepet = $key1->jam + 1;
// 			}
// 		} elseif ($key1->jam > 0 and $key1->menit == 0) {
// 		$cepet = $key1->jam;
// 	} elseif ($key1->jam == 0 and $key1->menit > 31) {
// 		$cepet = 1;
// 	}
// 	if ($key1->jam == 0 and $key1->menit <= 31) {
// 		$cepet = 0.5;
// 	}

// }

?>

				                <td><?php echo $key1->attendance_date ?></td>
				                 <td><?php echo $key1->clock_out ?></td>
				                  <td><?php echo $key1->monday_out_time ?></td>
				                   <td><?php echo $key1->selisih ?></td>
				                    <td><?php echo $key1->jam ?></td>
				                     <td><?php echo $key1->menit ?></td>
				                     <td><?php echo $cepet ?></td>
				                     <td><?php echo $key1->attendance_status ?></td>
				                     <?php $total_cepat += $cepet;?>
				            </tr>
				        <?php endforeach;?>
    </tbody>
    Total Lembur Otomatis: <?php echo $total_cepat ?>
</table>
<html>



