<?php
$this->load->helper('main_helper'); 
	if(isset($tnumDetails)){
		$total = 0;
			for($i = 0; $i < count($tnumDetails); $i++ ){
				$total += ($tnumDetails[$i][8] != "N/C" ? $tnumDetails[$i][8] : 0);
				if(checkIfChanged(array($tnumDetails[$i][3],$tnumDetails[$i][4],$tnumDetails[$i][5],$tnumDetails[$i][6],$tnumDetails[$i][7],$tnumDetails[$i][8])))
					echo "<tr>
							<td class=\"track_dot\">
								<span class=\"track_line\"></span>
							</td>
							<td>{$tnumDetails[$i][2]}</td>
							<td>
								".($tnumDetails[$i][3] != "N/C" ? "Phase: ".getPhase($tnumDetails[$i][3])."<BR>" : "")."
								".($tnumDetails[$i][4] != "N/C" ? "Package: ".getPackage($tnumDetails[$i][4])."<BR>" : "")."
								".($tnumDetails[$i][5] != "N/C" ? "Scheduled Date: ".$tnumDetails[$i][5]."<BR>" : "")."
								".($tnumDetails[$i][6] != "N/C" ? "Add-ons: ".getAddOns($tnumDetails[$i][6])."<BR>" : "")."
								".($tnumDetails[$i][7] != "N/C" ? "To be Paid: ".$tnumDetails[$i][7]."<BR>" : "")."
								".($tnumDetails[$i][2]=="Created" ? "Currently Paid: ".$tnumDetails[$i][8]."<BR>" : ($tnumDetails[$i][8] != "N/C" ? "Added to Payment: ".$tnumDetails[$i][8]."<BR>" : ""))."
							</td>
								<td>{$tnumDetails[$i][1]}</td>
								<td>".date("F d, Y || h A i", strtotime($tnumDetails[$i][9]))." min</td>
						  </tr>";
				}
	}
?>