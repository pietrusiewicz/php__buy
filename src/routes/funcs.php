<?php
function delItemArray($tl) {
	$l = [];
	for ($i=0; $i<count($tl); $i++) {
		if (!isset($_POST[$i])) {
        } else {
			array_push($l, $tl[$i]);
        }
	}
	return $l;
}
